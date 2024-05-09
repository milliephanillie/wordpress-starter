<?php
get_header();

if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
<div class="single-tww-study--page-header">
    <div class="single-tww-study--page-title single-study-container"><h1><?php the_title(); ?></h1></div>
</div>
    <div id="content" class="site-content">
        <div id="primary" class="content-area">
            <main id="main" class="site-main single-tww-study--article single-study-container" role="main">
                <div class="single-tww_study--breadcrumbs">
                    <span><a href="/research"> Research </a> </span> <i class="fa fa-caret-right"></i> <span> <?php the_title(); ?> </span>
                </div>
                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                    <header class="entry-header">
                        <h2 class="entry-title"><?php the_title(); ?> Studies</h2>
                    </header>
                    <div class="entry-content">
                        <?php the_content(); ?>
                </article>
            </main>
        </div>
    </div>
<?php endwhile; endif;

$user_id = get_current_user_id();

if($user_id) {
    $user = new \MeprUser($user_id);
    $active_memberships = $user->active_product_subscriptions('ids');
}

if((!$active_memberships || !count($active_memberships)) && !current_user_can('manage_options')) {
    ?>
    <div class="gate-overlay"></div>

    <div style="padding: 40px;" class="gate--cta <?php echo current_user_can('manage_options') ? 'gate-admin' : ''; ?>"> 
        <div class="gate--cta--content">
            <h2>Unlock the full database</h2>
            <p>Access all of our research and studies by becoming a member.</p>
            <a href="/join" style="margin: 5px auto; display: flex !important; align-items: center !important;" class="button-primary primary-button">Get Access</a> 
            <?php
                if(!is_user_logged_in()) {
                    echo '<p style="text-align: center;">or <a href="/login" class="tww-glossary-login">Login</a></p>';
                }
            ?>

        </div>
    </div>
<?php
}

get_footer();
?>
