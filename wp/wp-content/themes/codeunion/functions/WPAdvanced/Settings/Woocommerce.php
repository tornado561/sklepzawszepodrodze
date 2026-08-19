<?php

namespace WPAdvanced\Settings;

class Woocommerce
{
  public function __construct()
  {
    add_action( 'after_setup_theme', [$this, 'theme_woocommerce_support'], 99 );
  }

  public function theme_woocommerce_support() {
    add_theme_support( 'woocommerce' );
  }
}

