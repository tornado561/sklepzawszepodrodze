<?php

use CodeUnion\CodeUnion;

if (isset($block) || isset($args)) :
    if (isset($block)) {
        $id = 'contact-' . $block['id'];
        $is_active = get_field('is_active');
        $anchor_name = get_field('anchor_name');
        $padding_top = get_field('padding_top');
        $padding_bottom = get_field('padding_bottom');
        $alignment = get_field('settings_a_alignment');
        $color_scheme = get_field('cs_background_color');
        $heading_text = get_field('heading_text');
        $heading_type = get_field('heading_type');
        $inner_heading = get_field('inner_heading');
        $show_contact_info = get_field('show_contact_info');
        $map_iframe = get_field('map_iframe');
    } else {
        $id = 'contact-' . uniqid();
        $is_active = $args['is_active'];
        $anchor_name = $args['anchor_name'];
        $padding_top = $args['padding_top'];
        $padding_bottom = $args['padding_bottom'];
        $alignment = $args['settings_a_alignment'];
        $color_scheme = $args['cs_background_color'];
        $heading_text = $args['heading_text'];
        $heading_type = $args['heading_type'];
        $inner_heading = $args['inner_heading'];
        $show_contact_info = $args['show_contact_info'];
        $map_iframe = $args['map_iframe'];

    }
    if (!empty($anchor_name)) {
        $id = $anchor_name;
    }
    if ($show_contact_info) {
        $company_info = get_field('s_contact_company_info', 'option');
    }

    $spacing_classes = (new CodeUnion)->getSpacingClasses($padding_top, $padding_bottom);

    if (isset($block['data']['preview_image_help'])) :
        echo '<img src="' . $block['data']['preview_image_help'] . '" style="width:100%; height:auto;">';
    elseif ($is_active) : ?>
        <section
                class="contact contact--<?= $color_scheme ?> <?= $spacing_classes ?>"
                id="<?= $id; ?>">
            <div class="contact__wrapper container">
                <?php if (!empty($heading_text) && !empty($heading_type)) : ?>
                    <div class="contact__heading">
                        <?php (new CodeUnion)->getHeading($heading_type, $heading_text, 'contact__headingItem') ?>
                    </div>
                <?php endif ?>
                <div class="contact__helper contact__helper--<?= $alignment ?>">
                    <div class="contact__content">
                        <?php if (!empty($inner_heading)) : ?>
                            <div class="contact__innerHeading">
                                <?= $inner_heading ?>
                            </div>
                        <?php endif; ?>
                        <?php if (!empty($text)) : ?>
                            <div class="contact__text">
                                <?= $text ?>
                            </div>
                        <?php endif ?>
                        <?php if ($show_contact_info) : ?>
                            <?php if (!empty($company_info)) : ?>
                                <div class="contact__info">
                                    <?php if (!empty($company_info['company_address'])) : ?>
                                        <div class="contact__infoItem">
                                            <div class="contact__infoIcon">
                                                <svg class="contact__infoIconImage style-svg" width="60" height="60"
                                                     viewBox="0 0 60 60" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <rect width="60" height="60" rx="4" fill="#F4D76F"/>
                                                    <path d="M42.0288 30.8686C41.2773 30.857 40.5386 30.6717 39.8704 30.3274C39.2023 29.9831 38.6228 29.489 38.1772 28.8837C38.1465 28.8428 38.1069 28.8097 38.0612 28.7869C38.0156 28.7641 37.9653 28.7522 37.9142 28.7522C37.8632 28.7522 37.8129 28.7641 37.7673 28.7869C37.7216 28.8097 37.6819 28.8428 37.6513 28.8837C37.215 29.4968 36.6383 29.9968 35.9694 30.3418C35.3005 30.6867 34.5588 30.8667 33.8062 30.8667C33.0536 30.8667 32.3119 30.6867 31.6431 30.3418C30.9742 29.9968 30.3975 29.4968 29.9611 28.8837C29.9305 28.8428 29.8908 28.8097 29.8452 28.7869C29.7996 28.7641 29.7492 28.7522 29.6982 28.7522C29.6472 28.7522 29.5969 28.7641 29.5513 28.7869C29.5056 28.8097 29.4659 28.8428 29.4353 28.8837C28.9897 29.489 28.4102 29.9831 27.742 30.3274C27.0739 30.6717 26.3352 30.857 25.5836 30.8686C24.8327 30.854 24.095 30.6675 23.4273 30.3234C22.7597 29.9793 22.1797 29.4868 21.732 28.8837C21.7034 28.8439 21.666 28.8113 21.6226 28.7884C21.5793 28.7656 21.5312 28.7532 21.4822 28.7522C21.4314 28.7532 21.3814 28.7655 21.3359 28.7882C21.2904 28.811 21.2506 28.8436 21.2193 28.8837C20.7737 29.489 20.1942 29.9831 19.526 30.3274C18.8579 30.6717 18.1192 30.857 17.3676 30.8686H16.8681C16.8212 30.8621 16.7734 30.8657 16.728 30.8793C16.6826 30.8929 16.6407 30.9162 16.6052 30.9475C16.5715 30.9798 16.5449 31.0186 16.5268 31.0615C16.5087 31.1045 16.4996 31.1507 16.5 31.1973V43.0284C16.5 43.5513 16.7078 44.0529 17.0776 44.4227C17.4473 44.7925 17.9489 45.0002 18.4719 45.0002H40.8194C41.3424 45.0002 41.8439 44.7925 42.2137 44.4227C42.5835 44.0529 42.7913 43.5513 42.7913 43.0284V31.1973C42.7907 31.1528 42.7811 31.1089 42.763 31.0682C42.7449 31.0275 42.7188 30.9909 42.6861 30.9607C42.6528 30.9294 42.6135 30.9051 42.5706 30.8893C42.5277 30.8735 42.482 30.8665 42.4363 30.8686H42.0288ZM33.6419 34.9438C33.6453 34.8782 33.6616 34.8138 33.6898 34.7545C33.7181 34.6952 33.7578 34.642 33.8066 34.5981C33.8555 34.5541 33.9125 34.5202 33.9745 34.4983C34.0364 34.4764 34.1021 34.467 34.1677 34.4705H38.3612C38.4279 34.4652 38.495 34.4733 38.5585 34.4943C38.622 34.5154 38.6806 34.549 38.7308 34.5931C38.7811 34.6372 38.822 34.691 38.8511 34.7513C38.8802 34.8115 38.8969 34.877 38.9002 34.9438V41.7006C38.9002 41.875 38.8309 42.0421 38.7077 42.1654C38.5844 42.2887 38.4172 42.3579 38.2429 42.3579H34.2992C34.1249 42.3579 33.9577 42.2887 33.8344 42.1654C33.7112 42.0421 33.6419 41.875 33.6419 41.7006V34.9438ZM21.1536 34.9438C21.1569 34.8833 21.1722 34.8241 21.1985 34.7696C21.2247 34.715 21.2615 34.6662 21.3067 34.6259C21.3519 34.5856 21.4046 34.5546 21.4618 34.5347C21.519 34.5148 21.5795 34.5064 21.64 34.51H28.5414C28.6626 34.5062 28.7807 34.5491 28.8712 34.6298C28.9617 34.7105 29.0178 34.8229 29.0278 34.9438V39.3344C29.0178 39.4553 28.9617 39.5677 28.8712 39.6484C28.7807 39.7291 28.6626 39.772 28.5414 39.7682H21.5874C21.5269 39.7718 21.4664 39.7634 21.4092 39.7435C21.352 39.7236 21.2993 39.6926 21.2541 39.6523C21.2089 39.612 21.1722 39.5632 21.1459 39.5086C21.1196 39.4541 21.1043 39.3949 21.101 39.3344L21.1536 34.9438Z"
                                                          fill="#204B42"/>
                                                    <path d="M42.0291 28.8968C42.7181 28.8534 43.3749 28.5898 43.9027 28.1449C44.4305 27.6999 44.8013 27.0971 44.9606 26.4254C45.1444 25.8392 45.1444 25.2107 44.9606 24.6245L42.5812 17.4338C42.4892 17.184 42.3052 17 42.1211 17H17.2759C17.0918 17 16.9078 17.184 16.8158 17.4338L14.4496 24.6245C14.2723 25.2117 14.2723 25.8382 14.4496 26.4254C14.6081 27.0951 14.9771 27.6964 15.5022 28.1411C16.0274 28.5859 16.6813 28.8507 17.3679 28.8968C18.281 28.8003 19.1199 28.3499 19.7047 27.6422C20.2896 26.9345 20.5739 26.0257 20.4966 25.1109C20.4966 24.8494 20.6004 24.5986 20.7853 24.4137C20.9702 24.2288 21.221 24.1249 21.4825 24.1249C21.744 24.1249 21.9947 24.2288 22.1796 24.4137C22.3645 24.5986 22.4684 24.8494 22.4684 25.1109C22.3875 26.0244 22.6687 26.9332 23.2515 27.6413C23.8342 28.3495 24.6719 28.8004 25.5839 28.8968C26.497 28.8003 27.3359 28.3499 27.9207 27.6422C28.5056 26.9345 28.7899 26.0257 28.7126 25.1109C28.7126 24.8494 28.8165 24.5986 29.0014 24.4137C29.1863 24.2288 29.437 24.1249 29.6985 24.1249C29.96 24.1249 30.2108 24.2288 30.3957 24.4137C30.5806 24.5986 30.6844 24.8494 30.6844 25.1109C30.6071 26.0257 30.8914 26.9345 31.4763 27.6422C32.0611 28.3499 32.9 28.8003 33.8131 28.8968C34.7251 28.8004 35.5628 28.3495 36.1456 27.6413C36.7283 26.9332 37.0095 26.0244 36.9286 25.1109C36.9286 24.8494 37.0325 24.5986 37.2174 24.4137C37.4023 24.2288 37.653 24.1249 37.9145 24.1249C38.176 24.1249 38.4268 24.2288 38.6117 24.4137C38.7966 24.5986 38.9004 24.8494 38.9004 25.1109C38.8232 26.0257 39.1074 26.9345 39.6923 27.6422C40.2772 28.3499 41.1161 28.8003 42.0291 28.8968Z"
                                                          fill="#204B42"/>
                                                </svg>
                                            </div>
                                            <div class="contact__infoText">
                                                <div class="contact__infoTextTitle">
                                                    <?= __('Adres', 'codeunion'); ?>
                                                </div>
                                                <?= $company_info['company_address'] ?>
                                            </div>
                                        </div>
                                    <?php endif ?>
                                    <?php if (!empty($company_info['company_phone'])) : ?>
                                        <div class="contact__infoItem">
                                            <div class="contact__infoIcon">
                                                <svg class="contact__infoIconImage style-svg" width="60" height="60"
                                                     viewBox="0 0 60 60" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <rect width="60" height="60" rx="4" fill="#F4D76F"/>
                                                    <path d="M42.0136 36.3811L39.1379 33.5019C38.8319 33.1892 38.4667 32.9408 38.0636 32.7712C37.6605 32.6016 37.2277 32.5142 36.7904 32.5142C36.3532 32.5142 35.9204 32.6016 35.5173 32.7712C35.1142 32.9408 34.749 33.1892 34.443 33.5019L33.8678 34.0777C30.9712 31.6574 28.2962 28.983 25.8747 26.0863L26.4615 25.4987C27.0837 24.8751 27.4331 24.0297 27.4331 23.1483C27.4331 22.2668 27.0837 21.4215 26.4615 20.7978L23.6211 17.9538C22.9923 17.3422 22.1502 17 21.2736 17C20.3969 17 19.5548 17.3422 18.9261 17.9538L17.3533 19.5286C16.5995 20.2934 16.1301 21.2937 16.0233 22.3629C15.9165 23.432 16.1788 24.5056 16.7664 25.4047C21.457 32.475 27.5106 38.5362 34.5721 43.2326C35.47 43.821 36.5422 44.0836 37.6101 43.9767C38.6779 43.8697 39.6769 43.3998 40.4408 42.645L42.0136 41.082C42.3259 40.7756 42.574 40.4099 42.7434 40.0063C42.9128 39.6027 43 39.1693 43 38.7316C43 38.2938 42.9128 37.8604 42.7434 37.4568C42.574 37.0532 42.3259 36.6875 42.0136 36.3811Z"
                                                          fill="#204B42"/>
                                                </svg>
                                            </div>
                                            <div class="contact__infoText">
                                                <div class="contact__infoTextTitle">
                                                    <?= __('Telefon', 'codeunion'); ?>
                                                </div>
                                                <?php (new CodeUnion)->getLink($company_info['company_phone'], 'contact__infoLink') ?>
                                            </div>
                                        </div>
                                    <?php endif ?>
                                    <?php if (!empty($company_info['company_mail'])) : ?>
                                        <div class="contact__infoItem">
                                            <div class="contact__infoIcon">
                                                <img src="<?= get_template_directory_uri() ?>/public/img/icons/envelope-solid-full.svg"
                                                     alt="<?= __('Phone icon', 'codeunion') ?>"
                                                     aria-hidden="true"
                                                     class="contact__infoIconImage style-svg">
                                            </div>
                                            <?php (new CodeUnion)->getLink($company_info['company_mail'], 'contact__infoLink') ?>
                                        </div>
                                    <?php endif ?>
                                </div>
                            <?php endif ?>
                        <?php endif ?>
                      <div class="contact__actions">
                          <a href="#offer" class="contact__button button button--tertiary">
                              <?= __('Zobacz ofertę', 'codeunion'); ?>
                          </a>
                      </div>
                    </div>

                    <?php if (!empty($map_iframe)) : ?>
                        <div class="contact__map">
                            <?= $map_iframe ?>
                        </div>
                    <?php endif ?>
                </div>
            </div>
        </section>
    <?php endif;
endif;