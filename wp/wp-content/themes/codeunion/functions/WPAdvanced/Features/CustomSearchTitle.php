<?php

namespace WPAdvanced\Features;

class CustomSearchTitle
{
	public function __construct()
	{
		add_filter('wpseo_title', [$this, 'filterYoastSearchTitle']);
	}

	public function filterYoastSearchTitle(string $title): string
	{
		if (!is_search()) {
			return $title;
		}

		$query = get_search_query();
		$siteName = get_bloginfo('name');

		if (!$query) {
			return __('Wyszukiwarka', 'codeunion') . ' - ' . $siteName;
		}

		return __('Wyniki wyszukiwania dla:', 'codeunion') . ' ' . esc_html($query) . ' - ' . $siteName;
	}
}
