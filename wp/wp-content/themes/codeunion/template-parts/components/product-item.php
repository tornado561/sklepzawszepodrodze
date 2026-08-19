<?php
/**
 * Product Item Block (BEM structure)
 */
?>

<?php

use CodeUnion\CodeUnion;

$product_id = $args['product_id'] ?? get_the_ID();

$product_description = get_field('cpt_products_description', $product_id);
$product_stock = get_field('cpt_products_in_stock', $product_id);
$company_info = get_field('s_contact_company_info', 'option');
if (!empty($product_stock) && $product_stock === 'Nie') {
    $info = 'Na zamówienie (min. 1kg)';
} else {
    $info = 'Na stanie';
}
?>

<div class="product-card">
    <div class="product-card__stock
    <?php echo ($product_stock === 'Nie') ? 'product-card__stock--out' : 'product-card__stock--in'; ?>">
        <?php if (!empty($info)): ?>
            <?php echo esc_html($info); ?>
        <?php endif; ?>
    </div>

    <div class="product-card__inner">
        <div class="product-card__side product-card__side--front">
            <?php if (has_post_thumbnail($product_id)) : ?>
                <div class="product-card__thumb">
                    <?php echo get_the_post_thumbnail($product_id, 'full'); ?>
                </div>
            <?php endif; ?>
            <h2 class="product-card__title"><?php echo get_the_title($product_id); ?></h2>
        </div>

        <div class="product-card__side product-card__side--back">
            <div class="product-card__title"><?php echo get_the_title($product_id); ?></div>
            <div class="product-card__desc">
                <?php echo $product_description; ?>
            </div>
        </div>
        <?php if (!empty($product_stock) && $product_stock === 'Nie') : ?>
            <div class="product-card__cta button button--tertiary">
                <?php if (!empty($company_info['company_phone'])) : ?>
                    <a class="product-card__cta-link" href="<?php echo $company_info['company_phone']['url']; ?>">
                        <?php echo __('Zadzwoń do nas', 'codeunion'); ?>
                    </a>
                <?php endif; ?>
            </div>
        <?php else: ?>
            <div class="product-card__cta button button--tertiary">
<!--                <a class="product-card__cta-link" href="--><?php //echo home_url(); ?><!--/#contact">-->
                <a class="product-card__cta-link" target="_blank" rel="nofollow" href="https://www.google.com/maps?um=1&ie=UTF-8&fb=1&gl=pl&sa=X&geocode=KSvbNKBKgz1HMQWw6CcCB4RZ&daddr=Marynarki+Wojennej+14,+33-100+Tarn%C3%B3w">
                    <?php echo __('Jak do nas dotrzeć', 'codeunion'); ?>
                </a>
            </div>
        <?php endif; ?>
    </div>
</div>
