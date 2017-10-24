<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */

get_header(); ?>

<div class="container-fluid page-sidebar-content">
  <div class="row">
    <div class="col-sm-9">
      <div class="sidebar-page-left">
        <section class="error-404 not-found">
          <header class="page-header">
            <h1 class="page-title">
              <?php _e( 'Oops! That page can&rsquo;t be found.', 'twentysixteen' ); ?>
            </h1>
          </header>
          <!-- .page-header -->
          
          <div class="page-content">
            <p>
              <?php _e( 'It looks like nothing was found at this location. Maybe try a search?', 'twentysixteen' ); ?>
            </p>
            <?php get_search_form(); ?>
          </div>
          <!-- .page-content --> 
        </section>
        <!-- .error-404 --> 
      </div>
    </div>
    <!--col9-->
    <div class="col-sm-3 sidebar-right">
      <?php get_sidebar(); ?>
    </div>
  </div>
  <!--row--> 
</div>
<?php get_sidebar( 'content-bottom' ); ?>
<?php get_footer(); ?>
