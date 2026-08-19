<?php

use CodeUnion\CodeUnion;

//Required fields:
$s_footer_copyright_start_year = get_field('s_footer_copyright_start_year', 'option');
$s_footer_copyright_text = get_field('s_footer_copyright_text', 'option');
//Non required fields:
$s_footer_logo = get_field('s_footer_logo', 'option');
$s_footer_text = get_field('s_footer_text', 'option');
$s_footer_menu = get_field('s_footer_menu', 'option');
$s_contact_company_socials = get_field('s_contact_company_socials', 'option');
//Vars:
$current_year = Date('Y');
$footer_nav = apply_filters('wpa_get_menu', [], 'header_nav');

?>

<footer class="footer">
    <div class="footer__wrapper container">
        <div class="footer__helper">
            <div class="footer__top">
                <div class="footer__topImage footer__topImage--left">
                    <img src="<?php echo get_template_directory_uri(); ?>/public/img/icons/footer-top-left.png"
                         alt="footer-top-left">
                </div>
                <div class="footer__topImage footer__topImage--right">
                    <img src="<?php echo get_template_directory_uri(); ?>/public/img/icons/footer-top-right.png"
                         alt="footer-top-right">
                </div>
            </div>
            <?php if (!empty($s_footer_logo) || !empty($s_footer_text) || !empty($s_contact_company_socials)) : ?>
                <div class="footer__content">

                    <div class="footer__contentBox">
                        <?php if (!empty($s_footer_logo)) : ?>
                            <img src="<?= $s_footer_logo['url'] ?>"
                                 alt="<?= $s_footer_logo['alt'] ?>"
                                 class="footer__logo">
                        <?php endif ?>

                        <?php if (!empty($s_footer_text)) : ?>
                            <div class="footer__text">
                                <?= $s_footer_text ?>
                            </div>
                        <?php endif ?>
                    </div>


                </div>

            <?php endif ?>

            <div class="footer__sub">
                <?php if (!empty($footer_nav)) : ?>
                    <div class="footer__links">
                        <?php foreach ($footer_nav as $menuItem) : ?>
                            <a href="<?= $menuItem['url'] ?>" class="footer__link">
                                <?= $menuItem['title'] ?>
                            </a>
                        <?php endforeach ?>
                    </div>
                <?php endif; ?>
                <?php if (!empty($s_footer_menu)) : ?>
                    <ul class="footer__menu">
                        <?php foreach ($s_footer_menu as $item) : ?>
                            <li class="footer__menuItem">
                                <?php (new CodeUnion)->getLink($item['link'], 'footer__menuLink') ?>
                            </li>
                        <?php endforeach ?>
                    </ul>
                <?php endif ?>

            </div>
        </div>
    </div>
</footer>
