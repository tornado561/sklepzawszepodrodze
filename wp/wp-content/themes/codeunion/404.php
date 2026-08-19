<?php use CodeUnion\CodeUnion;

$s_global_404_heading = get_field('s_global_404_heading', 'option');
$s_global_404_text = get_field('s_global_404_text', 'option');

get_header(); ?>

	<main class="errorPage">
		<section class="errorPage__wrapper container">
			<div class="errorPage__helper">
				<div class="errorPage__subHeading">
					404
				</div>
				<div class="errorPage__heading">
					<?php (new CodeUnion)->getHeading('h1', $s_global_404_heading, 'errorPage__headingItem') ?>
				</div>
				<?php if (!empty($s_global_404_text)) : ?>
					<div class="errorPage__text">
						<?= $s_global_404_text ?>
					</div>
				<?php endif ?>
			</div>
		</section>
	</main>

<?php get_footer(); ?>