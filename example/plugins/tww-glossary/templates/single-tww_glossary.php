<?php
/**
 * The template for displaying all single glossary
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Salient Child
 */
get_header();
?>

<main>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1><?php the_title() ?></h1>
                <?php the_content() ?>
            </div>
        </div>
    </div>
</main>

<?php
get_footer();