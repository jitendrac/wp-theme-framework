<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package EasyDevelopment
 * @subpackage Rainbow_strap
 * @since Rainbow strap 1.0
 */
?><!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width">
	<title><?php wp_title( '|', true, 'right' ); ?></title>
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<!--[if lt IE 9]>
	<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js"></script>
	<![endif]-->
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

	<div id="page" class="hfeed site">
		<header id="masthead" class="site-header" role="banner">
      <div class="background" style="background: url('<?php header_image() ?>');min-height: 200px;">
        <div class="container">
          <h1 class="site-title text-primary"><a href="<?php echo home_url( '/' ); ?>"><?php bloginfo('name');?></a></h1>
          <h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
        </div>
      </div>
      <div id="navbar" class="navbar navbar-inverse navbar-static">
        <div class="container no-padding">
          <div class="navbar-header">
            <button data-target="#navbar .navbar-collapse" data-toggle="collapse" class="navbar-toggle" type="button">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
          </div>
          <div class="collapse navbar-collapse">
            <?php wp_nav_menu(
                      array(
                        'container'       => 0,
                        'menu_class'      => 'nav navbar-nav',
                        'theme_location'  => 'primary',
                        'fallback_cb'     => false,
                        'walker'          => new ThemeControllerExtensionNavWalker()
                      )
                  ); ?>
            <ul class="nav navbar-nav navbar-right">
              <li>
                <a class="screen-reader-text skip-link btn btn-link left" href="#content" title="<?php esc_attr_e( 'View Content', 'rainbowstrap' ); ?>"><?php _e( 'View Content', 'rainbowstrap' ); ?></a>
              </li>
            </ul>
            <form role="search" method="get" class="navbar-form navbar-right" action="<?php echo home_url( '/' ); ?>" >
              <div class="form-group">
                <input class="form-control" type="text" value="<?php echo get_search_query(); ?>" placeholder="<?php echo __('Search...');?>" name="s" id="s" />
              </div>
              <button class="btn btn-primary" type="submit"><?php echo __( 'Search' ); ?></button>
            </form>
          </div>
        </div>
      </div>
    </header><!-- #masthead -->

		<div id="main" class="site-main container">
