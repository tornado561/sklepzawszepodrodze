<?php use CodeUnion\CodeUnion;

if (!empty($args)) : ?>

	<?php
	$post_id = $args['post_id'];
	$post_title = get_the_title($post_id);
	$post_permalink = get_permalink($post_id);
	$post_thumbnail_url = get_the_post_thumbnail_url($post_id, 'full');

	if (empty($post_thumbnail_url)) {
		$post_thumbnail_url = get_template_directory_uri() . '/public/img/post-placeholder.png';
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
				<div class="postTile__title">
					<?php (new CodeUnion)->getHeading('h2', $post_title, 'postTile__titleText') ?>
				</div>
			</div>
		</a>
	<?php endif ?>
<?php endif;