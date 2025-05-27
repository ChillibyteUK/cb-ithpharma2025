<?php
/**
 * Block template for CB Testimonial Slider.
 *
 * @package cb-ithpharma2025
 */

defined( 'ABSPATH' ) || exit;

?>
<section class="cb-testimonial-slider">
	<div class="container py-5">
		<h2 class="text-center has-primary-700-color mb-5">What our Clients say</h2>
		<?php
		$args = array(
			'post_type'      => 'testimonial',
			'posts_per_page' => -1,
			'orderby'        => 'date',
			'order'          => 'DESC',
		);

		$testimonials = new WP_Query( $args );

		if ( $testimonials->have_posts() ) {
			?>
		<div class="splide" id="cb-testimonial-slider">
            <div class="splide__track">
                <ul class="splide__list">
					<?php
					while ( $testimonials->have_posts() ) {
						$testimonials->the_post();
						?>
						<div class="splide__slide">
							<div class="testimonial__card">
								<div class="testimonial__title">
									<?= esc_html( get_the_title() ); ?>
								</div>
								<div class="testimonial__content">
									<?= wp_kses_post( get_the_content() ); ?>
								</div>
								<div class="testimonial__footer">
									<div class="testimonial__client">
										<?= esc_html( get_field( 'client_name', get_the_ID() ) ); ?>
									</div>
									<div class="testimonial__role">
										<?= esc_html( get_field( 'client_role', get_the_ID() ) ); ?>
									</div>
								</div>
							</div>
						</div>
						<?php
					}
					?>
				</ul>
			</div>
		</div>
			<?php
			wp_reset_postdata();
		} else {
			echo '<p>No testimonials found.</p>';
		}
		?>
	</div>
</section>
<?php
add_action(
	'wp_footer',
	function () {
		?>
<script>
    document.addEventListener( 'DOMContentLoaded', function () {
        new Splide( '#cb-testimonial-slider', {
            type   : 'loop',
            perPage: 3,
			gap: '2.5rem',
            perMove: 1,
            autoplay: true,
            interval: 4000,
			pagination: false,
			arrows: true,
            breakpoints: {
				1024: {
					perPage: 2,
                },
				768: {
					perPage: 1,
				},
            },
        } ).mount();
    } );
</script>
		<?php
	}
);