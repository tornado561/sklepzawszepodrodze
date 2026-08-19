<?php
/**
 * File: template-parts/blocks/offer.php
 * Purpose: Render Offer block. Fixes mismatched endif and adds fallback query when ACF `products` is empty.
 *
 * Pseudocode
 * 1) Guard: proceed only if $block or $args is set.
 * 2) Read fields from $block (ACF) or $args.
 * 3) Apply anchor override and spacing classes.
 * 4) If preview image requested => echo image and stop.
 * 5) Else if block is active =>
 *    5.1) Render heading/text/buttons.
 *    5.2) If `$products` empty => WP_Query produkty with stock == "Tak".
 *    5.3) If we have products => render slider + nav.
 * 6) Close conditionals in the same order they were opened (balanced endif).
 */

use CodeUnion\CodeUnion;

if (isset($block) || isset($args)) :
    // Read data
    if (isset($block)) {
        $id              = 'offer-' . $block['id'];
        $is_active       = get_field('is_active');
        $anchor_name     = get_field('anchor_name');
        $padding_top     = get_field('padding_top');
        $padding_bottom  = get_field('padding_bottom');
        $alignment       = get_field('settings_a_alignment');
        $color_scheme    = get_field('cs_background_color');
        $background_type = get_field('csi_background_type');
        $color_scheme    = get_field('csi_background_color');
        $background_image= get_field('csi_background_image');
        $type            = get_field('type');
        $heading_text    = get_field('heading_text');
        $heading_type    = get_field('heading_type');
        $text            = get_field('text');
        $buttons         = get_field('buttons_buttons');
        $products        = get_field('products');
    } else {
        $id              = 'offer-' . uniqid();
        $is_active       = $args['is_active'] ?? false;
        $anchor_name     = $args['anchor_name'] ?? '';
        $padding_top     = $args['padding_top'] ?? '';
        $padding_bottom  = $args['padding_bottom'] ?? '';
        $alignment       = $args['settings_a_alignment'] ?? '';
        $color_scheme    = $args['cs_background_color'] ?? '';
        $background_type = $args['csi_background_type'] ?? '';
        $color_scheme    = $args['csi_background_color'] ?? $color_scheme;
        $background_image= $args['csi_background_image'] ?? '';
        $type            = $args['type'] ?? '';
        $heading_text    = $args['heading_text'] ?? '';
        $heading_type    = $args['heading_type'] ?? '';
        $text            = $args['text'] ?? '';
        $buttons         = $args['buttons_buttons'] ?? [];
        $products        = $args['products'] ?? [];
    }

    if (!empty($anchor_name)) {
        $id = $anchor_name;
    }

    $spacing_classes = (new CodeUnion)->getSpacingClasses($padding_top, $padding_bottom);

    if (isset($block['data']['preview_image_help'])) :
        echo '<img src="' . esc_url($block['data']['preview_image_help']) . '" style="width:100%; height:auto;" />';
    elseif ($is_active) : ?>

        <section class="offer offer--<?= esc_attr($color_scheme) ?> <?= esc_attr($spacing_classes) ?>" id="<?= esc_attr($id); ?>">
            <div class="offer__wrapper container">
                <div class="offer__helper offer__helper--<?= esc_attr($alignment) ?>">
                    <?php if (!empty($heading_text) && !empty($heading_type)) : ?>
                        <div class="offer__heading">
                            <?php (new CodeUnion)->getHeading($heading_type, $heading_text, 'offer__headingItem'); ?>
                        </div>
                    <?php endif; ?>

                    <?php if (!empty($text)) : ?>
                        <div class="offer__text">
                            <?= $text; ?>
                        </div>
                    <?php endif; ?>

                    <?php if (!empty($buttons)) : ?>
                        <div class="offer__actions">
                            <?php foreach ($buttons as $button) :
                                (new CodeUnion)->getLink($button['link'], 'button button--' . ($button['color_scheme'] ?? 'default'));
                            endforeach; ?>
                        </div>
                    <?php endif; ?>
                </div>

                <?php
                if (empty($products)) {
                    $q_args = [
                            'post_type'      => 'produkty',
                            'posts_per_page' => -1,
                            'order'          => 'ASC',
                            'orderby'        => 'menu_order title',
                            'meta_query'     => [
                                    [
                                            'key'     => 'cpt_products_in_stock',
                                            'value'   => 'Tak',
                                            'compare' => '=',
                                    ],
                            ],
                    ];
                    $query    = new WP_Query($q_args);
                    $products = $query->posts;
                }
                ?>

                <?php if (!empty($products)) : ?>
                    <div class="offer__products keen-slider js-offer-slider">
                        <?php foreach ($products as $post) :
                            $post_obj   = is_numeric($post) ? get_post((int) $post) : $post;
                            if (!$post_obj instanceof WP_Post) { continue; }
                            setup_postdata($post_obj);
                            $product_id   = $post_obj->ID;
                            $product_stock= get_field('cpt_products_in_stock', $product_id);
                            if (empty($product_stock) || $product_stock !== 'Nie') : ?>
                                <div class="keen-slider__slide">
                                    <?php get_template_part('template-parts/components/product', 'item', ['product_id' => $product_id]); ?>
                                </div>
                            <?php endif; ?>
                        <?php endforeach; wp_reset_postdata(); ?>
                    </div>

                    <div class="offer__nav">
                        <button class="offer__prev" aria-label="Previous slide">
                            <svg width="39" height="29" viewBox="0 0 39 29" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M14.5 27L2 14.5L14.5 2" stroke="#204B42" stroke-width="3.5" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M2 14L37 14" stroke="#204B42" stroke-width="3.5" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </button>
                        <div class="hero__dots"></div>
                        <button class="offer__next" aria-label="Next slide">
                            <svg width="39" height="29" viewBox="0 0 39 29" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M24.5 2L37 14.5L24.5 27" stroke="#204B42" stroke-width="3.5" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M37 15L2 15" stroke="#204B42" stroke-width="3.5" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </button>
                    </div>
                <?php endif; ?>
            </div>
        </section>

    <?php
    endif;
endif;
?>