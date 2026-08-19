<?php

namespace WPAdvanced\PostTypes;

class PostType
{
  private $name = '';
  private $args = [];

  public function __construct($name, $args)
  {
    $this->name = $name;
    $this->args = $args;

    add_action('init', [$this, 'create'], 0);
  }

  public function create()
  {
    register_post_type($this->name, $this->args);
  }
}
