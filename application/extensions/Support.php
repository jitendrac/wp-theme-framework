<?php

class ThemeControllerExtensionSupport {

  protected static $_instance;

  /**
   * @return ThemeControllerExtensionSupport
   */
  public static function getInstance() {
    if(is_null(self::$_instance))
      self::$_instance = new self();

    return self::$_instance;
  }

  public $html5             = array();
  public $postFormats       = array();
  public $automaticFeedLink = false;
  public $postThumbnails    = false;
  public $navigationMenu    = false;

  public function __construct() {
    $this->updateSettings(ThemeController::getInstance()->getSettingGroup('support'));

    add_action( 'after_setup_theme', array($this, 'afterThemeSetup') );
  }

  public function updateSettings($information) {
    foreach($information as $key => $value) {
      $currentKey = lcfirst(str_replace(' ', '', ucwords(str_replace(array('_', '-'), ' ', $key))));
      $this->$currentKey = $value;
    }
  }

  public function afterThemeSetup() {
    if(is_array($this->html5) && !empty($this->html5))
      add_theme_support( 'html5', array( $this->html5 ) );

    if(is_array($this->postFormats) && !empty($this->postFormats))
      add_theme_support( 'post-formats', $this->postFormats );

    if($this->automaticFeedLink == true)
      add_theme_support( 'automatic-feed-links' );

    if($this->postThumbnails != false) {
      add_theme_support( 'post-thumbnails' );

      if(is_array($this->postThumbnails))
        call_user_func('set_post_thumbnail_size', $this->postThumbnails);
    }

    if(is_array($this->navigationMenu)
        && isset($this->navigationMenu[0])
        && isset($this->navigationMenu[1]))
      register_nav_menu($this->navigationMenu[0], __($this->navigationMenu[1]));
  }

}

ThemeControllerExtensionSupport::getInstance();