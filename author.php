<?php
/**
 * The template for displaying Author archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package EasyDevelopment
 * @subpackage Rainbow_strap
 * @since Rainbow strap 1.0
 */

get_header(); ?>

  <div class="row">
    <div class="col-md-12">
      <?php if ( have_posts() ) : ?>

        <?php
        /* Queue the first post, that way we know
         * what author we're dealing with (if that is the case).
         *
         * We reset this later so we can run the loop
         * properly with a call to rewind_posts().
         */
        the_post();
        ?>
        <div class="panel panel-default">
          <div class="panel-heading">
            <h1 class="archive-title"><?php printf( __( 'All posts by %s', 'rainbowstrap' ), '<span class="vcard"><a class="text-primary url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '" title="' . esc_attr( get_the_author() ) . '" rel="me">' . get_the_author() . '</a></span>' ); ?></h1>
          </div>
        </div>
        <?php
        /* Since we called the_post() above, we need to
         * rewind the loop back to the beginning that way
         * we can run the loop properly, in full.
         */
        rewind_posts();
        ?>
      <?php endif;?>
    </div>
  </div>
  <div class="row">
    <div id="primary" class="content-area col-md-9">
      <div id="content" class="site-content" role="main">

      <?php if ( have_posts() ) : ?>

        <?php
          /* Queue the first post, that way we know
           * what author we're dealing with (if that is the case).
           *
           * We reset this later so we can run the loop
           * properly with a call to rewind_posts().
           */
          the_post();
        ?>

        <?php
          /* Since we called the_post() above, we need to
           * rewind the loop back to the beginning that way
           * we can run the loop properly, in full.
           */
          rewind_posts();
        ?>

        <?php if ( get_the_author_meta( 'description' ) ) : ?>
          <?php get_template_part( 'author-bio' ); ?>
        <?php endif; ?>

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