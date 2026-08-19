<?php

namespace WPAdvanced;

use WPAdvanced\Features\CategorySorting;
use WPAdvanced\Features\DisableEmojis;
use WPAdvanced\PostTypes\ProduktyPostType;

class WPAdvanced
{
	public function __construct()
	{
		define('WPA_PATH', get_template_directory());

		new Menu\_Core($this);
		new Settings\_Core();
		new DisableEmojis();
		new CategorySorting();
        new ProduktyPostType();

	}
}
