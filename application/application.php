<?php

class ThemeController {

  protected static $_instance;

  public static function getInstance() {
    if(is_null(self::$_instance))
      self::$_instance = new self();

    return self::$_instance;
  }

  private $_settingsMap = array(
    'content' => array(
      'width'     => '604'
    ),
    'information' => array(
      'theme_name'              => 'Rainbow Strap',
      'theme_alias'             => 'rainbowstrap',
      'theme_wordpress_version' =>  '3.6-alpha'
    ),
    'support'     => array(
      'html5'                => array('search-form', 'comment-form', 'comment-list'),
      'post-formats'         => array('aside', 'audio', 'chat', 'gallery', 'image', 'link', 'quote', 'status', 'video'),
      'automatic-feed-links' => true,
      'post-thumbnails'      => array(604, 270, true),
      'navigation-menu'      => array('primary', 'Navigation Menu')
    ),
    'assets'      => array(
      'last-update' => '2013-07-18',
      'options'     => array('comment-reply'),
      'assets'      => array(
        array(
          'type'        =>  'js',
          'name'        =>  '_script',            // Automatically has the prefix added if you start with _
          'patch'       =>  '_/js/functions.js',  // Automatically has the theme_patch added if you start with _
          'dependency'  =>  array('jquery'),
          'in_footer'   =>  true
        ),
        array(
          'type'        =>  'js',
          'name'        =>  'bootstrap',            // Automatically has the prefix added if you start with _
          'patch'       =>  '_/js/bootstrap.min.js',  // Automatically has the theme_patch added if you start with _
          'dependency'  =>  array('jquery'),
          'in_footer'   =>  true
        ),
        array(
          'type'        =>  'js',
          'name'        =>  'parallax',            // Automatically has the prefix added if you start with _
          'patch'       =>  '_/js/jquery.parallax.js',  // Automatically has the theme_patch added if you start with _
          'dependency'  =>  array('jquery'),
          'in_footer'   =>  true
        ),
        array(
          'type'        =>  'style',
          'name'        =>  'style',    // Automatically add the stylesheet url
          'patch'       =>  '%',        // Automatically has the theme_patch added if you start with _
          'dependency'  =>  array()
        )
      )
    )
  );

  public $applicationPath;

  /**
   * @var ThemeControllerContentSettings
   */
  public $contentSettings;
  /**
   * @var ThemeControllerInformation
   */
  public $information;

  public function __construct() {
    $this->applicationPath = dirname(__FILE__) . DIRECTORY_SEPARATOR;

    $this->_loadDependency();
    $this->_setDependency();
    $this->_loadExtensions();

    add_theme_support( 'woocommerce' );
  }

  private function _loadDependency() {
    require_once('loader.php');
    ThemeControllerLoader::getInstance()->load($this->applicationPath . 'dependency' . DIRECTORY_SEPARATOR);
  }

  private function _setDependency() {
    $this->contentSettings = new ThemeControllerContentSettings($this->_settingsMap['content']);
    $this->information     = new ThemeControllerInformation($this->_settingsMap['information']);
  }

  private function _loadExtensions() {
    ThemeControllerLoader::getInstance()->load($this->applicationPath . 'extensions' . DIRECTORY_SEPARATOR);
  }

  public function getSettingGroup($name) {
    return isset($this->_settingsMap[$name]) ? $this->_settingsMap[$name] : array();
  }

}

ThemeController::getInstance();