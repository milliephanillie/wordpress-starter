<?php

get_header();

if(have_posts()) :
    while(have_posts()) :
        the_post();

        the_title();
        the_content();

        echo "<h3>Here we rund 'do shortcode'</h3>";
    endwhile;
endif;


get_footer();
