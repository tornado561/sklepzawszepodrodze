<?php

namespace WPAdvanced\API;

use WP_Query;
use WP_REST_Response;
use WP_REST_Server;

class LocationsApi
{
	public function __construct()
	{
		add_action('rest_api_init', [$this, 'register_routes']);
	}

	public function register_routes()
	{
		register_rest_route('custom/v1', '/locations/', [
				'methods' => WP_REST_Server::READABLE,
				'callback' => [$this, 'get_locations'],
				'permission_callback' => '__return_true',
		]);
	}

	public function get_locations()
	{
		$args = [
				'post_type' => 'locations',
				'posts_per_page' => -1,
				'orderby' => 'date',
				'order' => 'DESC',
		];

		$query = new WP_Query($args);
		$locations = [];

		if ($query->have_posts()) {
			while ($query->have_posts()) {
				$query->the_post();

				$locations[] = [
						'id' => get_the_ID(),
						'title' => get_the_title(),
						'latitude' => get_field('cpt_loc_lat'),
						'longitude' => get_field('cpt_loc_long'),
						'address' => get_field('cpt_loc_address'),
						'phone' => get_field('cpt_loc_phone_number'),
						'mapsUrl' => get_field('cpt_loc_maps_url'),
				];
			}
			wp_reset_postdata();
		}

		return new WP_REST_Response($locations, 200);
	}
}
