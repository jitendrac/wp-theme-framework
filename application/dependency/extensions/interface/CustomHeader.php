<?php

interface ThemeControllerExtensionInterfaceCustomHeader {

  public function isThemeSupport();

  public function internalWPHeadCallBack();

  public function internalAdminHeadCallBack();

  public function internalAdminPreviewCallBack();

  public function getExtensionName();

  public function fetchSettingsArray();

}