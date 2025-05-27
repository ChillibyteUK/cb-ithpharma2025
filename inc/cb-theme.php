<?php
/**
 * CB Theme Functions
 *
 * This file contains theme-specific functions and customizations for the CB TXP theme.
 *
 * @package cb-ithpharma2025
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

require_once CB_THEME_DIR . '/inc/cb-utility.php';
require_once CB_THEME_DIR . '/inc/cb-posttypes.php';

/*
 * Uncomment to include custom post types and taxonomies.
 * require_once CB_THEME_DIR . '/inc/cb-taxonomies.php';
*/

require_once CB_THEME_DIR . '/inc/cb-blocks.php';

// Remove unwanted SVG filter injection WP.
remove_action( 'wp_enqueue_scripts', 'wp_enqueue_global_styles' );
remove_action( 'wp_body_open', 'wp_global_styles_render_svg_filters' );

/**
 * Removes the comment-reply.min.js script from the footer.
 */
function remove_comment_reply_header_hook() {
    wp_deregister_script( 'comment-reply' );
}
add_action( 'init', 'remove_comment_reply_header_hook' );

/**
 * Removes the comments menu from the WordPress admin dashboard.
 */
function remove_comments_menu() {
	remove_menu_page( 'edit-comments.php' );
}
add_action( 'admin_menu', 'remove_comments_menu' );

/**
 * Removes specific page templates from the available templates list.
 *
 * @param array $page_templates The list of page templates.
 * @return array The modified list of page templates.
 */
function child_theme_remove_page_template( $page_templates ) {
    unset(
		$page_templates['page-templates/blank.php'],
		$page_templates['page-templates/empty.php'],
		$page_templates['page-templates/left-sidebarpage.php'],
		$page_templates['page-templates/right-sidebarpage.php'],
		$page_templates['page-templates/both-sidebarspage.php']
	);
    return $page_templates;
}
add_filter( 'theme_page_templates', 'child_theme_remove_page_template' );

/**
 * Removes support for specific post formats in the theme.
 */
function remove_understrap_post_formats() {
	remove_theme_support( 'post-formats', array( 'aside', 'image', 'video', 'quote', 'link' ) );
}
add_action( 'after_setup_theme', 'remove_understrap_post_formats', 11 );

if ( function_exists( 'acf_add_options_page' ) ) {
    acf_add_options_page(
        array(
            'page_title' => 'Site-Wide Settings',
            'menu_title' => 'Site-Wide Settings',
            'menu_slug'  => 'theme-general-settings',
            'capability' => 'edit_posts',
        )
    );
}

/**
 * Initializes widgets, menus, and theme supports.
 *
 * This function registers navigation menus, unregisters sidebars and menus,
 * and adds theme support for custom editor color palettes.
 */
function widgets_init() {

    register_nav_menus(
		array(
			'primary_nav'  => __( 'Primary Nav', 'cb-ithpharma2025' ),
			'footer_menu1' => __( 'Footer Nav 1', 'cb-ithpharma2025' ),
			'footer_menu2' => __( 'Footer Nav 2', 'cb-ithpharma2025' ),
		)
	);

    unregister_sidebar( 'hero' );
    unregister_sidebar( 'herocanvas' );
    unregister_sidebar( 'statichero' );
    unregister_sidebar( 'left-sidebar' );
    unregister_sidebar( 'right-sidebar' );
    unregister_sidebar( 'footerfull' );
    unregister_nav_menu( 'primary' );

    add_theme_support( 'disable-custom-colors' );
    add_theme_support(
        'editor-color-palette',
        array(
            array(
                'name'  => 'Dark',
                'slug'  => 'dark',
                'color' => '#222222',
            ),
            array(
                'name'  => 'Primary 900',
                'slug'  => 'primary-900',
                'color' => '#27383A',
            ),
            array(
                'name'  => 'Primary 700',
                'slug'  => 'primary-700',
                'color' => '#2B5B54',
            ),
            array(
                'name'  => 'Primary 500',
                'slug'  => 'primary-500',
                'color' => '#3D6557',
            ),
            array(
                'name'  => 'Primary 300',
                'slug'  => 'primary-300',
                'color' => '#93B69F',
            ),
            array(
                'name'  => 'Accent 400',
                'slug'  => 'accent-400',
                'color' => '#93B636',
            ),
            array(
                'name'  => 'White',
                'slug'  => 'white',
                'color' => '#ffffff',
            ),
        )
    );
    
}
add_action( 'widgets_init', 'widgets_init', 11 );

remove_action( 'wp_enqueue_scripts', 'wp_enqueue_global_styles' );
remove_action( 'wp_body_open', 'wp_global_styles_render_svg_filters' );

/**
 * Registers a custom dashboard widget for the Chillibyte theme.
 */
function register_cb_dashboard_widget() {
	wp_add_dashboard_widget(
		'cb_dashboard_widget',
        'Chillibyte',
        'cb_dashboard_widget_display'
    );
}
add_action( 'wp_dashboard_setup', 'register_cb_dashboard_widget' );

