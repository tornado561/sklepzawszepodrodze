<?php use CodeUnion\CodeUnion;

if (!empty($args)) : ?>

	<?php
	$post_id = $args['post_id'];
	$post_title = get_the_title($post_id);
	$post_permalink = get_permalink($post_id);
	$post_date = get_the_date('d-m-Y', $post_id);
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
		<a href="<?= $post_permalink ?>"
		   class="postTile"
		   aria-label="<?= $post_title ?>">
			<div class="postTile__thumbnail">
				<img src="<?= $post_thumbnail_url ?>"
					 alt="<?= $post_title ?>"
					 class="postTile__thumbnailImage">
			</div>
			<div class="postTile__content">
				<div class="postTile__details">
					<div class="postTile__category">
						<?php if (!empty($post_category_name)) : ?>
							<?= $post_category_name ?>
						<?php endif ?>
					</div>
					<div class="postTile__date">
						<?= $post_date ?>
					</div>
				</div>
				<div class="postTile__title">
					<?php (new CodeUnion)->getHeading('h2', $post_title, 'postTile__titleText') ?>
				</div>
			</div>
		</a>
	<?php endif ?>
<?php endif;