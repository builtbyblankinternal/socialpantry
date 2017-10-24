<?php
/**
 * Template Name: Blog Page
 *
 */
get_header(); ?>

<section class="blog-page-section">
  <div class="container blog-list">
    <div class="row blog-list-2">
      <?php 
			$postsPerPage = 12;
            $args = array(
                  'posts_per_page' => $postsPerPage,
                  'order' => 'DESC'
            );
			$loop = new WP_Query($args);
			 while ($loop->have_posts()) : $loop->the_post();	
	  
	   ?>
       <div class="col-sm-4 post-item portfoli_sizg_set">
          <div class="post-item-img">
            <?php if ( has_post_thumbnail() ) { ?>
            <a href="<?php the_permalink(); ?>">
            <?php the_post_thumbnail('360x440'); ?>
            </a>
            <?php } else { ?>
            <a href="<?php the_permalink(); ?>"> <img src="http://placehold.it/360x440" alt="placeholder" title="placeholder" /></a>
            <?php } ?>
			<a href="<?php the_permalink(); ?>">
            <div class="post-link">
              <div class="post-link-inner"><span class="border-btn">READ MORE</span></div>
            </div>
			</a>
          </div>
          <div class="post-item-content">
          <h5><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
           <p><?php
                $excerpt = get_the_excerpt();
                echo string_limit_words($excerpt,9);
				?>...
          </p>
          </div>
      </div>
      <?php endwhile; wp_reset_postdata(); ?>
    </div>
	
		<div id="load-more-button-section" class="load-btn">	<button id="more_posts_blog" data-category="0"></button></div>
        <div id="error-message-rnd text-center"></div>
  </div>
  <!--container--> 
</section>
<?php get_footer(); ?>
