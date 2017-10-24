<?php
/**
 * Template Name: Portfolio Page
 *
 */
get_header(); 
?>
<section class="portfolio-page-section">
    <div class="container portfolio-list">
    <div class="row">
         <?php 
         $postsPerPage = 12;
			$terms = get_terms( 'portfolio_cat', array( 'hide_empty' => 1, 'number' =>  $postsPerPage ) );
			//echo "<pre>"; print_r($terms); echo "</pre>";
			$__posts = array();
			$_found_terms = array();
			$_obj_found_terms = array();
			foreach( $terms as $tkey => $tvalue ){
			$_found_terms[] = $tvalue->term_id;
				$_obj_found_terms[] = $tvalue;
				$args = array(
					'posts_per_page' => 1,
					'post_type'	=> 'portfolio-post',
					'tax_query' => array(
						array(
							'taxonomy' => 'portfolio_cat',
							'field' => 'term_id',
							'terms' => array( $tvalue->term_id )
						)
					),
					'order' => 'DESC'
				);
				$loop = new WP_Query($args);
				while ($loop->have_posts()) : $loop->the_post();
					$__posts[] = get_the_ID();
					
				  endwhile; wp_reset_postdata();
  			}

			
			$args = array(
				  'posts_per_page' => $postsPerPage,
						  'post_type'	=> 'portfolio-post',
				  'orderby' => 'post__in',
						  'post__in' => $__posts
			);
      
			$loop_count = 1;
			$loop = new WP_Query($args);
				//$arugs = array('orderby' => 'name', 'order' => 'DESC', 'fields' => 'all');
			$counter = 0;
			while ($loop->have_posts()) : $loop->the_post();	

	  		//$terms = wp_get_post_terms( get_the_ID(), 'gallery_cat', $arugs);
			    
	   ?>
		  <div class="col-sm-4 portfoli_sizg_set"> 
			<div class="portfolio-item">
			<?php  if ( has_post_thumbnail() ) { ?>
				<a href="<?php echo get_term_link($_obj_found_terms[$counter]->term_id); ?>">
				<?php the_post_thumbnail('360x440'); ?>
				</a>
				<?php } else { ?>
				<a href="<?php echo get_term_link($_obj_found_terms[$counter]->term_id); ?>"> <img src="http://placehold.it/360x440" alt="placeholder" title="placeholder" /></a>
				<?php } ?>
				
				<div class="port-content">
				<div class="port-content-inner">
				<h2><a href="<?php echo get_term_link($_obj_found_terms[$counter]->term_id); ?>"><?php echo $_obj_found_terms[$counter]->name ; ?></a></h2>
				<a class="border-btn" href="<?php echo get_term_link($_obj_found_terms[$counter]->term_id); ?>">VIEW NOW</a>
			</div></div>
			</div>
		  </div>
		<?php $counter++; endwhile; wp_reset_postdata(); ?>
        
        </div><!--row-->
        <div id="error-message-rnd" class="text-center"></div>  
        <div id="load-more-button-section" class="load-btn">
        	<button id="more_posts_gallery" class="load-more" data-exclude="<?php echo implode(',', $_found_terms) ; ?>"></button>
        </div>
        
    </div>
    <!--container--> 
</section>
<style>
.portfolio-page-section {
    padding-bottom: 80px;
}
</style>
<?php get_footer(); ?>
