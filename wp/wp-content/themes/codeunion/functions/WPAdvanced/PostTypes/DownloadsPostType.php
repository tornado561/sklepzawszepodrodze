<?php

namespace WPAdvanced\PostTypes;

class DownloadsPostType
{
	private $name = 'downloads';
	private $args = [];

	public function __construct()
	{
		$this->setArgs();
		add_action('init', [$this, 'registerTaxonomies']);
		new PostType($this->name, $this->args);
	}

	private function setArgs(): void
	{
		$labels = array(
				'name' => _x('Downloads', 'lang'),
				'singular_name' => _x('Download', 'lang'),
				'menu_name' => __('Downloads', 'lang'),
				'parent_item_colon' => __('Parent Category', 'lang'),
				'all_items' => __('All Downloads', 'lang'),
				'view_item' => __('View Download', 'lang'),
				'add_new_item' => __('Add New Download', 'lang'),
				'add_new' => __('Add New', 'lang'),
				'edit_item' => __('Edit Download', 'lang'),
				'update_item' => __('Update Download', 'lang'),
				'search_items' => __('Search Downloads', 'lang'),
				'not_found' => __('No downloads found', 'lang'),
				'not_found_in_trash' => __('No downloads found in Trash', 'lang'),
		);

		$this->args = array(
				'label' => __('Download', 'lang'),
				'description' => __('Custom post type for downloadable files', 'lang'),
				'labels' => $labels,
				'rewrite' => false,
				'has_archive' => false,
				'supports' => array('title', 'author', 'revisions', 'custom-fields'),
				'taxonomies' => array('download_category'),
				'hierarchical' => false,
				'public' => true,
				'show_ui' => true,
				'show_in_menu' => true,
				'show_in_nav_menus' => true,
				'show_in_admin_bar' => true,
				'menu_position' => 6,
				'menu_icon' => 'dashicons-download',
				'can_export' => true,
				'exclude_from_search' => false,
				'publicly_queryable' => false,
				'capability_type' => 'post',
				'show_in_rest' => true,
		);
	}


	public function registerTaxonomies(): void
	{
		$labels = array(
				'name' => _x('Download Categories', 'taxonomy general name', 'lang'),
				'singular_name' => _x('Download Category', 'taxonomy singular name', 'lang'),
				'search_items' => __('Search Categories', 'lang'),
				'all_items' => __('All Categories', 'lang'),
				'parent_item' => __('Parent Category', 'lang'),
				'parent_item_colon' => __('Parent Category:', 'lang'),
				'edit_item' => __('Edit Category', 'lang'),
				'update_item' => __('Update Category', 'lang'),
				'add_new_item' => __('Add New Category', 'lang'),
				'new_item_name' => __('New Category Name', 'lang'),
				'menu_name' => __('Download Categories', 'lang'),
		);

		$args = array(
				'hierarchical' => false,
				'labels' => $labels,
				'show_ui' => true,
				'show_admin_column' => true,
				'query_var' => true,
				'rewrite' => false,
				'show_in_rest' => true,
		);

		register_taxonomy('download_category', array('downloads'), $args);
	}
}
