<?php

class ThemeControllerInformation {

  public $themeName             = "";
  public $themeAlias            = "";
  public $themeWordPressVersion = '';

  public function __construct($information) {
    foreach($information as $key => $value) {
      $currentKey = lcfirst(str_replace(' ', '', ucwords(str_replace('_', ' ', $key))));
      $this->$currentKey = $value;
    }
  }

}