<?php
/**
 * Template Name: Social Pantry Page
 *
 */
get_header(); 
?>
<section class="services-page-section">
  <div class="container services-list">
    <div class="row">
      <?php 
			$postsPerPage = -1;
            $args = array(
                  'posts_per_page' => $postsPerPage,
				  'post_type'	=> 'socialpantry-post',
                  'order' => 'DESC'
            );
			$loop = new WP_Query($args);
			 while ($loop->have_posts()) : $loop->the_post();	
	  
	   ?>
      <div class="col-sm-4 post-item portfoli_sizg_set">
          <div class="post-item-img">
            <?php if ( has_post_thumbnail() ) { ?>
            <?php the_post_thumbnail('360x440'); ?>         
            <?php } else { ?>
            <a href="<?php the_permalink(); ?>"> <img src="http://placehold.it/360x440" alt="placeholder" title="placeholder" /></a>
            <?php } ?>
            <div class="post-link">
              <div class="post-link-inner"> <a class="border-btn" href="<?php echo site_url(); ?>/contact">BOOK NOW</a> </div>
            </div>
			<div class="badge-icon">
			<?php 

$image = get_field('page_badge_icon');

if( !empty($image) ): ?>

	<img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />

<?php endif; ?>
				
			</div>
          </div>
          <div class="post-item-content">
          <h5><?php the_title(); ?></h5>
            <?php the_content(); ?>
          </div>
      </div>
      <?php endwhile; wp_reset_postdata(); ?>
    </div><!--row--> 
  </div><!--container--> 
</section>
<?php get_footer(); ?>
