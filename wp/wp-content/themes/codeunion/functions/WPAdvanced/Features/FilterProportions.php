<?php

namespace WPAdvanced\Features;

class FilterProportions
{
	public function __construct()
	{
		add_action('pre_get_posts', [$this, 'filterProportions']);
	}

	public function filterProportions($query)
	{
		if (!is_admin() && $query->is_main_query() && is_tax('recipe_category')) {
			global $wpdb;

			// Get the ID of the current category
			$category_id = get_queried_object()->term_id;

			// Get all the unique ratios for products in this category
			$unique_proportions = $wpdb->get_col(
					$wpdb->prepare(
							"SELECT DISTINCT meta_value
                    FROM {$wpdb->postmeta}
                    WHERE meta_key = 'cpt_recipe_proportions'
                    AND post_id IN (SELECT object_id FROM {$wpdb->term_relationships} WHERE term_taxonomy_id = %d)",
							$category_id
					)
			);

			// If there is a 'proportion' filter in the URL, we filter the results by this parameter
			if (isset($_GET['proportion']) && !empty($_GET['proportion'])) {
				$proportion = sanitize_text_field($_GET['proportion']);
				$meta_query = [
						[
								'key' => 'cpt_recipe_proportions',
								'value' => $proportion,
								'compare' => '='
						]
				];
				$query->set('meta_query', $meta_query);
			}

			// Pass the filtered proportions to the template to be used in the select
			set_query_var('unique_proportions', $unique_proportions);
		}
	}
}
