<?php

namespace SiteManagement\Helpers;

class Breadcrumbs
{
	public function __construct()
	{

	}

	public static function getBreadcrumbs($array = []): void
	{
		//$homeLink = get_field('settings_breadcrumbs_home_url', 'option');
		$homeLink = [];
		$homeLink['url'] = get_home_url();
		$homeLink['title'] = 'Strona główna';

		echo '<div class="breadcrumbs">';
		echo '<a href="' . $homeLink['url'] . '" class="breadcrumbs__link">' . $homeLink['title'] . '</a>';

		if (!empty($array)) {
			$arrayCount = count($array);
			$arrayIndex = 0;
			foreach ($array as $item) {
				echo '<img src="' . get_template_directory_uri() . '/public/img/icons/chevron-right.svg" aria-hidden="true" alt="' . __('Arrow icon', 'codeunion') . '" class="breadcrumbs__arrow style-svg">';
				if ($arrayIndex == $arrayCount - 1) {
					echo '<span class="breadcrumbs__text">' . $item['title'] . '</span>';
				} else {
					echo '<a href="' . $item['url'] . '" class="breadcrumbs__link">' . $item['title'] . '</a>';
				}
				$arrayIndex++;
			}
		}

		$schemaString = '<script type="application/ld+json">{"@context": "https://schema.org/", "@type": "BreadcrumbList", "itemListElement": [{"@type": "ListItem", "position": 1, "name": "' . $homeLink['title'] . '",  "item": "' . $homeLink['url'] . '"';

		if (!empty($array)) {
			$schemaCounter = 2;
			foreach ($array as $item) {
				$schemaString .= ' },{"@type": "ListItem", "position": ' . $schemaCounter . ', "name": "' . $item['title'] . '", "item": "' . $item['url'] . '"';
				$schemaCounter++;
			}
		}
		$schemaString .= '}]}</script>';
		echo $schemaString;
		echo '</div>';
	}
}