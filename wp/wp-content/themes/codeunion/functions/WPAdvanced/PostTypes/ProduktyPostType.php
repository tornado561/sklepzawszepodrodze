<?php

namespace WPAdvanced\PostTypes;

class ProduktyPostType
{
    private $name = 'produkty';
    private $args = [];

    public function __construct()
    {
        $this->setArgs();
        add_action('init', [$this, 'registerTaxonomies']);
        new PostType($this->name, $this->args);
    }

    private function setArgs(): void
    {
        $labels = array(
                'name'                  => _x('Produkty', 'lang'),
                'singular_name'         => _x('Produkt', 'lang'),
                'menu_name'             => __('Produkty', 'lang'),
                'parent_item_colon'     => __('Parent Kategoria', 'lang'),
                'all_items'             => __('Wszystkie Produkty', 'lang'),
                'view_item'             => __('Zobacz Produkt', 'lang'),
                'add_new_item'          => __('Dodaj nowy Produkt', 'lang'),
                'add_new'               => __('Dodaj nowy', 'lang'),
                'edit_item'             => __('Edytuj Produkt', 'lang'),
                'update_item'           => __('Zaktualizuj Produkt', 'lang'),
                'search_items'          => __('Szukaj Produktów', 'lang'),
                'not_found'             => __('Nie znaleziono Produktów', 'lang'),
                'not_found_in_trash'    => __('Brak Produktów w koszu', 'lang'),
        );

        $this->args = array(
                'label'                 => __('Produkt', 'lang'),
                'description'           => __('Custom post type dla produktów', 'lang'),
                'labels'                => $labels,
                'rewrite'               => false,
                'has_archive'           => false,
                'supports'              => array('title', 'editor', 'thumbnail', 'revisions', 'custom-fields'),
                'taxonomies'            => array('produkt_category'),
                'hierarchical'          => false,
                'public'                => true,
                'show_ui'               => true,
                'show_in_menu'          => true,
                'show_in_nav_menus'     => true,
                'show_in_admin_bar'     => true,
                'menu_position'         => 6,
                'menu_icon'             => 'dashicons-products', // można zmienić np. na 'dashicons-cart'
                'can_export'            => true,
                'exclude_from_search'   => false,
                'publicly_queryable'    => true,
                'capability_type'       => 'post',
                'show_in_rest'          => true,
        );
    }

    public function registerTaxonomies(): void
    {
        $labels = array(
                'name'              => _x('Kategorie Produktów', 'taxonomy general name', 'lang'),
                'singular_name'     => _x('Kategoria Produktu', 'taxonomy singular name', 'lang'),
                'search_items'      => __('Szukaj Kategorii', 'lang'),
                'all_items'         => __('Wszystkie Kategorie', 'lang'),
                'parent_item'       => __('Kategoria nadrzędna', 'lang'),
                'parent_item_colon' => __('Kategoria nadrzędna:', 'lang'),
                'edit_item'         => __('Edytuj Kategorię', 'lang'),
                'update_item'       => __('Zaktualizuj Kategorię', 'lang'),
                'add_new_item'      => __('Dodaj nową Kategorię', 'lang'),
                'new_item_name'     => __('Nowa nazwa Kategorii', 'lang'),
                'menu_name'         => __('Kategorie Produktów', 'lang'),
        );

        $args = array(
                'hierarchical'      => true,
                'labels'            => $labels,
                'show_ui'           => true,
                'show_admin_column' => true,
                'query_var'         => true,
                'rewrite'           => false,
                'show_in_rest'      => true,
        );

        register_taxonomy('produkt_category', array('produkty'), $args);
    }
}
