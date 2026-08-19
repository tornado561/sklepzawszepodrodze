<?php use CodeUnion\CodeUnion;

if (!empty($args)) : ?>

	<?php
	$post_id = $args['latest_post_id'];
	$post_title = get_the_title($post_id);
	$post_permalink = get_permalink($post_id);
	$post_date = get_the_date('d-m-Y', $post_id);
	$post_excerpt = get_the_excerpt($post_id);
	$post_thumbnail_url = get_the_post_thumbnail_url($post_id, 'full');

	if (empty($post_thumbnail_url)) {
		$post_thumbnail_url = get_template_directory_uri() . '/public/img/post-placeholder.png';
	}

	$post_category_name = '';
	$categories = get_the_category($post_id);
	if (!empty($categories)) {
		$post_category_name = $categories[0]->name;
	}
	?>

	<?php if (!empty($post_title) && !empty($post_permalink)) : ?>

		<div class="blogBigTile">
			<div class="blogBigTile__layer"></div>
			<div class="blogBigTile__wrapper container">
				<div class="blogBigTile__helper">
					<a href="<?= $post_permalink ?>"
					   class="blogBigTile__item"
					   aria-label="<?= $post_title ?>">
						<div class="blogBigTile__itemThumbnail">
							<img src="<?= $post_thumbnail_url ?>"
								 alt="<?= $post_title ?>"
								 class="blogBigTile__itemThumbnailImage">
						</div>
						<div class="blogBigTile__itemContent">
							<?php if (!empty($post_category_name)) : ?>
								<div class="blogBigTile__itemCategory">
									<?= $post_category_name ?>
								</div>
							<?php endif ?>
							<div class="blogBigTile__itemTitle">
								<?php (new CodeUnion)->getHeading('h2', $post_title, 'blogBigTile__itemTitleText') ?>
							</div>
							<?php if (!empty($post_excerpt)) : ?>
								<div class="blogBigTile__itemText">
									<?= $post_excerpt ?>
								</div>
							<?php endif ?>
							<div class="blogBigTile__itemDate">
								<?= $post_date ?>
							</div>
						</div>
					</a>
				</div>
			</div>
		</div>

	<?php endif ?>
<?php endif;