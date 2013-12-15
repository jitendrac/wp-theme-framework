<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that other
 * 'pages' on your WordPress site will use a different template.
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

          <article id="post-<?php the_ID(); ?>" <?php post_class('panel ' . rainbowstrap_post_panel_style()); ?>>

            <header class="entry-header panel-heading">
              <?php if ( has_post_thumbnail() && ! post_password_required() ) : ?>
              <div class="entry-thumbnail">
                <?php the_post_thumbnail(); ?>
              </div>
              <?php endif; ?>

              <h1 class="entry-title text-primary"><?php the_title(); ?></h1>
            </header><!-- .entry-header -->

            <div class="entry-content panel-body">
              <?php the_content(); ?>
              <?php wp_link_pages( array( 'before' => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'rainbowstrap' ) . '</span>', 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>' ) ); ?>
            </div><!-- .entry-content -->

            <footer class="entry-meta panel-footer">
              <?php rainbowstrap_edit_link(); ?>
            </footer><!-- .entry-meta -->
          </article><!-- #post -->

          <?php comments_template(); ?>
        <?php endwhile; ?>

      </div><!-- #content -->
    </div><!-- #primary -->
    <div class="col-md-3">
      <?php get_sidebar(); ?>
    </div>
  </div>

<?php get_footer(); ?>