<?php


namespace WPAdvanced\Menu;


class Adding
{
  private $core, $settings;

  public function __construct($core, $settings)
  {
    $this->core = $core;
    $this->settings = $settings;

    $this->generateMenu();
  }

  public function generateMenu()
  {
    if (!$this->settings) return;
    register_nav_menus($this->settings);
  }
}