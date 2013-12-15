<?php
/**
 * The Template for displaying all single posts.
 *
 * @package EasyDevelopment
 * @subpackage Rainbow_strap
 * @since Rainbow strap 1.0
 */

get_header(); ?>

  <div class="row">
    <div id="primary" class="content-area col-md-9">
      <div id="content" class="site-content" role="main">

        <?php /* The loop */ ?>
        <?php while ( have_posts() ) : the_post(); ?>

          <?php get_template_part( 'content', get_post_format() ); ?>
          <?php rainbowstrap_post_nav(); ?>
          <?php comments_template(); ?>

        <?php endwhile; ?>

      </div><!-- #content -->
    </div><!-- #primary -->
    <div class="col-md-3">
      <?php get_sidebar(); ?>
    </div>
    <div class="clearfix"></div>
  </div>

<?php get_footer(); ?>