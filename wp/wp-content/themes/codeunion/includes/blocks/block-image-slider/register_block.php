<?php

$name = 'block-image-slider';
$title = 'Image Slider section';
$keywords = array('Block', 'cu', 'codeunion', 'image-slider');
acf_register_block_type(
		array(
				'name' => $name,
				'title' => __($title, 'lang'),
				'description' => __($title, 'lang'),
				'render_template' => dirname(__FILE__) . '/block.php',
				'category' => 'wpp_block_categories',
				'icon' => 'admin-comments',
				'keywords' => $keywords,
				'mode' => 'edit',
				'example' => array(
						'attributes' => array(
								'mode' => 'preview',
								'data' => array(
										'preview_image_help' => get_template_directory_uri() . "/includes/blocks/" . $name . "/img.png",
								)
						)
				)
		)
);

