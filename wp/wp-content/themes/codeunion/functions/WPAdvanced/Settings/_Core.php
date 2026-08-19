<?php

namespace WPAdvanced\Settings;


class _Core
{
	private $settings = [
			'acf' => [
					'title' => 'CU Theme settings',
					'slug' => 'options',
					'icon' => 'dashicons-admin-tools',
					'pages' => [
							'global-settings' => 'Global Settings',
							'testimonials' => 'Testimonials',
							'blog' => 'Blog',
							'header' => 'Header',
							'footer' => 'Footer',
					],
					'notranslate' => [],
			],
			'tinymce' => [
					'pages_editor' => false,
					'buttons_1' => [
							'formatselect',
							'bold',
							'italic',
							'bullist',
							'numlist',
							'link',
							'removeformat',
							'pastetext',
							'undo',
							'redo',
							'hr',
							'blockquote',
							'forecolor',
							'textcolor_map' => [
									'D7C0D0', 'color1',
									'F7C7DB', 'color2',
							],
							'alignleft',
							'aligncenter',
							'alignright',
					],
					'buttons_2' => [
					],
					'formats' => [
							'h1' => 'H1',
							'h2' => 'H2',
							'h3' => 'H3',
							'h4' => 'H4',
							'h5' => 'H5',
							'h6' => 'H6',
							'p' => 'Paragraph',
					],
					'colors' => '
						"000000", "Black",
						"FFFFFF", "White",
						"bf931f", "Gold 01",
						"3c3c3b", "Gray 01",
					  '
			],
			'contact-form' => [
					'disable-validation' => true,
			],
	];

	public function __construct()
	{
		new ACF($this->settings['acf']);
		//new TinyMCE( $this->settings['tinymce'] );
		new ContactForm($this->settings['contact-form']);
		new Woocommerce();
	}
}
