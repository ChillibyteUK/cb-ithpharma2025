<?php
/**
 * Template for displaying the blog index page.
 *
 * @package cb-ithpharma2025
 */

defined( 'ABSPATH' ) || exit;

$page_for_posts = get_option( 'page_for_posts' );

get_header();
?>
<main id="main" class="blog">
    <div class="container pt-5">
        <h1 class="insights-title mb-4">Podcasts</h1>
        <div class="translucent_text__content"><?= wp_kses_post( get_the_content( null, false, $page_for_posts ) ); ?></div>
    </div>
    <section class="latest_insights">
        <div class="container pb-5">
            <div class="row g-4 w-100">
            <?php
            // Custom query to include both published and scheduled posts
            $args = array(
                'post_type'      => 'post',
                'post_status'    => array('publish', 'future'), // Include published and scheduled posts
                'orderby'        => 'date',
                'order'          => 'ASC', // Ascending order
                'posts_per_page' => -1,    // Get all posts
            );

            $query = new WP_Query($args);

            if ($query->have_posts()) {
                while ($query->have_posts()) {
                    $query->the_post();
                    $img = get_the_post_thumbnail_url(get_the_ID(), 'large');
                    if (!$img) {
                        $img = get_stylesheet_directory_uri() . '/img/default-blog.jpg';
                    }
                    ?>
                    <div class="col-md-4">
						<?php
					if (get_post_status() === 'publish') {
                            ?>
                        <div class="podcast-card">
                            <a href="<?php the_permalink(); ?>" class="podcast-card--published">
                                <div class="podcast-card__date"><?= get_the_date(); ?></div>
                                <h3 class="podcast-card__title"><?= the_title(); ?></h3>
                                <div class="podcast-card__excerpt"><?= get_the_excerpt(); ?></div>
                                <div class="podcast-card__status">LIVE NOW</div>
                                <?= get_the_post_thumbnail( get_the_ID(), 'large', array( 'class' => 'podcast-card__thumbnail' ) ); ?>
                            </a>
                        </div>
                            <?php
                        } else {
                            ?>
                        <div class="podcast-card">
                            <div class="podcast-card--scheduled">
                                <div class="podcast-card__date"><?= get_the_date(); ?></div>
                                <h3 class="podcast-card__title"><?= the_title(); ?></h3>
                                <div class="podcast-card__excerpt"><?= get_the_excerpt(); ?></div>
                                <div class="podcast-card__status">COMING SOON</div>
                                <?= get_the_post_thumbnail( get_the_ID(), 'large', array( 'class' => 'podcast-card__thumbnail' ) ); ?>
                            </div>
                        </div>
                            <?php
                        }
						?>
                    </div>
                    <?php
                }
            } else {
                echo '<p>No posts found.</p>';
            }

            // Reset post data
            wp_reset_postdata();
            ?>
            </div>
        </div>
    </section>
</main>
<?php

get_footer();
?>