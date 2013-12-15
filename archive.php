<?php
/**
 * The template for displaying Archive pages.
 *
 * Used to display archive-type pages if nothing more specific matches a query.
 * For example, puts together date-based pages if no date.php file exists.
 *
 * If you'd like to further customize these archive views, you may create a
 * new template file for each specific one. For example, Rainbow strap
 * already has tag.php for Tag archives, category.php for Category archives,
 * and author.php for Author archives.
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
          <h1 class="archive-title"><?php
            if ( is_day() ) :
              printf( __( 'Daily Archives: %s', 'rainbowstrap' ), get_the_date() );
            elseif ( is_month() ) :
              printf( __( 'Monthly Archives: %s', 'rainbowstrap' ), get_the_date( _x( 'F Y', 'monthly archives date format', 'rainbowstrap' ) ) );
            elseif ( is_year() ) :
              printf( __( 'Yearly Archives: %s', 'rainbowstrap' ), get_the_date( _x( 'Y', 'yearly archives date format', 'rainbowstrap' ) ) );
            else :
              _e( 'Archives', 'rainbowstrap' );
            endif;
          ?></h1>
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