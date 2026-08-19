<?php

use CodeUnion\CodeUnion;

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport"
		  content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<?php //<meta name="viewport" content="width=device-width, initial-scale=1"> ?>
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>

	<?php (new CodeUnion)->getStylesAndScripts(); ?>

	<!--	--><?php //(new CodeUnion)->getFavicons('#FFFFFF'); ?>

	<?php wp_head() ?>

	<?php get_template_part('includes/custom_mtr_scripts/head'); ?>

</head>
<body <?php body_class(); ?>>

<?php get_template_part('includes/custom_mtr_scripts/body'); ?>

<?php get_template_part('includes/layout/header'); ?>
