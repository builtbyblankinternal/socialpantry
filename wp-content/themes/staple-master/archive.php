<?php
/**
 * The template for displaying archive pages
 *
 * Used to display archive-type pages if nothing more specific matches a query.
 * For example, puts together date-based pages if no date.php file exists.
 *
 * If you'd like to further customize these archive views, you may create a
 * new template file for each one. For example, tag.php (Tag archives),
 * category.php (Category archives), author.php (Author archives), etc.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */

get_header(); ?>
<header class="page-header">
				<?php
					the_archive_title( '<h1 class="entry-title">', '</h1>' );
					the_archive_description( '<div class="taxonomy-description">', '</div>' );
				?>
			</header><!-- .page-header -->

    	<div class="container cat-page-content">
    	 <?php 
	      $current_cat =  get_query_var('cat');
	      
		$categories = get_categories();
		//$current_cat =  get_query_var('cat');
		echo '<ul class="caregories-list">';
		echo '<li><a href="'. get_permalink( get_page_by_path( 'Blog' ) ).'">All</a></li>';
		
		foreach ($categories as $cat) {
			$active_class = '';
			if($current_cat == $cat->term_id){
					$active_class = 'cat-active';
			}
			echo '<li class="'.$active_class.'" ><a href="'. get_category_link( $cat->term_id ).'">'.$cat->name .'</a></li>';
		
		}
		echo '</ul>'; 

		?>
		<div class="blog-list">
		<?php $postsPerPage = 4;
            $args = array(
                  'posts_per_page' => $postsPerPage,
                  'cat' => $current_cat,
                  'order' => 'DESC'
            );
			$loop = new WP_Query($args);
			 if ( have_posts() ) : ?>

			

			<?php
			// Start the Loop.
			while ( $loop->have_posts()) : $loop->the_post(); ?>
        <div class="row blog-post">
          <div class="col-sm-6 blog-post-img">
            <?php if ( has_post_thumbnail() ) { ?>
            <a href="<?php the_permalink(); ?>">
            <?php the_post_thumbnail('blog-img'); ?>
            </a>
            <?php } else { ?>
            <a href="<?php the_permalink(); ?>"> <img src="http://placehold.it/520x720" alt="placeholder" title="placeholder" /></a>
            <?php } ?>
          </div>
          <div class="col-sm-8 post-content">
          <div class="post-date"><?php the_time('d/m/y');?></div>
            <h2><a href="<?php the_permalink(); ?>">
              <?php the_title(); ?>
              </a> </h2>
              <p class="cat-name"><?php $cats = array();
							foreach (get_the_category($post_id) as $c) {
								$cat = get_category($c);
								array_push($cats, $cat->name);
							}
							if (sizeOf($cats) > 0) {
								$post_categories = implode(' , ', $cats);
							} else {
								$post_categories = 'Not Assigned';
							}

							echo $post_categories; ?></p>
            <p>
              <?php
				  $excerpt = get_the_excerpt();
				  echo string_limit_words($excerpt,20);
				?>
            </p>
            <p class="text-right"><a class="read-more" href="<?php the_permalink(); ?>"> Read More </a></p>
          </div>
        </div>

			<?php endwhile; 

			// Previous/next page navigation.
			the_posts_pagination( array(
				'prev_text'          => __( 'Previous page', 'twentysixteen' ),
				'next_text'          => __( 'Next page', 'twentysixteen' ),
				'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'twentysixteen' ) . ' </span>',
			) );

		// If no content, include the "No posts found" template.
		else :
			get_template_part( 'template-parts/content', 'none' );

		endif;
		?>
		
        </div>
        <div class="text-center load-more-btn">
          <span id="more_posts_blog" class="load-more" data-category="<?php echo $current_cat;?>">LOAD MORE</span>
            <div id="error-message-rnd"></div>   
        </div>
	</div><!-- .container -->
<?php get_footer(); ?>