/**
 * Displays the content of the Chillibyte dashboard widget.
 */
function cb_dashboard_widget_display() {
	?>
    <div style="display: flex; align-items: center; justify-content: space-around;">
        <img style="width: 50%;"
            src="<?= esc_url( get_stylesheet_directory_uri() . '/img/cb-full.jpg' ); ?>">
        <a class="button button-primary" target="_blank" rel="noopener nofollow noreferrer"
            href="mailto:hello@chillibyte.co.uk/">Contact</a>
    </div>
    <div>
        <p><strong>Thanks for choosing Chillibyte!</strong></p>
        <hr>
        <p>Got a problem with your site, or want to make some changes & need us to take a look for you?</p>
        <p>Use the link above to get in touch and we'll get back to you ASAP.</p>
    </div>
	<?php
}

// phpcs:disable
// add_filter('wpseo_breadcrumb_links', function( $links ) {
//     global $post;
//     if ( is_singular( 'post' ) ) {
//         $t = get_the_category($post->ID);
//         $breadcrumb[] = array(
//             'url' => '/guides/',
//             'text' => 'Guides',
//         );

//         array_splice( $links, 1, -2, $breadcrumb );
//     }
//     return $links;
// }
// );

// remove discussion metabox
// function cc_gutenberg_register_files()
// {
//     // script file
//     wp_register_script(
//         'cc-block-script',
//         get_stylesheet_directory_uri() . '/js/block-script.js', // adjust the path to the JS file
//         array('wp-blocks', 'wp-edit-post')
//     );
//     // register block editor script
//     register_block_type('cc/ma-block-files', array(
//         'editor_script' => 'cc-block-script'
//     ));
// }
// add_action('init', 'cc_gutenberg_register_files');
// phpcs:enable

/**
 * Filters the excerpt content to modify or return it as is.
 *
 * @param string $post_excerpt The current post excerpt.
 * @return string The filtered or unmodified post excerpt.
 */
function understrap_all_excerpts_get_more_link( $post_excerpt ) {
    if ( is_admin() || ! get_the_ID() ) {
        return $post_excerpt;
    }
    return $post_excerpt;
}

// Remove Yoast SEO breadcrumbs from Revelanssi's search results.
/**
 * Removes shortcodes from the content during search queries.
 *
 * @param string $content The content to filter.
 * @return string The filtered content without shortcodes.
 */
function wpdocs_remove_shortcode_from_index( $content ) {
	if ( is_search() ) {
		$content = strip_shortcodes( $content );
    }
    return $content;
}
add_filter( 'the_content', 'wpdocs_remove_shortcode_from_index' );

// GF really is pants.
/**
 * Change submit from input to button.
 *
 * Do not use example provided by Gravity Forms as it strips out the button attributes including onClick.
 *
 * @param string $button_input The original input HTML for the submit button.
 * @param array  $form         The Gravity Forms form object.
 * @return string The modified button HTML.
 */
function wd_gf_update_submit_button( $button_input, $form ) {
    // save attribute string to $button_match[1].
    preg_match( '/<input([^\/>]*)(\s\/)*>/', $button_input, $button_match );

    // remove value attribute (since we aren't using an input).
    $button_atts = str_replace( "value='" . $form['button']['text'] . "' ", '', $button_match[1] );

    // create the button element with the button text inside the button element instead of set as the value.
    return '<button ' . $button_atts . '><span>' . $form['button']['text'] . '</span></button>';
}
add_filter( 'gform_submit_button', 'wd_gf_update_submit_button', 10, 2 );


/**
 * Enqueues theme-specific scripts and styles.
 *
 * This function deregisters jQuery and disables certain styles and scripts
 * that are commented out for potential use in the theme.
 */
function cb_theme_enqueue() {
    $the_theme = wp_get_theme();
	// phpcs:disable
    // wp_enqueue_style('lightbox-stylesheet', get_stylesheet_directory_uri() . '/css/lightbox.min.css', array(), $the_theme->get('Version'));
    // wp_enqueue_script('lightbox-scripts', get_stylesheet_directory_uri() . '/js/lightbox-plus-jquery.min.js', array(), $the_theme->get('Version'), true);
    // wp_enqueue_script('lightbox-scripts', get_stylesheet_directory_uri() . '/js/lightbox.min.js', array(), $the_theme->get('Version'), true);
    // wp_enqueue_style('aos-style', "https://unpkg.com/aos@2.3.1/dist/aos.css", array());
    // wp_enqueue_script('aos', 'https://unpkg.com/aos@2.3.1/dist/aos.js', array(), null, true);
    // wp_enqueue_script('jquery', 'https://code.jquery.com/jquery-3.6.3.min.js', array(), null, true);
    // wp_enqueue_script('parallax', get_stylesheet_directory_uri() . '/js/parallax.min.js', array('jquery'), null, true);
	// phpcs:enable
    // enqueue splide
    wp_enqueue_style('splide-stylesheet', 'https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.3/dist/css/splide.min.css', array(), null);
    wp_enqueue_script('splide-scripts', 'https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.3/dist/js/splide.min.js', array(), null, true);
    // wp_deregister_script( 'jquery' ); // Needed for FooGallery.
}
add_action( 'wp_enqueue_scripts', 'cb_theme_enqueue' );


