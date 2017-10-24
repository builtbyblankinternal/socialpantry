<?php
/**
 * Template Name: Press Page
 *
 */
get_header(); ?>

<section class="press-page-section">
    <div class="container">
        <div class="row press-item">
        <?php 
			$postsPerPage = 6;
            $args = array(
                  'posts_per_page' => $postsPerPage,
				  'post_type'	=> 'press-post',
                  'order' => 'DESC'
            );
			$loop = new WP_Query($args);
			 while ($loop->have_posts()) : $loop->the_post();	
	  
	   ?>
              <div class="col-sm-4 post-item">
          <div class="post-item-img">
            <?php if ( has_post_thumbnail() ) { ?>
            <a href="<?php the_permalink(); ?>">
            <?php the_post_thumbnail('360x440'); ?>
            </a>
            <?php } else { ?>
            <a href="<?php the_permalink(); ?>"> <img src="http://placehold.it/360x440" alt="placeholder" title="placeholder" /></a>
            <?php } ?>
            <div class="post-link">
              <div class="post-link-inner"> 
              <h5><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
              <a class="border-btn" href="<?php the_permalink(); ?>">READ MORE</a> </div>
            </div>
          </div>
      </div>
            <?php endwhile; wp_reset_postdata(); ?>
        </div>
		
		<div id="load-more-button-section"  class="load-btn">	<button id="more_posts_press" data-category="0"></button></div>
        <div id="error-message-rnd text-center"></div>
    </div>   
</section>
<?php get_footer(); ?>
