<?php

namespace WPAdvanced\Features;

class CategorySorting
{
	public function __construct()
	{
		add_action('pre_get_posts', [$this, 'applySorting']);
	}

	public function applySorting($query): void
	{
		if (!is_admin() && $query->is_main_query()) {
//			if (is_category() || is_tax('recipe_category')) {
			if (is_category()) {
				if (isset($_GET['sort']) && $_GET['sort'] === 'asc') {
					$query->set('order', 'ASC');
				} else {
					$query->set('order', 'DESC');
				}
			}
		}
	}
}
