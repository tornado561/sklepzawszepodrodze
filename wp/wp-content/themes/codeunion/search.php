<?php

get_header();

$search_query = get_search_query();

$breadcrumbs = [];
$breadcrumbs[] = ['link' => ['url' => '', 'title' => __('Strona wyszukiwania', 'codeunion')]];
?>

	<main class="page">
		<?php the_content(); ?>
	</main>

<?php get_footer();