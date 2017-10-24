<?php
/**
 * The template for displaying all single posts and attachments
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */

get_header(); ?>

<div id="primary" class="post-page-content">

<script type="text/javascript">
$(document).ready(function(){
    var imageClicked = $( ".first img" ).addClass('active_img');
    var imgpath = $( ".first img" ).attr('src');
    //var imgpath = $( ".thumb-first" ).attr('data-src',imgpath);
    $('#showimagediv').html('<img src='+imgpath+'>');
    
    $('img').on( "click",function(){
        imageClicked = $(this);
        imgpath = $(this).attr('src');
        // var imgpathsrc = imgpath.replace("-250x250", "");
        var imgpathsrc = $(this).parent().attr('data-src');
        console.log(imgpathsrc);
        $('#showimagediv').html('<img src='+imgpathsrc+'>');
    });
    $( "body" ).on( "click", "img", function() {
        $("img").removeClass('active_img');
        imageClicked = $(this);
        imageClicked = $(this).addClass('active_img');
        imgpath = $(this).attr('src');
        //var imgpathsrc = imgpath.replace("-250x250", "");
        var imgpathsrc = $(this).parent().attr('data-src');
        console.log(imgpathsrc);
        $('#showimagediv').html('<img src='+imgpathsrc+'>');
    });
    $('.next').on( "click",function(){
        imageClicked.closest('.imageContainer').next().find('img').trigger('click');
    });

    $('.prev').on( "click",function(){
        imageClicked.closest('.imageContainer').prev().find('img').trigger('click');
    });
 
});</script>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
<div class="gallery-single-page">
    <div id="showimagediv" class="container-fluid"></div>
    <span class="first" style="display:none;">
    <?php if ( has_post_thumbnail() ) { ?>
            <a href="<?php the_permalink(); ?>">
            <?php the_post_thumbnail('full'); ?>
            </a>
            <?php } else { ?>
            <a href="<?php the_permalink(); ?>"> <img src="http://placehold.it/1100x725" alt="placeholder" title="placeholder" /></a>
            <?php } ?>
    </span>
    <div class="thumbnail-section">
        <div class="container">
            <div class="gallerythumbnail">
                <?php 
                // echo the_post_thumbnail_url('gallery-img-2');
                // die('here');
                    // echo '<div class="imageContainer"><span class="post_name" style="display:none"></span><span class="thumb" data-src="'.the_post_thumbnail_url('gallery-img-2').'">'.the_post_thumbnail('box-img').'</span></div>';
                    $imgs = get_post_meta( $post->ID, 'gallery_images_gallery', true);
                    if($imgs[0] != ""){
                        foreach ( $imgs as $src ){
                            $image_id = rnd_get_image_id($src);
                            $img_url = wp_get_attachment_image_src($image_id,'full', true);
                            $box_url = wp_get_attachment_image_src($image_id,'300x300', true);
                            echo '<div class="imageContainer"><span class="post_name" style="display:none"></span><span class="thumb" data-src="'.$img_url[0].'"><img src="'.$box_url[0].'"></span></div>';
                           
                        }
                    } ?>
            </div>
        </div><!--container-->
    </div><!--thumbnail-section-->
</div>
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
    </div>
</article><!-- #post-## -->     	
</div><!-- .post-page-content -->
<?php get_footer(); ?>

