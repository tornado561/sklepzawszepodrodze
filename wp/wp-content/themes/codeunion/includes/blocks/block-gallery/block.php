<?php

use CodeUnion\CodeUnion;

if (isset($block) || isset($args)) :
    if (isset($block)) {
        $id = 'gallery-' . $block['id'];
        $is_active = get_field('is_active');
        $anchor_name = get_field('anchor_name');
        $padding_top = get_field('padding_top');
        $padding_bottom = get_field('padding_bottom');
        $color_scheme = get_field('cs_background_color');
        $heading_text = get_field('heading_text');
        $heading_type = get_field('heading_type');
        $items = get_field('items');
    } else {
        $id = 'gallery-' . uniqid();
        $is_active = $args['is_active'];
        $anchor_name = $args['anchor_name'];
        $padding_top = $args['padding_top'];
        $padding_bottom = $args['padding_bottom'];
        $color_scheme = $args['cs_background_color'];
        $heading_text = $args['heading_text'];
        $heading_type = $args['heading_type'];
        $items = $args['items'];
    }
    if (!empty($anchor_name)) {
        $id = $anchor_name;
    }

    $spacing_classes = (new CodeUnion)->getSpacingClasses($padding_top, $padding_bottom);

    if (isset($block['data']['preview_image_help'])) :
        echo '<img src="' . $block['data']['preview_image_help'] . '" style="width:100%; height:auto;">';
    elseif ($is_active) : ?>
        <section class="gallery gallery--<?= $color_scheme ?> <?= $spacing_classes ?>" id="<?= $id; ?>">
            <div class="gallery__wrapper container">
                <div class="gallery__helper">
                    <?php if (!empty($heading_text) && !empty($heading_type)) : ?>
                        <div class="gallery__heading">
                            <?php (new CodeUnion)->getHeading($heading_type, $heading_text, 'gallery__headingItem') ?>
                        </div>
                    <?php endif ?>
                    <?php if (!empty($items)) : ?>
                        <div class="gallery__items">

                            <!-- First 6 items -->
                            <div class="gallery__itemsCol">
                                <?php if (!empty($items[0])) : ?>
                                    <div class="gallery__item gallery__item--46">
                                        <img src="<?= $items[0]['image']['url'] ?>" alt="<?= $items[0]['image']['alt'] ?>" class="gallery__itemImage">
                                        <a href="<?= $items[0]['image']['url'] ?>" aria-label="<?= __('Powiększ obrazek', 'codeunion') ?>" class="gallery__itemLink glightbox">
                                            <span class="gallery__itemLinkIcon"><img src="<?= get_template_directory_uri() ?>/public/img/icons/zoom-in.svg" alt="<?= __('Ikona lupy', 'codeunion') ?>" class="style-svg"></span>
                                        </a>
                                    </div>
                                <?php endif ?>
                                <?php if (!empty($items[1])) : ?>
                                    <div class="gallery__item gallery__item--26">
                                        <img src="<?= $items[1]['image']['url'] ?>" alt="<?= $items[1]['image']['alt'] ?>" class="gallery__itemImage">
                                        <a href="<?= $items[1]['image']['url'] ?>" aria-label="<?= __('Powiększ obrazek', 'codeunion') ?>" class="gallery__itemLink glightbox">
                                            <span class="gallery__itemLinkIcon"><img src="<?= get_template_directory_uri() ?>/public/img/icons/zoom-in.svg" alt="<?= __('Ikona lupy', 'codeunion') ?>" class="style-svg"></span>
                                        </a>
                                    </div>
                                <?php endif ?>
                            </div>

                            <div class="gallery__itemsCol">
                                <?php if (!empty($items[2])) : ?>
                                    <div class="gallery__item">
                                        <img src="<?= $items[2]['image']['url'] ?>" alt="<?= $items[2]['image']['alt'] ?>" class="gallery__itemImage">
                                        <a href="<?= $items[2]['image']['url'] ?>" aria-label="<?= __('Powiększ obrazek', 'codeunion') ?>" class="gallery__itemLink glightbox">
                                            <span class="gallery__itemLinkIcon"><img src="<?= get_template_directory_uri() ?>/public/img/icons/zoom-in.svg" alt="<?= __('Ikona lupy', 'codeunion') ?>" class="style-svg"></span>
                                        </a>
                                    </div>
                                <?php endif ?>
                                <?php if (!empty($items[3])) : ?>
                                    <div class="gallery__item">
                                        <img src="<?= $items[3]['image']['url'] ?>" alt="<?= $items[3]['image']['alt'] ?>" class="gallery__itemImage">
                                        <a href="<?= $items[3]['image']['url'] ?>" aria-label="<?= __('Powiększ obrazek', 'codeunion') ?>" class="gallery__itemLink glightbox">
                                            <span class="gallery__itemLinkIcon"><img src="<?= get_template_directory_uri() ?>/public/img/icons/zoom-in.svg" alt="<?= __('Ikona lupy', 'codeunion') ?>" class="style-svg"></span>
                                        </a>
                                    </div>
                                <?php endif ?>
                            </div>

                            <div class="gallery__itemsCol gallery__itemsCol--break">
                                <?php if (!empty($items[4])) : ?>
                                    <div class="gallery__item gallery__item--26">
                                        <img src="<?= $items[4]['image']['url'] ?>" alt="<?= $items[4]['image']['alt'] ?>" class="gallery__itemImage">
                                        <a href="<?= $items[4]['image']['url'] ?>" aria-label="<?= __('Powiększ obrazek', 'codeunion') ?>" class="gallery__itemLink glightbox">
                                            <span class="gallery__itemLinkIcon"><img src="<?= get_template_directory_uri() ?>/public/img/icons/zoom-in.svg" alt="<?= __('Ikona lupy', 'codeunion') ?>" class="style-svg"></span>
                                        </a>
                                    </div>
                                <?php endif ?>
                                <?php if (!empty($items[5])) : ?>
                                    <div class="gallery__item gallery__item--46">
                                        <img src="<?= $items[5]['image']['url'] ?>" alt="<?= $items[5]['image']['alt'] ?>" class="gallery__itemImage">
                                        <a href="<?= $items[5]['image']['url'] ?>" aria-label="<?= __('Powiększ obrazek', 'codeunion') ?>" class="gallery__itemLink glightbox">
                                            <span class="gallery__itemLinkIcon"><img src="<?= get_template_directory_uri() ?>/public/img/icons/zoom-in.svg" alt="<?= __('Ikona lupy', 'codeunion') ?>" class="style-svg"></span>
                                        </a>
                                    </div>
                                <?php endif ?>
                            </div>

                            <!-- Extra 6 items (6–11) -->
                            <div class="gallery__itemsCol">
                                <?php if (!empty($items[6])) : ?>
                                    <div class="gallery__item gallery__item--46">
                                        <img src="<?= $items[6]['image']['url'] ?>" alt="<?= $items[6]['image']['alt'] ?>" class="gallery__itemImage">
                                        <a href="<?= $items[6]['image']['url'] ?>" aria-label="<?= __('Powiększ obrazek', 'codeunion') ?>" class="gallery__itemLink glightbox">
                                            <span class="gallery__itemLinkIcon"><img src="<?= get_template_directory_uri() ?>/public/img/icons/zoom-in.svg" alt="<?= __('Ikona lupy', 'codeunion') ?>" class="style-svg"></span>
                                        </a>
                                    </div>
                                <?php endif ?>
                                <?php if (!empty($items[7])) : ?>
                                    <div class="gallery__item gallery__item--26">
                                        <img src="<?= $items[7]['image']['url'] ?>" alt="<?= $items[7]['image']['alt'] ?>" class="gallery__itemImage">
                                        <a href="<?= $items[7]['image']['url'] ?>" aria-label="<?= __('Powiększ obrazek', 'codeunion') ?>" class="gallery__itemLink glightbox">
                                            <span class="gallery__itemLinkIcon"><img src="<?= get_template_directory_uri() ?>/public/img/icons/zoom-in.svg" alt="<?= __('Ikona lupy', 'codeunion') ?>" class="style-svg"></span>
                                        </a>
                                    </div>
                                <?php endif ?>
                            </div>

                            <div class="gallery__itemsCol">
                                <?php if (!empty($items[8])) : ?>
                                    <div class="gallery__item">
                                        <img src="<?= $items[8]['image']['url'] ?>" alt="<?= $items[8]['image']['alt'] ?>" class="gallery__itemImage">
                                        <a href="<?= $items[8]['image']['url'] ?>" aria-label="<?= __('Powiększ obrazek', 'codeunion') ?>" class="gallery__itemLink glightbox">
                                            <span class="gallery__itemLinkIcon"><img src="<?= get_template_directory_uri() ?>/public/img/icons/zoom-in.svg" alt="<?= __('Ikona lupy', 'codeunion') ?>" class="style-svg"></span>
                                        </a>
                                    </div>
                                <?php endif ?>
                                <?php if (!empty($items[9])) : ?>
                                    <div class="gallery__item">
                                        <img src="<?= $items[9]['image']['url'] ?>" alt="<?= $items[9]['image']['alt'] ?>" class="gallery__itemImage">
                                        <a href="<?= $items[9]['image']['url'] ?>" aria-label="<?= __('Powiększ obrazek', 'codeunion') ?>" class="gallery__itemLink glightbox">
                                            <span class="gallery__itemLinkIcon"><img src="<?= get_template_directory_uri() ?>/public/img/icons/zoom-in.svg" alt="<?= __('Ikona lupy', 'codeunion') ?>" class="style-svg"></span>
                                        </a>
                                    </div>
                                <?php endif ?>
                            </div>

                            <div class="gallery__itemsCol gallery__itemsCol--break">
                                <?php if (!empty($items[10])) : ?>
                                    <div class="gallery__item gallery__item--26">
                                        <img src="<?= $items[10]['image']['url'] ?>" alt="<?= $items[10]['image']['alt'] ?>" class="gallery__itemImage">
                                        <a href="<?= $items[10]['image']['url'] ?>" aria-label="<?= __('Powiększ obrazek', 'codeunion') ?>" class="gallery__itemLink glightbox">
                                            <span class="gallery__itemLinkIcon"><img src="<?= get_template_directory_uri() ?>/public/img/icons/zoom-in.svg" alt="<?= __('Ikona lupy', 'codeunion') ?>" class="style-svg"></span>
                                        </a>
                                    </div>
                                <?php endif ?>
                                <?php if (!empty($items[11])) : ?>
                                    <div class="gallery__item gallery__item--46">
                                        <img src="<?= $items[11]['image']['url'] ?>" alt="<?= $items[11]['image']['alt'] ?>" class="gallery__itemImage">
                                        <a href="<?= $items[11]['image']['url'] ?>" aria-label="<?= __('Powiększ obrazek', 'codeunion') ?>" class="gallery__itemLink glightbox">
                                            <span class="gallery__itemLinkIcon"><img src="<?= get_template_directory_uri() ?>/public/img/icons/zoom-in.svg" alt="<?= __('Ikona lupy', 'codeunion') ?>" class="style-svg"></span>
                                        </a>
                                    </div>
                                <?php endif ?>
                            </div>

                        </div>
                    <?php endif ?>
                </div>
            </div>
        </section>
    <?php endif;
endif;
