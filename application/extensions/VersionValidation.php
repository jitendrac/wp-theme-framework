<?php

class ThemeControllerExtensionVersionValidation {

  protected static $_instance;

  public static function getInstance() {
    if(is_null(self::$_instance))
      self::$_instance = new self();

    return self::$_instance;
  }

  public function __construct() {
    if ( version_compare( $GLOBALS['wp_version'], ThemeController::getInstance()->information->themeWordPressVersion, '<' ) ) {
      add_action( 'after_switch_theme', array($this, 'switchToDefaultTheme') );
      add_action( 'load-customize.php', array($this, 'onCustomizeDisplay') );
      add_action( 'template_redirect', array($this, 'onCustomizeDisplay') );
    }
  }

  public function switchToDefaultTheme() {
    switch_theme( WP_DEFAULT_THEME, WP_DEFAULT_THEME );
    unset( $_GET['activated'] );
    add_action( 'admin_notices', array($this, 'adminUpgradeNotice') );
  }

  public function adminUpgradeNotice() {
    $message = sprintf(
      __( ThemeController::getInstance()->information->themeName .
          ' requires at least WordPress version '
            . ThemeController::getInstance()->information->themeWordPressVersion
            . '. You are running version %s. Please upgrade and try again.',
          ThemeController::getInstance()->information->themeAlias ), $GLOBALS['wp_version'] );
    printf( '<div class="error"><p>%s</p></div>', $message );
  }

  public function onCustomizeDisplay() {
    wp_die( sprintf( __( ThemeController::getInstance()->information->themeName . ' requires at least WordPress version '
        . ThemeController::getInstance()->information->themeWordPressVersion
        . '. You are running version %s. Please upgrade and try again.',
          ThemeController::getInstance()->information->themeAlias
        ), $GLOBALS['wp_version'] ), '', array(
      'back_link' => true,
    ) );
  }
}

ThemeControllerExtensionVersionValidation::getInstance();