<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */
?>

</div><!-- .site-content -->
<?php if(is_front_page()) { ?>
<div class="instagram-wrapper">
	<?php echo do_shortcode('[instagram-feed]'); ?>
</div>
<?php } ?>
<?php $options = get_option('sample_theme_options'); ?>
<footer id="colophon" class="site-footer" role="contentinfo">
    <div class="container-fluid">
        <div class="row">
            <div class="social-links-icon col-sm-4">
                <ul>
                    <?php if ($options['fb_title']) { ?>
                        <li> <a target="_blank" class="genericon genericon-facebook-alt" href="<?php echo $options['fb_title']; ?>"><span class="screen-reader-text">Facebook</span></a> </li>
                    <?php } if ($options['insta_title']) { ?>
                        <li> <a target="_blank" class="genericon genericon-instagram" href="<?php echo $options['insta_title']; ?>"><span class="screen-reader-text">Instagram</span></a> </li>
                    <?php } if ($options['tw_title']) { ?>
                        <li> <a target="_blank" class="genericon genericon-twitter" href="<?php echo $options['tw_title']; ?>"><span class="screen-reader-text">Twitter</span></a> </li>
                    <?php } ?>
                </ul>
            </div>
            <div class="col-sm-8 site-info">
                <?php
                /**
                 * Fires before the twentysixteen footer text for footer customization.
                 *
                 * @since Twenty Sixteen 1.0
                 */
                do_action('twentysixteen_credits');
                ?>
                <span class="footer-site-title">Copyright <?php echo date("Y"); ?> <a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php bloginfo('name'); ?></a></span> &nbsp; / &nbsp; 
                <a target="_blank" href="<?php echo esc_url(__('http://firstflightstudio.com/', 'twentysixteen')); ?>"><?php printf(__('Fuelled by first flight', 'twentysixteen'), 'WordPress'); ?></a>

            </div><!-- .site-info -->

        </div><!--row-->
    </div>

</footer><!-- .site-footer -->
</div><!--site-inner-->
</div><!-- .site -->

<script src="<?php echo get_template_directory_uri();?>/js/custom.js" type="text/javascript"> </script>
<?php wp_footer(); ?>
</body>
</html>
