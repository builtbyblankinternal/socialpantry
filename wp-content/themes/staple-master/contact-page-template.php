<?php
/**
 * Template Name: Contact Page
 *
 */
get_header(); ?>

<div class="contact-page-sections">
    <div class="container">
    <div class="row">
    	<div class="col-sm-6 contact-col">
        	<?php if ( has_post_thumbnail() ) { ?>
            <?php the_post_thumbnail('box-img'); ?>
            <?php } else { ?> <img src="<?php echo 'http://placehold.it/532x698'; ?>">
            <?php } ?>
        </div>
        <div class="col-sm-6 contact-col5">
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
            <div class="contact-page-form">
            	<?php //the_excerpt(); ?>
            </div>
        </div>
    </div><!--row-->
</div><!--container-->
</div>
<?php get_footer(); ?>
