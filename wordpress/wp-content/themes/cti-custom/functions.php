<?php
/**
 * CTI Test functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package CTICustom
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

/**
 * Register CTI post types.
 *
 * @action init
 */
add_action('init', 'registerCTIPosttype');
function registerCTIPosttype()
{
    // Register Movie post type
    $movie_labels = [
        'name'          => _x('Movies', 'Post type general name', 'cti-custom'),
        'singular_name' => _x('Movie', 'Post type singular name', 'cti-custom')
    ];

    $args = [
        'labels'              => $movie_labels,
        'public'              => true,
        'publicly_queryable'  => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'query_var'           => true,
        'rewrite'             => array('slug' => 'movie'),
        'capability_type'     => 'post',
        'has_archive'         => true,
        'hierarchical'        => false,
        'menu_position'       => null,
        'menu_icon'           => 'dashicons-video-alt2',
        'show_in_rest'        => true,
        'supports'            => array('title', 'editor', 'author', 'thumbnail', 'custom-fields'),
    ];

    register_post_type('movie', $args);
}

/**
 * Register taxonomies.
 *
 * @action init
 */
add_action('init', 'registerCTITaxonomy');
function registerCTITaxonomy()
{
    // Add new taxonomy, NOT hierarchical (like tags)
    $labels = array(
        'name'          => _x('Genres', 'taxonomy general name'),
        'singular_name' => _x('Genre', 'taxonomy singular name'),
    );

    register_taxonomy('genre', 'movie', array(
        'hierarchical'          => false,
        'labels'                => $labels,
        'show_ui'               => true,
        'update_count_callback' => '_update_post_term_count',
        'query_var'             => true,
        'rewrite'               => array('slug' => 'genre'),
        'show_in_rest'          => true,
    ));
}

/**
 * Register theme metaboxes.
 *
 * @action add_meta_boxes
 */
add_action('add_meta_boxes', 'registerCtiMetaboxes');
function registerCtiMetaboxes()
{
    // Add the metabox for the post type / taxonomies settings.
    add_meta_box(
        'movie-settings',
        esc_html__('Settings', 'cti-custom'),
        'movieCustomBox',
        ['movie'],
        'normal',
        'high'
    );
}

/**
 * Call back for settings meta box.
 */
function movieCustomBox() {
    global $post;

    $movie_settings = get_post_meta($post->ID, 'movie-settings', true);

    // Include the meta box template.
    include_once get_template_directory() . '/templates/metabox/movie-settings.php';
}

/**
 * Save metabox data.
 *
 * @action save_post
 *
 * @param $post_id
 */
add_action('save_post', 'wporgSavePostdata');
function wporgSavePostdata($post_id)
{
    $metabox = [
        'movie-settings' => isset($_POST['movie-settings']) ? $_POST['movie-settings'] : '',
    ];

    foreach ($metabox as $name => $value) {
        if ( ! empty($value)) {
            update_post_meta($post_id, $name, $value);
        }
    }
}

/**
 * Enqueue assets.
 */
add_action('wp_enqueue_scripts', 'enqueueFrontAssets');
function enqueueFrontAssets() {
    wp_register_script('cti-front-ui', get_template_directory_uri() . '/assets/dist/js/app.min.js', ['jquery'], time(), true);
    wp_enqueue_script('cti-front-ui');
    wp_enqueue_style('cti-front-ui', get_template_directory_uri() . '/assets/dist/css/app.css', null);
}
