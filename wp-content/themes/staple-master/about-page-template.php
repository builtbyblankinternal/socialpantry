<?php
/**
 * Template Name: About Page
 *
 */
get_header(); ?>
<?php $options = get_option( 'sample_theme_options' ); ?>

<section class="about-page-section">
    <div class="container">
        <div class="row abt-pg ">
            <div class="col-md-6 col-sm-6 about-post-img contact-col"> <?php if ( has_post_thumbnail() ) { ?>
				  <?php the_post_thumbnail('532x698'); ?>
				  <?php } else { ?>
				 			<img src="<?php echo 'http://placehold.it/532x698'; ?>">
              <?php } ?>
				<div class="badge-icon">
				<?php 

				$image = get_field('badge_icon');

				if( !empty($image) ): ?>

				<img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />

				<?php endif; ?>

				</div>
               </div>
            <div class="col-md-6 col-sm-6 about-page-content contact-col">
                <?php
            // Start the loop.
            while ( have_posts() ) : the_post();
    
                // Include the page content template.
                get_template_part( 'template-parts/content', 'page' );
    
                // If comments are open or we have at least one comment, load up the comment template.
                if ( comments_open() || get_comments_number() ) {
                    comments_template();
                }
    
                // End of the loop.
            endwhile; 
            ?>   
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>
