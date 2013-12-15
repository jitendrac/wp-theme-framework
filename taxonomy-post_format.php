<?php
/**
 * The template for displaying Post Format pages.
 *
 * Used to display archive-type pages for posts with a post format.
 * If you'd like to further customize these Post Format views, you may create a
 * new template file for each specific one.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
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
        <header class="archive-header">
          <h1 class="archive-title"><?php printf( __( '%s Archives', 'rainbowstrap' ), '<span>' . get_post_format_string( get_post_format() ) . '</span>' ); ?></h1>
        </header><!-- .archive-header -->

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