function custom_excerpt_length( $length ) {
	return 15; // Set to your desired number of words
}
add_filter( 'excerpt_length', 'custom_excerpt_length' );

// phpcs:disable
// function add_custom_menu_item($items, $args)
// {
//     if ($args->theme_location == 'primary_nav') {
//         $new_item = '<li class="menu-item menu-item-type-post_tyep menu-item-object-page nav-item"><a href="' . esc_url(home_url('/search/')) . '" class="nav-link" title="Search"><span class="icon-search"></span></a></li>';
//         $items .= $new_item;
//     }
//     return $items;
// }
// add_filter('wp_nav_menu_items', 'add_custom_menu_item', 10, 2);
// phpcs:enable


add_action( 'enqueue_block_assets', function () {
	if ( has_block( 'acf/cb-feedback-form' ) ) {
		acf_form_head();
	}
}, 1 );

add_filter( 'acf/pre_save_post', 'cb_feedback_set_title_to_zulu_timestamp', 10, 2 );

function cb_feedback_set_title_to_zulu_timestamp( $post_id, $form ) {
	// Only target feedback form submissions
	if ( $form['post_id'] === 'new_post' && isset( $form['new_post']['post_type'] ) && $form['new_post']['post_type'] === 'user_feedback' ) {
		// Generate UTC timestamp in Zulu format (e.g., 2025-05-07T14:23:01Z)
		$timestamp = gmdate( 'Y-m-d\TH:i:s\Z' );

		// Update the post title
		wp_update_post( array(
			'ID'         => $post_id,
			'post_title' => $timestamp,
		) );
	}

	return $post_id;
}

add_action( 'admin_menu', 'cb_add_feedback_log_submenu' );

function cb_add_feedback_log_submenu() {
	add_submenu_page(
		'edit.php?post_type=user_feedback',  // Parent menu
		'Feedback Log',                      // Page title
		'Feedback Log',                      // Menu label
		'edit_posts',                        // Capability
		'feedback-log-admin',                // Menu slug
		'cb_render_feedback_log_admin_page'  // Callback
	);
}

function cb_render_feedback_log_admin_page() {
	$args = array(
		'post_type'      => 'user_feedback',
		'posts_per_page' => -1,
		'post_status'    => 'publish',
		'orderby'        => 'date',
		'order'          => 'DESC',
	);

	$feedback_query = new WP_Query( $args );
	?>
    <div class="wrap">
		<h1>User Feedback</h1>
        <form method="post">
            <input type="hidden" name="cb_export_feedback_csv" value="1">
            <?php submit_button( 'Export to CSV' ); ?>
        </form>

        <table class="wp-list-table widefat fixed striped">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Name</th>
                    <th>Message</th>
                </tr>
            </thead>
            <tbody>
                <?php if ( $feedback_query->have_posts() ) {
                    while ( $feedback_query->have_posts() ) {
                        $feedback_query->the_post();
                        $name    = get_field( 'name' );
                        $message = get_field( 'message' );
                        $date    = get_the_date( 'Y-m-d H:i' );
                        ?>
                        <tr>
                            <td><?= esc_html( $date ); ?></td>
                            <td><?= esc_html( $name ); ?></td>
                            <td><?= nl2br( esc_html( $message ) ); ?></td>
                        </tr>
                    <?php }
                } else { ?>
                    <tr><td colspan="3">No feedback found.</td></tr>
                <?php } ?>
            </tbody>
        </table>
	</div>
	<?php
	wp_reset_postdata();
}


add_action( 'admin_init', 'cb_maybe_export_feedback_csv' );

function cb_maybe_export_feedback_csv() {
	if ( is_admin() && isset( $_POST['cb_export_feedback_csv'] ) && current_user_can( 'edit_posts' ) ) {
		header( 'Content-Type: text/csv; charset=utf-8' );
		header( 'Content-Disposition: attachment; filename=feedback-log.csv' );

		$output = fopen( 'php://output', 'w' );
		fputcsv( $output, array( 'Date', 'Name', 'Message' ) );

		$feedback_query = new WP_Query( array(
			'post_type'      => 'user_feedback',
			'post_status'    => 'publish',
			'posts_per_page' => -1,
			'orderby'        => 'date',
			'order'          => 'DESC',
		) );

		while ( $feedback_query->have_posts() ) {
			$feedback_query->the_post();
			fputcsv( $output, array(
				get_the_date( 'Y-m-d H:i' ),
				get_field( 'name' ),
				get_field( 'message' ),
			) );
		}

		wp_reset_postdata();
		fclose( $output );
		exit;
	}
}