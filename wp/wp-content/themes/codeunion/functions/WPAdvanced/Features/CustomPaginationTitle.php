<?php

namespace WPAdvanced\Features;

class CustomPaginationTitle
{
	public function __construct()
	{
		add_filter('wpseo_title', [$this, 'filterYoastPaginationTitle']);
	}

	public function filterYoastPaginationTitle(string $title): string
	{
		if (is_paged()) {
			$title = preg_replace_callback('/Page (\d+) of (\d+)/', function ($matches) {
				return __('Strona', 'codeunion') . ' ' . $matches[1] . ' ' . __('z', 'codeunion') . ' ' . $matches[2];
			}, $title);
		}

		return $title;
	}
}
