<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */

get_header(); ?>

<section class="blog-page-section">
  <div class="container-fluid container-2 blog-list">
    <?php 
			$postsPerPage = 4;
            $args = array(
                  'posts_per_page' => $postsPerPage,
                  'order' => 'DESC'
            );
			$loop = new WP_Query($args);
			 while ($loop->have_posts()) : $loop->the_post();	
	  
	   ?>
    <div class="row blog-row">
      <div class="col-sm-6 blog-page-content">
        <h1>
          <?php the_time('d/m/y');?>
        </h1>
        <h2><a href="<?php the_permalink(); ?>">
          <?php the_title(); ?>
          </a></h2>
        <div class="post-excerpt">
          <?php
                $excerpt = get_the_excerpt();
                echo string_limit_words($excerpt,25);
              ?>
        </div>
        <a class="read-more-btn" href="<?php the_permalink(); ?>">READ MORE...</a> </div>
        <div class="black-border"></div>
      <div class="col-sm-6 blog-post-img">
        <?php if ( has_post_thumbnail() ) { ?>
        <a href="<?php the_permalink(); ?>">
        <?php the_post_thumbnail('blog-img'); ?>
        </a>
        <?php } else { ?>
        <a href="<?php the_permalink(); ?>"> <img src="http://placehold.it/650x450" alt="placeholder" title="placeholder" /></a>
        <?php } ?>
      </div>
    </div>
    <?php endwhile; wp_reset_postdata(); ?>
  </div>
  <div class="text-center load-more-botton">
    <span id="more_posts_blog" class="link-button">LOAD MORE</span>
      <div id="error-message-rnd"></div>   
  </div>
</section>
<?php get_footer(); ?>