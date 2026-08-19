<?php

namespace WPAdvanced\Features;

class MoveAcfAboveYoast
{
	public function __construct()
	{
		add_action('acf/input/admin_head', [$this, 'moveAcfBox']);
	}

	public function moveAcfBox(): void
	{
		?>
		<script type="text/javascript">
			document.addEventListener('DOMContentLoaded', function () {
				let acfBox = document.querySelector('[id^="acf-group_"]');
				let yoastSeoBox = document.getElementById('wpseo_meta');

				if (acfBox && yoastSeoBox) {
					yoastSeoBox.parentNode.insertBefore(acfBox, yoastSeoBox);
				}
			});
		</script>
		<?php
	}
}
