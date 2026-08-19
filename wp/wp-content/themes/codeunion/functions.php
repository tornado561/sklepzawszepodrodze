<?php

require_once 'vendor/autoload.php';

$WPAdvanced = new WPAdvanced\WPAdvanced();

require get_template_directory() . '/includes/blocks/register.php';

add_theme_support('post-thumbnails');
add_theme_support('title-tag');

load_theme_textdomain('codeunion');

add_filter('wpseo_json_ld_output', '__return_false');

/**
 * //REWRITES EXAMPLE:
 * //Rewrites BEGIN
 * //Remember to add new rewrites to rewrite file for build purposes!
 *
 * add_action('init', function () {
 * //Recipes
 * add_rewrite_rule('^przepisy/kategoria/([^/]+)/?$', 'index.php?recipe_category=$matches[1]', 'top');
 * add_rewrite_rule('^przepisy/kategoria/([^/]+)/page/([0-9]{1,})/?$', 'index.php?recipe_category=$matches[1]&paged=$matches[2]', 'top');
 *
 * //Recipe page
 * add_rewrite_rule('^przepisy/page/([0-9]{1,})/?$', 'index.php?pagename=przepisy&paged=$matches[1]', 'top');
 *
 * //Events
 * add_rewrite_rule('^wydarzenia/kategoria/([^/]+)/?$', 'index.php?event_category=$matches[1]', 'top');
 * add_rewrite_rule('^wydarzenia/kategoria/([^/]+)/page/([0-9]{1,})/?$', 'index.php?event_category=$matches[1]&paged=$matches[2]', 'top');
 * }, 20);
 *
 * add_action('after_switch_theme', 'my_flush_rewrite_rules');
 * function my_flush_rewrite_rules()
 * {
 * flush_rewrite_rules();
 * }
 *
 * add_action('load-options-permalink.php', function () {
 * if (isset($_POST['permalink_structure'])) {
 * add_action('init', function () {
 * //Recipes
 * add_rewrite_rule('^przepisy/kategoria/([^/]+)/?$', 'index.php?recipe_category=$matches[1]', 'top');
 * add_rewrite_rule('^przepisy/kategoria/([^/]+)/page/([0-9]{1,})/?$', 'index.php?recipe_category=$matches[1]&paged=$matches[2]', 'top');
 *
 * //Recipe page
 * add_rewrite_rule('^przepisy/page/([0-9]{1,})/?$', 'index.php?pagename=przepisy&paged=$matches[1]', 'top');
 *
 * //Events
 * add_rewrite_rule('^wydarzenia/kategoria/([^/]+)/?$', 'index.php?event_category=$matches[1]', 'top');
 * add_rewrite_rule('^wydarzenia/kategoria/([^/]+)/page/([0-9]{1,})/?$', 'index.php?event_category=$matches[1]&paged=$matches[2]', 'top');
 * //Flush
 * flush_rewrite_rules();
 * }, 99);
 * }
 * });
 *
 * //Rewrites END
 **/