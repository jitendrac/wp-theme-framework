<?php

class ThemeControllerExtensionThemeSupportCustomHeader {

  public $defaultImage          = '';
  public $randomDefault         = false;
  public $width                 = 0;
  public $height                = 0;
  public $flexWidth             = false;
  public $flexHeight            = false;
  public $defaultTextColor      = '';
  public $headerText            = true;
  public $uploads               = true;
  public $wpHeadCallBack        = '';
  public $adminHeadCallBack     = '';
  public $adminPreviewCallBack  = '';

  public function __construct() {
    $this->wpHeadCallBack       = array($this, 'internalWPHeadCallBack');
    $this->adminHeadCallBack    = array($this, 'internalAdminHeadCallBack');
    $this->adminPreviewCallBack = array($this, 'internalAdminPreviewCallBack');
  }

  public function setupParams() {
    return array(
      $this->_getExtensionName(),
      $this->_fetchSettingsArray()
    );
  }

  private function _getExtensionName() {
    return 'custom-header';
  }

  private function _fetchSettingsArray() {
    return array(
      'default-image'          => $this->defaultImage,
      'random-default'         => $this->randomDefault,
      'width'                  => $this->width,
      'height'                 => $this->height,
      'flex-height'            => $this->flexHeight,
      'flex-width'             => $this->flexWidth,
      'default-text-color'     => $this->defaultTextColor,
      'header-text'            => $this->headerText,
      'uploads'                => $this->uploads,
      'wp-head-callback'       => $this->wpHeadCallBack,
      'admin-head-callback'    => $this->adminHeadCallBack,
      'admin-preview-callback' => $this->adminPreviewCallBack,
    );
  }

  public function internalWPHeadCallBack() {
    $text_color = get_header_textcolor();

    // If no custom options for text are set, let's bail
    if ( $text_color == get_theme_support( 'custom-header', 'default-text-color' ) )
      return;

    $css =  '<style type="text/css">';

      if ( ! display_header_text() )
        $css .= '.site-title, .site-description { display:none;}';
      else
        $css .= '.site-title, .site-description { color: #' . $text_color . ';}' .
                '.site-title > a { color : inherit;}';
    $css .= '</style>';

    echo $css;
  }

  public function internalAdminHeadCallBack() {

  }

  public function internalAdminPreviewCallBack() {
?>
<div id="headimg">
  <?php
  if ( ! display_header_text() )
    $style = ' style="display:none;"';
  else
    $style = ' style="color:#' . get_header_textcolor() . ';"';
  ?>
  <h1><a id="name"<?php echo $style; ?> onclick="return false;" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a></h1>
  <h2 id="desc"<?php echo $style; ?>><?php bloginfo( 'description' ); ?></h2>
  <?php $header_image = get_header_image();
  if ( ! empty( $header_image ) ) : ?>
    <img src="<?php echo esc_url( $header_image ); ?>" class="header-image" width="<?php echo get_custom_header()->width; ?>" height="<?php echo get_custom_header()->height; ?>" alt="" />
  <?php endif; ?>
</div><?php
  }
}