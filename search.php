<?php
/**
 * The template for displaying Search Results pages.
 *
 * @package EasyDevelopment
 * @subpackage Rainbow_strap
 * @since Rainbow strap 1.0
 */

get_header(); ?>
  <div class="row">
    <div id="primary" class="content-area col-md-9">
      <div id="content" class="site-content" role="main">
      <?php if ( have_posts() ) : ?>

        <header class="page-header">
          <h1 class="page-title"><?php printf( __( 'Search Results for: %s', 'rainbowstrap' ), get_search_query() ); ?></h1>
        </header>

        <?php /* The loop */ ?>
        <?php while ( have_posts() ) : the_post(); ?>
          <?php get_template_part( 'content', get_post_format() ); ?>
        <?php endwhile; ?>

        <?php rainbowstrap_paging_nav(); ?>

      <?php else : ?>
        <?php get_template_part( 'content', 'none' ); ?>
      <?php endif; ?>

      </div><!-- #content -->
    </div><!-- #primary -->
    <div class="col-md-3">
      <?php get_sidebar(); ?>
    </div>
  </div>

<?php get_footer(); ?>