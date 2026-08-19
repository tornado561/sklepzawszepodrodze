<?php


namespace WPAdvanced\Settings;


class ContactForm
{
  private $settings;

  public function __construct($settings)
  {
    $this->settings = $settings;

    if ($this->settings['disable-validation']) {
      add_filter('wpcf7_validate_configuration', '__return_false');
    }
  }
}