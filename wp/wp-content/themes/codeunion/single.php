<?php

use CodeUnion\CodeUnion;

global $post;

$postCategory = get_the_category($post->ID);

$s_breadcrumbs_blog_page = get_field('s_breadcrumbs_blog_page', 'option');

$breadcrumbs = [];
if ($s_breadcrumbs_blog_page) {
	$breadcrumbs[] = ['link' => ['url' => $s_breadcrumbs_blog_page['url'], 'title' => $s_breadcrumbs_blog_page['title']]];
}
if ($postCategory) {
	$breadcrumbs[] = ['link' => ['url' => get_category_link($postCategory[0]->term_id), 'title' => esc_attr($postCategory[0]->name)]];
}
$breadcrumbs[] = ['link' => ['url' => get_permalink($post->ID), 'title' => get_the_title()]];

get_header(); ?>

	<main class="page">

		<div class="singlePost" data-single>
			<div class="singlePost__wrapper container">
				<div class="singlePost__helper">

					<div class="singlePost__breadcrumbs">
						<?php if (!empty($breadcrumbs)) : ?>
							<?php (new CodeUnion)->getBreadcrumbs($breadcrumbs) ?>
						<?php endif ?>
					</div>

					<div class="singlePost__header">
						<?php get_template_part('templates/blog/single/header'); ?>
					</div>

					<div class="singlePost__container">
						<?php get_template_part('templates/blog/single/content'); ?>
					</div>

					<div class="singlePost__moreArticles">
						<?php get_template_part('templates/blog/single/related-posts'); ?>
					</div>

				</div>
			</div>
		</div>

	</main>

<?php get_footer();