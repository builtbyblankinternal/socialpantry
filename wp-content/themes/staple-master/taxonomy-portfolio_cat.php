<?php
/**
 * The template for displaying all single posts and attachments
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */
get_header();
?>

<!--CSS-->

<div id="primary" class="post-page-content"> 
  
  <?php $term_id = get_queried_object()->term_id; ?>
  <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="portfolio-single-page">
      <div class="portfolio-big-image">
        <div id="showimagediv" class="container text-center"></div>
        <span class="first" style="display:none;">
        <?php if (has_post_thumbnail()) { ?>
        <a href="<?php the_permalink(); ?>">
        <?php the_post_thumbnail('full'); ?>
        </a>
        <?php } else { ?>
        <a href="<?php the_permalink(); ?>"> <img src="http://placehold.it/1100x725" alt="placeholder" title="placeholder" /></a>
        <?php } ?>
        </span>
        <div class="portfolio-btn-section">
          <div class="scroll portfolio-btn container"> <a href="javascript:void(0);" class="prev-link link-btn">Previous</a> <a href="javascript:void(0);" class="next-link link-btn">Next</a> </div>
        </div>
      </div>
      <!--portfolio-big-img-->
      <div class="thumbnail-section">
        <div class="container">
          <div class="gallerythumbnail slick-slider" id="myGalCarousel">
            <?php
                        $imgs = get_post_meta($post->ID, 'gallery_images_gallery', true);
                        $args = array(
                            'posts_per_page' => -1,
                            'post_type' => 'portfolio-post',
                            'tax_query' => array(
                                array(
                                    'taxonomy' => 'portfolio_cat',
                                    'field' => 'term_id',
                                    'terms' => array($term_id)
                                )
                            ),
                            'order' => 'DESC'
                        );
                        $loop = new WP_Query($args);
                        while ($loop->have_posts()) : $loop->the_post();
                            $__posts[] = get_the_ID();

                            $img_url = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full', true);
                            $box_url = wp_get_attachment_image_src(get_post_thumbnail_id(), '300x300', true);
														if( has_post_thumbnail() ){
															echo '<div class="imageContainer" data-src="' . $img_url[0] . '"><img src="' . $box_url[0] . '"></div>';
														} else {
																echo '<div class="imageContainer" data-src="http://placehold.it/1200x400"><img src="http://placehold.it/300x300"></div>';
														}
						 
                         //   echo '<div class="imageContainer"><span class="post_name" style="display:none"></span><span class="thumb" data-src="' . $img_url[0] . '"><img src="' . $box_url[0] . '"></span></div>';
                        endwhile;
                        wp_reset_postdata();
                        ?>
          </div>
        </div>
        <!--container--> 
      </div>
      <!--thumbnail-section--> 
    </div>
    <?php // twentysixteen_excerpt();  ?>
    <div class="container">
      <div class="entry-content">
        <?php
                the_content();

                wp_link_pages(array(
                    'before' => '<div class="page-links"><span class="page-links-title">' . __('Pages:', 'twentysixteen') . '</span>',
                    'after' => '</div>',
                    'link_before' => '<span>',
                    'link_after' => '</span>',
                    'pagelink' => '<span class="screen-reader-text">' . __('Page', 'twentysixteen') . ' </span>%',
                    'separator' => '<span class="screen-reader-text">, </span>',
                ));

                if ('' !== get_the_author_meta('description')) {
                    get_template_part('template-parts/biography');
                }
                ?>
      </div>
      <!-- .entry-content --> 
    </div>
  </article>
  <!-- #post-## --> 
  
</div>
<!-- .post-page-content -->

<?php get_footer(); ?>

