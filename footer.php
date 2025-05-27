<?php
/**
 * Footer template for the CB TXP theme.
 *
 * This file contains the footer section of the theme, including navigation menus,
 * office addresses, and colophon information.
 *
 * @package cb-ithpharma2025
 */

defined( 'ABSPATH' ) || exit;
?>
<div id="footer-top"></div>
<footer class="footer py-4">
    <div class="container">
        <div class="row pb-5 g-3">
            <div class="col-sm-2">
				<img src="<?= esc_url( get_stylesheet_directory_uri() . '/img/ith-logo-stack--wo.svg' ); ?>" width="80">
            </div>
            <div class="col-sm-2">
                <?=
				wp_nav_menu(
					array(
						'theme_location' => 'footer_menu1',
						'menu_class'     => 'footer__menu',
					)
				);
				?>
            </div>
            <div class="col-sm-3">
                <?=
				wp_nav_menu(
					array(
						'theme_location' => 'footer_menu2',
						'menu_class'     => 'footer__menu',
					)
				);
				?>
            </div>
            <div class="col-sm-3 footer__contact">
                Contacts:<br>
				Media Enquiries Phone<br>
				<?= do_shortcode( '[contact_phone]' ); ?><br>
				Media Enquiries Email<br>
				<?= do_shortcode( '[contact_email]' ); ?>
            </div>
            <div class="col-sm-2 text-end">
                <a href="/contact-us/" class="button button--primary">Contact Us</a>
            </div>
        </div>

        <div class="colophon d-flex justify-content-between align-items-center flex-wrap">
            <div>
                &copy; <?= esc_html( gmdate( 'Y' ) ); ?> ITH Pharma. Registered in England and Wales No. 06569105.
            </div>
            <div>
                <a href="https://www.chillibyte.co.uk/" rel="nofollow noopener" target="_blank" class="cb"
                title="Digital Marketing by Chillibyte"></a>
            </div>
        </div>
</footer>
<?php wp_footer(); ?>
</body>

</html>