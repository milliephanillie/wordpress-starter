            <!-- <div class="glossary-hero-sidebar"> -->
            <?php
                    $query = new WP_Query([
                        'post_type' => 'post',
                        'posts_per_page' => 5,
                        'orderby' => 'date',
                        'order' => 'DESC',
                        'tag' => 'covid'
                    ]);


                    if($query->have_posts()) {
                        
                        echo '<ul>';
                        echo '<li><h4>Latest Articles</h4></li>';
                        while($query->have_posts()) {
                            $query->the_post();
                            ;
                            echo '<li><a href="'.get_permalink().'">'.get_the_title().'</a></li>';
                        }
                        echo '</ul>';
                    }

                ?>
                
            </div>