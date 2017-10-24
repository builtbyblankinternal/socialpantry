<?php
    /*
    Template Name: Home Page
    */
    get_header(); ?>
<section class="banner-section wheight">
    <div id="carousel-generic" class="carousel slide" data-ride="carousel">
	
        <?php 
            $i=0;
            query_posts('post_type=slider-post&showposts=-1&order=DESC'); ?>
        <ol class="carousel-indicators">
          <?php 
          if ( have_posts() ) : 
            while ( have_posts() ) : the_post(); ?>
              <li data-target="#carousel-generic" data-slide-to="<?php echo $i; ?>" class="<?php if ($i == 0) echo 'active'; ?>"></li>
              <?php $i++; 
            endwhile; ?>
          <?php else: ?>
            <li data-target="#carousel-generic" data-slide-to="0" class="active"></li>
          <?php endif; ?>
        </ol>
        <!-- Wrapper for slides -->
        <div class="carousel-inner" role="listbox">
            
            <?php 
              $i=1;
              $myloop = new WP_Query('post_type=slider-post&showposts=-1&order=DESC'); 
            ?>

            <?php 
            if ( $myloop->have_posts() ) : 
              while ( $myloop->have_posts() ) : $myloop->the_post(); ?>
              
                <div class="item <?php if ($i == 1) echo 'active'; ?>">
                  <div class="fill" style="background-image:url('<?php if( has_post_thumbnail() ){ the_post_thumbnail_url('1920x1080'); } else { echo 'http://placehold.it/1920x1080'; } ?>');">
                  </div>
                  <div class="carousel-caption">
                      <?php $myloop->the_content(); ?>
                  </div>
                </div>
              <?php $i++; endwhile;  wp_reset_query();
            else: ?>
                  <div class="item active">
                    <div class="fill" style="background-image:url('http://placehold.it/1920x1080')"></div>
                    <div class="carousel-caption"></div>
                  </div>
            <?php endif; ?>
        </div>
        
    </div>
    </div>
</section>
<!-- .content-area -->
<?php get_footer(); ?>