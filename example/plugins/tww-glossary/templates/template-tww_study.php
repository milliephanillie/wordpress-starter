<?php
/**
 * Template Name: TWW Study
 * 
 * The template for displaying glossary
 */
get_header();

if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
    <div id="content" class="site-content">
        <div id="primary" class="content-area">
            <main id="main" class="site-main" role="main">
                <div class="breadcrumbs">
                    <?php if (function_exists('bcn_display')) {
                        bcn_display();
                    } ?>
                </div>
                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                    <header class="entry-header">
                        <h1 class="entry-title"><?php the_title(); ?></h1>
                    </header>
                    <div class="entry-content">
                        <?php the_content(); ?>
                    </div>
                </article>
            </main>
        </div>
    </div>
<?php endwhile; endif;
?>
