<?php
/**
 * Template Name: Offer
 */
use CodeUnion\CodeUnion;
$breadcrumbs = [];
$breadcrumbs[] = ['link' => ['url' => get_permalink(get_the_ID()), 'title' => get_the_title()]];

get_header(); ?>

<main class="offer">
    <div class="offer__wrapper container">
        <div class="offer__breadcrumbs">
            <?php if (!empty($breadcrumbs)) : ?>
                <?php (new CodeUnion)->getBreadcrumbs($breadcrumbs) ?>
            <?php endif ?>
        </div>

        <?php
        $args = [
                'post_type'      => 'produkty',
                'posts_per_page' => -1,
                'order'          => 'ASC',
                'orderby'        => 'menu_order title',
        ];
        $products = new WP_Query($args);

        if ($products->have_posts()) :
            $in_stock    = [];
            $out_of_stock = [];

            while ($products->have_posts()) :
                $products->the_post();
                $product_id    = get_the_ID();
                $product_stock = get_field('cpt_products_in_stock', $product_id);

                if (!empty($product_stock) && $product_stock === 'Nie') {
                    $out_of_stock[] = $product_id;
                } else {
                    $in_stock[] = $product_id;
                }
            endwhile;
            wp_reset_postdata();

            $sorted_products = array_merge($in_stock, $out_of_stock);
            ?>

            <div class="offer__grid">
                <?php foreach ($sorted_products as $product_id) : ?>
                    <?php get_template_part('template-parts/components/product', 'item', ['product_id' => $product_id]); ?>
                <?php endforeach; ?>
            </div>
        <?php else : ?>
            <p class="offer__empty"><?php esc_html_e('Brak produktów.', 'codeunion'); ?></p>
        <?php endif; ?>
    </div>
</main>

<?php get_footer(); ?>
