<?php

class ThemeControllerExtensionCustomize {

  protected static $_instance;

  /**
   * @return ThemeControllerExtensionCustomize
   */
  public static function getInstance() {
    if(is_null(self::$_instance))
      self::$_instance = new self();

    return self::$_instance;
  }

  private $_customizeDirectory = array(
    'theme-support'       => 'add_theme_support',
    'theme-customization' => 'add_action|customize_register',
  );

  public $customizeExtensionsPath;

  public function __construct() {
    $this->customizeExtensionsPath = dirname(__FILE__) . DIRECTORY_SEPARATOR . 'customize' . DIRECTORY_SEPARATOR;

    add_action( 'after_setup_theme', array($this, 'afterThemeSetup') );
  }

  public function afterThemeSetup() {
    foreach($this->_customizeDirectory as $directoryName => $directoryHandler) {
      $currentDirectoryClassPrefix =
          'ThemeControllerExtension' .
              (str_replace(' ', '', ucwords(str_replace('-', ' ', $directoryName))));
      $currentDirectoryPath        = $this->customizeExtensionsPath . $directoryName;
      $currentDirectoryFiles       = ThemeControllerLoader::getInstance()->getLoaded($currentDirectoryPath);

      foreach($currentDirectoryFiles as $file) {
        $className = $currentDirectoryClassPrefix . substr($file, strlen($currentDirectoryPath) + 1, -4);
        $instanceObject = new $className();
        $instanceParams = $instanceObject->setupParams();

        if(strpos($directoryHandler, '|') !== false) {
          $params           = explode(
                                '|',
                                substr($directoryHandler, strpos($directoryHandler, '|') + 1)
                              );
          $directoryHandler = substr($directoryHandler, 0, strpos($directoryHandler, '|'));

          $instanceParams = array_merge($params, $instanceParams);
        }

        call_user_func_array($directoryHandler, $instanceParams);
      }
    }
  }

}

ThemeControllerExtensionCustomize::getInstance();