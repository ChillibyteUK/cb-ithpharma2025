<?php
/**
 * Block template for CB Home Hero.
 *
 * @package cb-ithpharma2025
 */

defined( 'ABSPATH' ) || exit;

$cta_1 = get_field( 'cta_1' );
$cta_2 = get_field( 'cta_2' );
?>
<section class="cb-home-hero d-grid">
	<?= wp_get_attachment_image( get_field( 'background_image' ), 'full', false, array( 'class' => 'cb-home-hero__bg' ) ); ?>
	<div class="container my-auto">
		<div class="row">
			<div class="col-12 col-md-8 col-lg-6 text-white">
				<h1>
					<div class="h2"><?= esc_html( get_field( 'title_line_1' ) ); ?></div>
					<div class="h1 text-end"><?= esc_html( get_field( 'title_line_2' ) ); ?></div>
				</h1>
				<p class="lead-in"><?= esc_html( get_field( 'lead_in' ) ); ?></p>
				<p class="mb-4"><?= esc_html( get_field( 'content' ) ); ?></p>
				<div class="buttons d-flex gap-2">
					<?php
					if ( get_field( 'cta_1_icon' ) ) {
						$icon_1 = '<i class="icon icon--' . get_field( 'cta_1_icon' ) . '"></i>';
					}
					if ( get_field( 'cta_2_icon' ) ) {
						$icon_2 = '<i class="icon icon--' . get_field( 'cta_2_icon' ) . '"></i>';
					}
					?>
					<a href="<?= esc_url( $cta_1['url'] ); ?>" class="button button--outline" target="<?= esc_attr( $cta_1['target'] ); ?>">
						<?= wp_kses_post( $icon_1 ); ?> <?= esc_html( $cta_1['title'] ); ?></a>
					<a href="<?= esc_url( $cta_2['url'] ); ?>" class="button button--outline" target="<?= esc_attr( $cta_2['target'] ); ?>">
						<?= wp_kses_post( $icon_2 ); ?> <?= esc_html( $cta_2['title'] ); ?></a>
				</div>
			</div>
		</div>
	</div>
</section>