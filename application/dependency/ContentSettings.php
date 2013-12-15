<?php

class ThemeControllerContentSettings {

  public $contentWidth = 0;

  public function __construct($settings = array()) {
    if(isset($settings['width']))
      $this->contentWidth = $settings['width'];
  }

}