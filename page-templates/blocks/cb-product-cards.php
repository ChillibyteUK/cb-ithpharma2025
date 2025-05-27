<?php
/**
 * Block template for CB Product Cards.
 *
 * @package cb-ithpharma2025
 */

defined( 'ABSPATH' ) || exit;

$product_1_link = get_field( 'product_1_link' );
$product_2_link = get_field( 'product_2_link' );
$product_3_link = get_field( 'product_3_link' );

?>
<section class="cb-product-cards">
	<div class="container">
		<div class="row g-0">
			<div class="col-lg-4">
				<div class="cb-product-cards__card">
					<?= wp_get_attachment_image( get_field( 'product_1_image' ), 'full', false, array( 'class' => 'cb-product-cards__image' ) ); ?>
					<div class="cb-product-cards__inner">
						<h3 class="cb-product-cards__title">
							<?= esc_html( get_field( 'product_1_title' ) ); ?>
						</h3>
						<p class="cb-product-cards__description">
							<?= esc_html( get_field( 'product_1_description' ) ); ?>
						</p>
						<div class="cb-product-cards__link">
							<a href="<?= esc_url( $product_1_link['url'] ); ?>" class="button button--outline" target="<?= esc_attr( $product_1_link['target'] ); ?>">
								<i class="icon icon--more"></i> <?= esc_html( $product_1_link['title'] ); ?>
							</a>
						</div>
					</div>
				</div>
			</div>
			<div class="col-lg-4">
				<div class="cb-product-cards__card">
					<?= wp_get_attachment_image( get_field( 'product_2_image' ), 'full', false, array( 'class' => 'cb-product-cards__image' ) ); ?>
					<div class="cb-product-cards__inner">
						<h3 class="cb-product-cards__title">
							<?= esc_html( get_field( 'product_2_title' ) ); ?>
						</h3>
						<p class="cb-product-cards__description">
							<?= esc_html( get_field( 'product_2_description' ) ); ?>
						</p>
						<div class="cb-product-cards__link">
							<a href="<?= esc_url( $product_2_link['url'] ); ?>" class="button button--outline" target="<?= esc_attr( $product_2_link['target'] ); ?>">
								<i class="icon icon--more"></i> <?= esc_html( $product_2_link['title'] ); ?>
							</a>
						</div>
					</div>
				</div>
			</div>
			<div class="col-lg-4">
				<div class="cb-product-cards__card">
					<?= wp_get_attachment_image( get_field( 'product_3_image' ), 'full', false, array( 'class' => 'cb-product-cards__image' ) ); ?>
					<div class="cb-product-cards__inner">
						<h3 class="cb-product-cards__title">
							<?= esc_html( get_field( 'product_3_title' ) ); ?>
						</h3>
						<p class="cb-product-cards__description">
							<?= esc_html( get_field( 'product_3_description' ) ); ?>
						</p>
						<div class="cb-product-cards__link">
							<a href="<?= esc_url( $product_3_link['url'] ); ?>" class="button button--outline" target="<?= esc_attr( $product_3_link['target'] ); ?>">
								<i class="icon icon--more"></i> <?= esc_html( $product_3_link['title'] ); ?>
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>