<?php

namespace WPAdvanced\PostTypes;

class LocationPostType
{
	private $name = 'locations';
	private $args = [];


	public function __construct()
	{
		$this->setArgs();
		new PostType($this->name, $this->args);
		$this->addColumns();
	}

	private function setArgs(): void
	{
		$labels = array(
				'name' => _x('Centers', 'lang'),
				'singular_name' => _x('Center', 'lang'),
				'menu_name' => __('Centers', 'lang'),
				'parent_item_colon' => __('Parent', 'lang'),
				'all_items' => __('All', 'lang'),
				'view_item' => __('View', 'lang'),
				'add_new_item' => __('Add ', 'lang'),
				'add_new' => __('Add', 'lang'),
				'edit_item' => __('Edit', 'lang'),
				'update_item' => __('Update', 'lang'),
				'search_items' => __('Search', 'lang'),
				'not_found' => __('Not Found', 'lang'),
				'not_found_in_trash' => __('Not found in Trash', 'lang'),
		);

		$this->args = array(
				'label' => __('Center', 'lang'),
				'description' => __('Centers', 'lang'),
				'labels' => $labels,
				'rewrite' => false,
				'has_archive' => false,
				'supports' => array('title', 'author', 'revisions', 'custom-fields',),
				'taxonomies' => array('locations'),
				'hierarchical' => false,
				'public' => true,
				'show_ui' => true,
				'show_in_menu' => true,
				'show_in_nav_menus' => true,
				'show_in_admin_bar' => true,
				'menu_position' => 6,
				'menu_icon' => 'dashicons-location',
				'can_export' => true,
				'exclude_from_search' => false,
				'publicly_queryable' => false,
				'capability_type' => 'post',
				'show_in_rest' => true,
		);
	}

	private function addColumns(): void
	{
		add_filter('manage_locations_posts_columns', [$this, 'addLocationsColumns']);
		add_action('manage_locations_posts_custom_column', [$this, 'locationsColumnsContent'], 10, 2);
	}

	public function addLocationsColumns($columns)
	{
		$columns['address'] = 'Address';
		$columns['lat'] = 'Latitude';
		$columns['lng'] = 'Longitude';
		return $columns;
	}

	public function locationsColumnsContent($column, $post_id): void
	{
		if (function_exists('get_field')) {
			switch ($column) {
				case 'address':
					echo esc_html(get_field('cpt_loc_address', $post_id));
					break;
				case 'lat':
					echo esc_html(get_field('cpt_loc_lat', $post_id));
					break;
				case 'lng':
					echo esc_html(get_field('cpt_loc_long', $post_id));
					break;
			}
		}
	}
}
