<?php

namespace WPAdvanced\Features;

class DisableEmojis
{
	public function __construct()
	{
		// Zarejestruj akcję 'init', która wywoła metodę wyłączającą emocje
		add_action('init', [$this, 'disableEmojis']);
	}

	public function disableEmojis()
	{
		// Usuń skrypty i style związane z emotikonami
		remove_action('wp_head', 'print_emoji_detection_script', 7);
		remove_action('admin_print_scripts', 'print_emoji_detection_script');
		remove_action('wp_print_styles', 'print_emoji_styles');
		remove_action('admin_print_styles', 'print_emoji_styles');
		remove_filter('the_content_feed', 'wp_staticize_emoji');
		remove_filter('comment_text_rss', 'wp_staticize_emoji');
		remove_filter('wp_mail', 'wp_staticize_emoji_for_email');

		// Usuń emocje z TinyMCE
		add_filter('tiny_mce_plugins', [$this, 'disableEmojisTinyMCE']);
	}

	public function disableEmojisTinyMCE($plugins)
	{
		if (is_array($plugins)) {
			// Usuń plugin związany z emocjami
			return array_diff($plugins, ['wpemoji']);
		} else {
			return [];
		}
	}
}
