<div class="sortComponent">
	<label for="sortSelect" class="sortComponent__label">
		<?= __('Sort:', 'codeunion') ?>
	</label>

	<form method="get" id="sortForm" class="sortComponent__form" data-sort-component>
		<select name="sort" id="sortSelect" class="sortComponent__select" data-select>
			<option value="desc" <?php selected($_GET['sort'] ?? 'desc', 'desc'); ?>>
				<?= __('Newest', 'codeunion') ?>
			</option>
			<option value="asc" <?php selected($_GET['sort'] ?? '', 'asc'); ?>>
				<?= __('Oldest', 'codeunion') ?>
			</option>
		</select>
		<span aria-hidden="true" class="sortComponent__arrow">
			<img src="<?= get_template_directory_uri() ?>/public/img/icons/chevron-down-solid-full.svg" alt=""
				 class="style-svg">
		</span>
	</form>
</div>
