<?php

class ThemeControllerExtensionThemeSupportCustomBackground {

  public function __construct() {

  }

  public function setupParams() {
    return array(
      $this->_getExtensionName(),
      $this->_fetchSettingsArray()
    );
  }

  private function _getExtensionName() {
    return 'custom-background';
  }

  private function _fetchSettingsArray() {
    return array(
      'default-color' => '#ffffff'
    );
  }
}