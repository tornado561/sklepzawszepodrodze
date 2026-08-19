<?php

namespace WPAdvanced\Features;

class CustomPostsPerPageForCategory
{
	public function __construct()
	{
		add_action('pre_get_posts', [$this, 'setCustomPostsPerPageForCategory']);
	}

	public function setCustomPostsPerPageForCategory($query)
	{
		if (!is_admin() && $query->is_main_query()) {
			//Categories
			if (is_category()) {
				$category_id = get_queried_object_id();

				$posts_per_page = get_field('cat_settings_posts_per_page', 'category_' . $category_id);

				if ($posts_per_page) {
					$query->set('posts_per_page', $posts_per_page);
				}
			}

			//Recipes Categories
			if (is_tax('recipe_category')) {
				$query->set('posts_per_page', 6);
			}
		}
	}
}
