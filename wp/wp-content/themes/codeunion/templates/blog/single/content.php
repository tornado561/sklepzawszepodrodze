<?php

use CodeUnion\CodeUnion;

global $post;

$prev_post = get_adjacent_post(true, '', true);
$next_post = get_adjacent_post(true, '', false);


?>

<section class="singleContent" data-single-content>
	<div class="singleContent__heading">
		<?php (new CodeUnion)->getHeading('h1', get_the_title(), 'singleContent__headingItem') ?>
	</div>

	<div class="singleContent__wrapper">

		<div class="singleContent__sidebar">
			<div class="singleContent__toc"
				 data-toc
				 aria-hidden="true"
				 data-active="false">
				<div class="singleContent__tocTitle">
					<?= __('Table of content', 'codeunion') ?>
				</div>
				<div class="singleContent__tocContent" data-toc-content></div>
			</div>
		</div>
		<div class="singleContent__helper">
			<div class="singleContent__blocks" data-blocks>
				<?php the_content(); ?>
			</div>

			<div class="singleContent__nav">
				<div class="singleContent__navCol">
					<?php if (!empty($prev_post)) : ?>
						<a href="<?= get_permalink($prev_post->ID) ?>" class="singleContent__navLink">
							<span class="singleContent__navLinkIcon" aria-hidden="true">
								<img src="<?= get_template_directory_uri() ?>/public/img/icons/chevron-left-solid-full.svg"
									 alt="<?= __('Previous article icon', 'codeunion') ?>"
									 aria-hidden="true"
									 class="singleContent__navLinkIconItem style-svg">
							</span>
							<?= __('Previous article', 'codeunion') ?>
						</a>
					<?php endif ?>
				</div>
				<div class="singleContent__navCol singleContent__navCol--right">
					<?php if (!empty($next_post)) : ?>
						<a href="<?= get_permalink($next_post->ID) ?>" class="singleContent__navLink">
							<?= __('Next article', 'codeunion') ?>
							<span class="singleContent__navLinkIcon" aria-hidden="true">
								<img src="<?= get_template_directory_uri() ?>/public/img/icons/chevron-right-solid-full.svg"
									 alt="<?= __('Next article icon', 'codeunion') ?>"
									 aria-hidden="true"
									 class="singleContent__navLinkIconItem style-svg">
							</span>
						</a>
					<?php endif ?>
				</div>
			</div>
		</div>
	</div>


</section>