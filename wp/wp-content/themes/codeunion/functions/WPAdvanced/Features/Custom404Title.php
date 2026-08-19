<?php

namespace WPAdvanced\Features;

class Custom404Title
{
	public function __construct()
	{
		add_filter('wpseo_title', [$this, 'filterYoast404Title']);
	}

	public function filterYoast404Title(string $title): string
	{
		if (!is_404()) {
			return $title;
		}

		$siteName = get_bloginfo('name');

		return __('Strona nie została znaleziona', 'codeunion') . ' - ' . $siteName;
	}
}
