<?php

add_filter('use_block_editor_for_post_type', 'activate_gutenberg_products', 10, 2);
add_filter('block_categories_all', 'cu_block_category', 10, 2);
//add_filter('register_taxonomy_args', 'activate_gutenberg_products_cat', 10, 2);
add_action('acf/init', 'acf_blocks_init');
add_filter('allowed_block_types_all', 'get_allowed_blocks', 10, 2);

//Old way
//function acf_blocks_init()
//{
//	if (function_exists('acf_register_block_type')) {
//		require get_template_directory() . '/includes/blocks/block-wysiwyg/register_block.php';
//		//Add new block here
//	}
//}

//New way
function acf_blocks_init(): void
{
	if (function_exists('acf_register_block_type')) {
		$folders = scandir(__DIR__);
		foreach ($folders as $folder) {
			if (!is_dir(__DIR__ . DIRECTORY_SEPARATOR . $folder) || $folder === '.' || $folder === '..') {
				continue;
			}

			$block = __DIR__ . DIRECTORY_SEPARATOR . $folder . DIRECTORY_SEPARATOR . 'register_block.php';
			if (file_exists($block)) {
				require $block;
			}
		}
	}
}


function cu_block_category($categories, $post)
{
	array_unshift($categories, array(
			'slug' => 'wpp_block_categories',
			'title' => __('CodeUnion Blocks', 'theme'),
	));

	return $categories;
}

function activate_gutenberg_products($can_edit, $post_type)
{
	if ($post_type == 'product') {
		$can_edit = true;
	}

	return $can_edit;
}


//function activate_gutenberg_products_cat($args, $taxonomy_name)
//{
//  if ('product_tag' === $taxonomy_name || 'product_cat' === $taxonomy_name) {
//    $args['show_in_rest'] = true;
//  }
//
//  return $args;
//}


function get_allowed_blocks(): array
{
	$registered_blocks = WP_Block_Type_Registry::get_instance()->get_all_registered();
	$allowed_block_types = array_keys($registered_blocks);

	$filtered_blocks = array();

	foreach ($allowed_block_types as $block) {
		$allowed_type = 'acf/';
		if (strpos($block, $allowed_type) !== false) {
			$filtered_blocks[] = $block;
		}

	}

	return $filtered_blocks;
}


