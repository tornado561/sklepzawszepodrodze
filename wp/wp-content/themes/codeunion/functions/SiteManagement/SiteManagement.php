<?php

  namespace SiteManagement;

  class SiteManagement
  {
    public function __construct()
    {
      define('SITE_CONFIG', require 'Config.php');
      new Helpers\_Core();
    }
  }
