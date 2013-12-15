<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package EasyDevelopment
 * @subpackage Rainbow_strap
 * @since Rainbow strap 1.0
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<div id="content" class="site-content container" role="main">

			<header class="page-header">
				<h1 class="page-title text-danger"><?php _e( 'Page not found', 'rainbowstrap' ); ?></h1>
			</header>

			<div class="page-wrapper">
				<div class="page-content">
					<h2><?php _e( 'This is somewhat embarrassing, isn&rsquo;t it?', 'rainbowstrap' ); ?></h2>
					<p><?php _e( 'It looks like nothing was found at this location. Maybe try a search?', 'rainbowstrap' ); ?></p>

					<?php get_search_form(); ?>
				</div><!-- .page-content -->
			</div><!-- .page-wrapper -->

		</div><!-- #content -->
	</div><!-- #primary -->

<?php get_footer(); ?>