<?php
/**
 * The template for displaying Tag pages.
 *
 * Used to display archive-type pages for posts in a tag.
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
      <div class="panel panel-default">
        <div class="panel-heading">
          <h1><?php printf( __( 'Tag Archives : <span class="text-primary">%s</span>', 'rainbowstrap' ), single_tag_title( '', false ) ); ?></h1>
        </div>

        <?php if ( tag_description() ) : ?>
          <div class="panel-body">
            <?php echo tag_description(); ?>
          </div>
        <?php endif; ?>
      </div>
    </div>
    <div id="primary" class="content-area col-md-9">
      <div id="content" class="site-content" role="main">
        <?php if ( have_posts() ) : ?>
          <?php /* The loop */ ?>
          <?php while ( have_posts() ) : the_post(); ?>
            <?php get_template_part( 'content', get_post_format() ); ?>
          <?php endwhile; ?>

          <?php rainbowstrap_paging_nav(); ?>

        <?php else : ?>
          <?php get_template_part( 'content', 'none' ); ?>
        <?php endif; ?>

      </div>
    </div>
    <div class="col-md-3">
      <?php get_sidebar(); ?>
    </div>
  </div>

<?php get_footer(); ?>