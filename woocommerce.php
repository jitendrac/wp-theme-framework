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

        <?php woocommerce_content(); ?>

      </div><!-- #content -->
    </div><!-- #primary -->
    <div class="col-md-3">
      <?php get_sidebar(); ?>
    </div>
  </div>

<?php get_footer(); ?>