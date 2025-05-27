<?php
/**
 * Block template for CB Logo Slider.
 *
 * @package cb-ithpharma2025
 */

$images = get_field( 'logos' );
?>
<section class="cb-logo-slider py-5">
    <div class="container">
        <h2 class="text-center has-primary-700-color"><?= esc_html( get_field( 'title' ) ); ?></h2>
        <div class="splide" id="cb-logo-slider">
            <div class="splide__track">
                <ul class="splide__list">
                    <?php
                    foreach ( $images as $image ) {
                        ?>
                        <li class="splide__slide">
                            <?= wp_get_attachment_image( $image, 'full', false, array( 'class' => 'img-fluid' ) ); ?>
                        </li>
                        <?php
                    }
                    ?>
                </ul>
            </div>
        </div>
    </div>
</section>
<?php
add_action(
	'wp_footer',
	function () {
		?>
<script>
    document.addEventListener( 'DOMContentLoaded', function () {
        new Splide( '#cb-logo-slider', {
            type   : 'loop',
            perPage: 4,
            perMove: 1,
            autoplay: true,
            interval: 3000,
			pagination: false,
			arrows: true,
            breakpoints: {
				1024: {
					perPage: 3,
                },
				768: {
					perPage: 2,
				},
				576: {
					perPage: 1,
				},
            },
        } ).mount();
    } );
</script>
		<?php
	},
	100
);