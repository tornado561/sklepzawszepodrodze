<?php

use CodeUnion\CodeUnion;

$s_global_cat_categories_bar = get_field('s_global_cat_categories_bar', 'option');

function checkState($url): string
{
	$current_path = trim(parse_url(home_url(add_query_arg(null, null)), PHP_URL_PATH), '/');
	$target_path = trim(parse_url($url, PHP_URL_PATH), '/');

	if ($current_path === $target_path) {
		return 'true';
	}

	if (str_starts_with($current_path, $target_path . '/')) {
		$rest = substr($current_path, strlen($target_path) + 1);
		$rest_parts = explode('/', $rest);

		if (isset($rest_parts[0]) && $rest_parts[0] === 'page') {
			return 'true';
		}
	}

	return 'false';
}

?>


<?php if (!empty($s_global_cat_categories_bar)) : ?>
	<div class="categoryPicker" data-category-picker>
		<div class="categoryPicker__wrapper">
			<div class="categoryPicker__helper">
				<div class="categoryPicker__heading">
					<?php (new CodeUnion)->getHeading('h2', __('Categories', 'codeunion'), 'categoryPicker__headingItem') ?>
				</div>
				<ul class="categoryPicker__items">
					<?php foreach ($s_global_cat_categories_bar as $item) : ?>
						<li class="categoryPicker__item">
							<a href="<?= $item['link']['url'] ?>"
							   class="categoryPicker__itemButton"
							   data-selected="<?= checkState($item['link']['url']) ?>">
								<?= $item['link']['title'] ?>
							</a>
						</li>
					<?php endforeach ?>
				</ul>

				<div class="categoryPicker__mobile">
					<select name="catSelect" id="catSelect" class="categoryPicker__select" data-select>
						<?php foreach ($s_global_cat_categories_bar as $item) : ?>
							<option value="<?= $item['link']['url'] ?>"<?= (checkState($item['link']['url']) == 'true') ? ' selected' : '' ?>>
								<?= $item['link']['title'] ?>
							</option>
						<?php endforeach ?>
					</select>
					<div aria-hidden="true" class="categoryPicker__arrow">
						<img src="<?= get_template_directory_uri() ?>/public/img/icons/chevron-down-solid-full.svg"
							 alt=""
							 class="style-svg">
					</div>
				</div>

			</div>
		</div>


	</div>
<?php endif;