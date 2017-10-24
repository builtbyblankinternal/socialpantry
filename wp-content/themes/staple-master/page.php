<?php
/**
 * The template for displaying pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that
 * other "pages" on your WordPress site will use a different template.
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */
get_header(); ?>
<?php $options = get_option( 'sample_theme_options' ); ?>
<div id="primary" class="content-area">
        <div class="title-section container">
		<?php the_title( '<h1 class="page-heading">', '</h1>' ); ?> 
        </div>

 <main id="main" class="site-main container default-page" role="main">
            <?php
			if( get_post_meta( get_the_ID(), 'my_meta_box_check', true ) != 'on' ) :
			
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
			endif; 
            ?>
 </main><!-- .site-main -->
</div><!-- .content-area -->

<?php get_footer(); ?>
