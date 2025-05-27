<?php
/**
 * Block template for CB CTA.
 *
 * @package cb-ithpharma2025
 */

defined( 'ABSPATH' ) || exit;

$text_style = get_field( 'style' );
if ( ! $text_style || 'Light' === $text_style ) {
	$text_style = 'text-white';
} else {
	$text_style = 'text-dark';
}

$chevron_style = get_field( 'chevron_style' );
if ( ! $chevron_style || 'None' === $chevron_style ) {
	$chevron_style = null;
} elseif ( 'Light' === $chevron_style ) {
	$chevron_style = 'has-chevron has-chevron--white';
} elseif ( 'Dark' === $chevron_style ) {
	$chevron_style = 'has-chevron has-chevron--primary-900';
} elseif ( 'Mid' === $chevron_style ) {
	$chevron_style = 'has-chevron has-chevron--grey-900';
}

?>
<section class="cb-cta <?= esc_attr( $chevron_style ); ?>">
	<?= wp_get_attachment_image( get_field( 'background_image' ), 'full', false, array( 'class' => 'cb-cta__bg' ) ); ?>
	<div class="container my-auto">
		<div class="row">
			<div class="col-12 col-md-8 <?= esc_attr( $text_style ); ?>">
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