<?php
/**
 * The template part for displaying single posts
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */
 global $post;
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

<header class="entry-header">
<div class="container">
    	<div class="gallery gallery-columns-2">
            <?php 
                $imgs = get_post_meta( $post->ID, 'gallery_images_blog', true );
                if($imgs[0] != ""){
                    foreach ( $imgs as $src ){
                        $image_id = rnd_get_image_id($src);
                        $img_url = wp_get_attachment_image_src($image_id,'400x520', true);
                        echo '<figure class="gallery-item"><div class="gallery-icon landscape"><img src="'.esc_url( $img_url[0] ).'"></div></figure>';
                    }
                }
            ?>
           </div><!--gallery-->
			<?php the_title( '<h4 class="entry-title">', '</h4>' ); ?>
            <ul class="list-inline single-post-auther">
            <li><?php the_time('jS F, Y');?></li>
            <li><?php the_author(); ?></li>
           <?php $cats = array();
			foreach (get_the_category($post_id) as $c) {
				$cat = get_category($c);
				array_push($cats, $cat->name);
			}
			if(!in_array('Uncategorized',$cats)){
				if (sizeOf($cats) > 0) {
					$post_categories = implode(' , ', $cats);
				} 
			?>
			<li><?php 
			if($post_categories !=""){
				$category_id = get_cat_ID( $post_categories );
				$category_link  = get_category_link( $category_id );
				
				echo '<span><a href="'.$category_link.'">'.strtoupper($post_categories).'</a></span>';
			}?></li>
             <?php }?>
			
			
            </ul>
        </div>
	</header><!-- .entry-header -->
	

	<?php // twentysixteen_excerpt(); ?>
    <div class="container">
	<div class="entry-content">
		<?php
			the_content();

			wp_link_pages( array(
				'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'twentysixteen' ) . '</span>',
				'after'       => '</div>',
				'link_before' => '<span>',
				'link_after'  => '</span>',
				'pagelink'    => '<span class="screen-reader-text">' . __( 'Page', 'twentysixteen' ) . ' </span>%',
				'separator'   => '<span class="screen-reader-text">, </span>',
			) );

			if ( '' !== get_the_author_meta( 'description' ) ) {
				get_template_part( 'template-parts/biography' );
			}
			?>
	</div><!-- .entry-content -->
    <div class="post-tag">
<?php
			$posttags = get_the_tags();
			if ($posttags) {
			  foreach($posttags as $tag) {
			    echo $tag->name . ' &nbsp; | &nbsp; '; 
			  }
			}
			?>
            </div>
    </div><!--container-->
</article><!-- #post-## -->
