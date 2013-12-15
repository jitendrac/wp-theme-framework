<?php

class ThemeControllerExtensionThemeCustomizationSkinHandler  {

  public $sectionAlias = 'skin_handler';
  public $sectionTitle = 'Bootstrap Skin';

  public $settingSkinAlias      = 'skin_handler';
  public $settingSkinNameAlias  = 'name';

  public function __construct() {
    $this->sectionAlias         = ThemeController::getInstance()->information->themeAlias . $this->sectionAlias;
    $this->settingSkinAlias     = ThemeController::getInstance()->information->themeAlias . $this->settingSkinAlias;
    $this->settingSkinNameAlias = $this->settingSkinAlias . '_' . $this->settingSkinNameAlias;

    add_action('wp_head', array($this, 'frontIntegration'));
  }

  public function setupParams() {
    return array(
      array($this, 'wordPressHook')
    );
  }

  /**
   * @param WP_Customize_Manager $wp_customize
   */
  public function wordPressHook($wp_customize) {
    $wp_customize->add_section( $this->sectionAlias , array(
      'title'      => __($this->sectionTitle),
      'priority'   => 30,
    ) );

    $wp_customize->add_setting( $this->settingSkinNameAlias, array(
      'default'        => 0,
      'type'           => 'option',
      'capability'     => 'edit_theme_options',
    ) );

    $wp_customize->add_control( $this->settingSkinNameAlias, array(
      'section'    => $this->sectionAlias,
      'settings'   => $this->settingSkinNameAlias,
      'type'       => 'radio',
      'choices'    => $this->getBootstrapSkinList(),
    ) );
  }

  public function frontIntegration() {
    $currentSkin = get_option($this->settingSkinNameAlias, false);

    if($currentSkin != false)
      echo '<link rel="stylesheet" id="custom-skin"  href="' . get_template_directory_uri() . '/css-themes/' . $currentSkin . '" type="text/css" media="all" />';
  }

  public function getBootstrapSkinList() {
    $ret = array(
      0 => 'Classic'
    );

    if ($directory_handler = opendir(get_template_directory() . DIRECTORY_SEPARATOR . 'css-themes')) {
      while (false !== ($request_handler = readdir($directory_handler))) {
        if($request_handler !== '.' && $request_handler !== '..'){
          $ret[$request_handler] = ucwords(str_replace('-', ' ', substr($request_handler, 0, -4)));
        }
      }
    }

    return $ret;
  }
}