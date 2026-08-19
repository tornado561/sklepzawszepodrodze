<?php

namespace WPAdvanced\API;

use WP_REST_Response;
use WP_REST_Server;

class TranslationsApi
{
	public function __construct()
	{
		add_action('rest_api_init', [$this, 'register_routes']);
	}

	public function register_routes()
	{
		register_rest_route('custom/v1', '/translations/', [
				'methods' => WP_REST_Server::READABLE,
				'callback' => [$this, 'get_translations'],
				'permission_callback' => '__return_true',
		]);
	}

	public function get_translations()
	{
		$translations = [
				'sample' => __('Sample', 'codeunion'),
		];

		return new WP_REST_Response($translations, 200);
	}
}
