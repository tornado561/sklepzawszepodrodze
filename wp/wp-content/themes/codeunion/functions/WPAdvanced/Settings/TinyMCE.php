<?php


namespace WPAdvanced\Settings;


class TinyMCE
{
  private $settings;

  public function __construct( $settings )
  {
    $this->settings = $settings;

    add_action('init', [$this, 'editorSupport']);
    add_filter('mce_buttons', [$this, 'firstLineButtons'], 99);
    add_filter('mce_buttons_2', [$this, 'secondLineButtons'], 99);
    add_filter('tiny_mce_before_init', [$this, 'customColorsOptions']);
    add_action('tiny_mce_before_init', [$this, 'changeBlockFormats']);
  }

  /**
   * @param $init
   * @return array
   */
  public function customColorsOptions($init) : array
  {
    $init['textcolor_map'] = '['.$this->settings['colors'].']';

    return $init;
  }

  public function editorSupport() : void
  {
    if (!isset($this->settings['pages_editor']) || $this->settings['pages_editor']) return;
    remove_post_type_support('page', 'editor');
  }

  /**
   * @param $buttons
   * @return array
   */
  public function firstLineButtons($buttons) : array
  {
    if (!isset($this->settings['buttons_1'])) return $buttons;
    return $this->settings['buttons_1'];
  }

  /**
   * @param $settings
   * @return array
   */
  public function changeBlockFormats($settings) : array
  {
    if (!isset($this->settings['formats']) || !$this->settings['formats']) return $settings;

    $formats = [];
    foreach ($this->settings['formats'] as $block => $name) {
      $formats[] = $name.'='.$block.';';
    }

    $settings['block_formats'] = implode('', $formats);
    return $settings;
  }

  /**
   * @param $buttons
   * @return array
   */
  public function secondLineButtons($buttons) : array
  {
    if (!isset($this->settings['buttons_2'])) return $buttons;
    return $this->settings['buttons_2'];
  }
}