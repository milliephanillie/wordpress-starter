<?php
/**
 * Template Name: TWW Glossary
 * 
 * The template for displaying glossary
 */
get_header();
?>


<section class="glossary-hero">
    <div class="tww-container">
        <h1>Research</h1>

        <span class="glossary-tag"><?php echo TWW_Glossary::last_updated_date(); ?></span>
        <?php 
            $user_id = get_current_user_id();

            $active_memberships = [];

            if(class_exists('MeprUser')) :
                if($user_id) {
                    $user = new \MeprUser( $user_id );
                    if( (int)$user->ID !== 0 ) { 
                        $active_memberships = array_unique( $user->active_product_subscriptions( 'ids' ), true );
                    }
                }        

            endif;
        ?>
        <br />
        <div class="glossary-hero-content">
            <div class="glossary-hero-intro">
                <?php the_content(); ?>
            </div>

    </div>
</section>


<header class="letters tww-bg-brand-grey">
    <div class="tww-container">
        <?php
        $query = new WP_Query([
            'post_type' => 'letter',
            'posts_per_page' => -1,
            'orderby' => 'title',
            'order' => 'ASC'
        ]);
        $letters = [];

        if($query->have_posts()) {
            echo '<ul>';
            foreach($query->posts as $post) {
                $letters[$post->post_title] = [];
                echo '<li><a href="#section-'.$post->post_title.'">' . $post->post_title . '</a></li>';
            }
            echo '</ul>';
        }
        ?>
    </div>
</header>

<?php  

$study_query = new WP_Query([
    'post_type' => 'tww_study',
    'posts_per_page' => -1,
    'orderby' => 'title',
    'order' => 'ASC'
]);

foreach($study_query->posts as $study) {
    $indexed_letters = carbon_get_post_meta($study->ID, 'tww_indexed_letters');
    
    if($indexed_letters) {
        foreach($indexed_letters as $letter_post) {
            $letter = get_the_title($letter_post['id']);
            
            $letters[$letter][] = $study;
        }
    } else {
        $letter = strtoupper(substr($study->post_title, 0, 1));

        if(is_array($letters[$letter])) {
            $letters[$letter][] = $study;
        }
    }
}

foreach($letters as $letter => $studies) {
    echo '<section id="section-'.$letter.'" class="letter-section">';
    echo '<div class="tww-container">';
    echo '<div class="letter-title"><h2>'.$letter.'</h2><span><a href="#top">Back to top</a></span></div>';
    echo '<ul class="letter-list">';
    foreach($studies as $study) {
        echo '<li><a href="'.get_permalink($study->ID).'">'.$study->post_title.'</a></li>';
    }
    echo '</ul>';
    echo '</div>';
    echo '</section>';
}



if(class_exists('MeprUser')) {
    $user = new \MeprUser($user_id);
    $active_memberships = $user->active_product_subscriptions('ids');

    if((!$active_memberships || !count($active_memberships)) && !current_user_can('manage_options')) {
        ?>
        <div class="gate-overlay"></div>

        <div style="padding: 40px;" class="gate--cta <?php echo current_user_can('manage_options') ? 'gate-admin' : ''; ?>"> 
            <div class="gate--cta--content">
                <h2>Unlock the full database</h2>
                <p>Access all of our research and studies by becoming a member.</p>
                <a href="/join" style="margin: 5px auto; display: flex !important; align-items: center !important;" class="button-primary primary-button">Get Access</a> <?php
                    if(!is_user_logged_in()) {
                        echo '<p style="text-align: center;">or <a href="/login" class="tww-glossary-login">Login</a></p>';
                    }
                ?>

            </div>
        </div>
    <?php
    }
}

get_footer();