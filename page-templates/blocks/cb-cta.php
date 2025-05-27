<?php
/**
 * Block template for CB CTA.
 *
 * @package cb-ithpharma2025
 */

defined( 'ABSPATH' ) || exit;

$style = get_field( 'style' );
if ( ! $style || 'Light' === $style ) {
	$style   = 'text-white';
	$chevron = 'has-chevron--white';
} else { 
	$style   = 'text-dark';
	$chevron = 'has-chevron--primary-900';
}


?>
<section class="cb-cta has-chevron <?= esc_attr( $chevron ); ?>">
	<?= wp_get_attachment_image( get_field( 'background_image' ), 'full', false, array( 'class' => 'cb-cta__bg' ) ); ?>
	<div class="container my-auto">
		<div class="row">
			<div class="col-12 col-md-8 <?= esc_attr( $style ); ?>">
				<h2 class="cb-cta__title"><?= esc_html( get_field( 'title' ) ); ?></h2>
				<p class="cb-cta__content"><?= esc_html( get_field( 'content' ) ); ?></p>
			</div>
			<div class="col-12 col-md-4 d-flex align-items-center justify-content-center">
				<?php
				$cta = get_field( 'cta_link' );
				?>
				<a href="<?= esc_url( $cta['url'] ); ?>" class="button button--primary" target="<?= esc_attr( $cta['target'] ); ?>">
					<?= esc_html( $cta['title'] ); ?>
				</a>
			</div>
		</div>
	</div>
</section>