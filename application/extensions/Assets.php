<?php

class ThemeControllerExtensionAssets {

  protected static $_instance;

  /**
   * @return ThemeControllerExtensionAssets
   */
  public static function getInstance() {
    if(is_null(self::$_instance))
      self::$_instance = new self();

    return self::$_instance;
  }

  public $lastUpdate = '';
  public $options    = array();
  public $assets     = array();

  public function __construct() {
    $this->updateSettings(ThemeController::getInstance()->getSettingGroup('assets'));

    add_action( 'wp_enqueue_scripts', array($this, 'enqueScripts') );
  }

  public function updateSettings($information) {
    foreach($information as $key => $value) {
      $currentKey = lcfirst(str_replace(' ', '', ucwords(str_replace('_', ' ', $key))));
      $this->$currentKey = $value;
    }
  }

  public function enqueScripts() {
    if(in_array('comment-reply', $this->options)
        && (is_singular() && comments_open() && get_option( 'thread_comments' )))
        wp_enqueue_script( 'comment-reply' );

    foreach($this->assets as $asset) {
      if(isset($asset['type'])) {

        $assetName = ($asset['name'][0] == '_'
            ? ThemeController::getInstance()->information->themeAlias . substr($asset['name'], 1)
            : $asset['name']
        );

        if($asset['type'] == 'js') {
          wp_enqueue_script(
            $assetName,
            ($asset['patch'][0] == '_'
                ? get_template_directory_uri() . substr($asset['patch'], 1)
                : $asset['patch']
            ),
            (isset($asset['dependency']) ? $asset['dependency'] : array()),
            $this->lastUpdate,
            (isset($asset['in_footer']) ? $asset['in_footer'] : false)
          );
        } else if($asset['type'] == 'style') {
          wp_enqueue_style(
            $assetName,
            ($asset['patch'][0] == '_'
                ? get_template_directory_uri() . substr($asset['patch'], 1)
                : ($asset['patch'][0] == '%' ? get_stylesheet_uri() : $asset['patch'])
            ),
            (isset($asset['dependency']) ? $asset['dependency'] : array()),
            $this->lastUpdate
          );

          if(isset($asset['data']))
            foreach($asset['data'] as $key => $value)
              wp_style_add_data( $assetName, $key, $value );
        }
      }
    }
  }

}

ThemeControllerExtensionAssets::getInstance();