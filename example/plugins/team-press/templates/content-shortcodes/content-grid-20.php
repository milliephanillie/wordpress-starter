<?php
  global $number_excerpt,$back_p;
  $customlink = ex_teampress_customlink(get_the_ID(),$back_p);
  $image = get_post_meta( get_the_ID(), 'extp_image', true );
  $img_size = apply_filters('extp_image_size','full');
?>
<figure class="tpstyle-20 tpstyle-20-blue tppost-<?php the_ID();?>">
  <div class="tpstyle-20-image">
    <a href="<?php echo $customlink; ?>" class="<?php if($image!='') {echo "second_img_config";}?>">
      <?php the_post_thumbnail($img_size); ?>
      <?php if($image!=''){?>
        <img class="second-img second-cus" src="<?php echo esc_url($image); ?>">
        <?php }
      ?>
    </a>
    <div class="tpstyle-20-icons">
      <?php echo ex_teampress_social(get_the_ID());?>
    </div>
  </div>
  <figcaption>
    <h3><a href="<?php echo $customlink; ?>"><?php the_title(); ?></a></h3>
    <?php $position = get_post_meta( get_the_ID(), 'extp_position', true ); 
      if($position!=''){ ?>
        <h5><?php echo html_entity_decode($position); ?></h5>
    <?php }?>
    <?php 
	if($number_excerpt =='full'){?>
    <p><?php echo get_the_excerpt(); ?></p>
    <?php
  }else 
  if($number_excerpt > 0){?>
	<p><?php echo wp_trim_words(get_the_excerpt(),$number_excerpt,'...'); ?></p>
	<?php }?>
  </figcaption>
  <?php extp_custom_single_color(20);?>
</figure>
