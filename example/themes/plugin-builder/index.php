<?php
get_header();

if(have_posts()) :
    while(have_posts()) :
        the_post();
        the_content();
    endwhile;
endif;

echo "<h1>Hello World! This is an update!</h1>";
