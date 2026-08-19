<?php

namespace WPAdvanced\Menu;

class _Core
{
	private $core;

	private $settings = [
			'menu' => [
					'header_nav' => 'Header nav',
					'footer_nav' => 'Footer nav',
			]
	];

	public function __construct($core)
	{
		$this->core = $core;
		$this->addingMenu = new Adding($core, $this->settings['menu']);
		$this->manageMenu = new Manage($core);
	}
}
