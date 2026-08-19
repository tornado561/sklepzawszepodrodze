<?php

namespace WPAdvanced\PostTypes;

class RecipesPostType
{
	private $name = 'recipe';
	private $args = [];

	public function __construct()
	{
		$this->setArgs();
		new PostType($this->name, $this->args);
	}

	private function setArgs(): void
	{
		$labels = array(
				'name' => _x('Recipes', 'lang'),
				'singular_name' => _x('Recipe', 'lang'),
				'menu_name' => __('Recipes', 'lang'),
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
				'label' => __('Recipes', 'lang'),
				'description' => __('Recipes', 'lang'),
				'labels' => $labels,
				'rewrite' => array(
						'slug' => 'przepisy',
						'with_front' => false,
				),
				'has_archive' => false,
				'supports' => array('title', 'author', 'thumbnail', 'revisions', 'custom-fields'),
				'taxonomies' => array('recipe_category'),
				'hierarchical' => false,
				'public' => true,
				'show_ui' => true,
				'show_in_menu' => true,
				'show_in_nav_menus' => true,
				'show_in_admin_bar' => true,
				'menu_position' => 5,
				'menu_icon' => 'dashicons-food',
				'can_export' => true,
				'exclude_from_search' => false,
				'publicly_queryable' => true,
				'capability_type' => 'post',
				'show_in_rest' => true,
		);
	}
}
