<?php
/**
 * The template for displaying the header
 *
 * Displays all of the head element and everything up until the "site-content" div.
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<?php endif; ?>

<!--JS-->


<!-- Redirect to another page (for no-js support) (place it in your <head>) -->
<noscript>
<meta http-equiv="refresh" content="0;url=nojs-version.php">
</noscript>

<!-- Show a message -->
<noscript>
You don't have javascript enabled! Please download Google Chrome!
</noscript>
<?php wp_head();?>
</head>

<body <?php body_class(); ?>>
<?php $options = get_option( 'sample_theme_options' ); ?>
<div id="page" class="site">
<div class="site-inner">
<a class="skip-link screen-reader-text" href="#content">
<?php _e( 'Skip to content', 'twentysixteen' ); ?>
</a>
<script>
// jQuery( document ).ready(function() {
//   var firstimg = jQuery('.gallerythumbnail .imageContainer:first img').attr('src');
//   var extension = firstimg.substring(firstimg.lastIndexOf(".")); // gets the extension
// var imageName = firstimg.substring(0, firstimg.lastIndexOf(".")); // gets the file name
// imageName = imageName.replace(imageName.substring(imageName.length-8), ""); // replace the last 9 characters with empty string
// jQuery('.gallerythumbnail .imageContainer:first img').addClass('active_img');
// jQuery('.portfolio-big-image #showimagediv img').attr('src', imageName + extension);
//   console.log(imageName+extension);
// });
</script>
<header id="masthead" class="site-header">
  
  <!--.nav-section-->
  <div class="site-header-main">
    <div class="container-fluid">
      <div class="row">
      <div class="col-sm-6 col-xs-6 logo-section">
          <div class="site-branding"> 
		  <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
			<?php if(is_page_template('socialpantry-page-template.php')) { ?>
			 <img src="<?php echo get_template_directory_uri() ?>/images/The-Social-Pantry-Logo.svg" alt="logo" />	
			<?php } else{ ?>
			<img src="<?php echo get_template_directory_uri() ?>/images/social-hq-logo.svg" alt="logo" />
			<?php } ?>	
          </a> 
		</div>
          <!-- .site-branding --> 
        </div>
        <div class="col-sm-6 col-xs-6 nav-section">
         <?php if ( has_nav_menu( 'primary' ) || has_nav_menu( 'social' ) ) : ?>
      <button id="menu-toggle" class="menu-toggle"> <span class="genericon genericon-menu"></span> </button>
      <div id="site-header-menu" class="site-header-menu">
        <?php if ( has_nav_menu( 'primary' ) ) : ?>
        <nav id="site-navigation" class="main-navigation text-right" aria-label="<?php esc_attr_e( 'Primary Menu', 'twentysixteen' ); ?>">
          <?php
				wp_nav_menu( array(
				'theme_location' => 'primary',
				'menu_class'     => 'primary-menu',
				'link'    => 'test',
				 ) );
		?>
        </nav>
        <!-- .main-navigation -->
        <?php endif; ?>
      </div>
      <!-- .site-header-menu -->
      <?php endif; ?>
        </div>
        
      </div>
      <!--row--> 
    </div>
    <!--container--> 
  </div>
  <!-- .site-header-main --> 
</header>
<!-- .site-header -->
<div id="content" class="site-content">