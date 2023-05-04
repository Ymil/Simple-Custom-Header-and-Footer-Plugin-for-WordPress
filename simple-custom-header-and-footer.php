<?php
/*
Plugin Name: Simple Custom Header and Footer
Description: Este plugin de WordPress te permite crear y administrar fácilmente encabezados y pies de página personalizados utilizando el editor visual de WordPress. Una vez creados, los encabezados y pies de página pueden ser fácilmente incluidos en los archivos header.php y footer.php de tu tema. Con este plugin, puedes crear diseños únicos para tus encabezados y pies de página, y mantener la coherencia en todo tu sitio web.
Version: 1.0
*/

define("CUSTOM_HEADER_FOOTER_POST_TYPE", "custom_header_footer");

function custom_header_footer() {
    $labels = array(
        'name' => _x('Custom Header and Footer', 'post type general name'),
        'singular_name' => _x('Custom Header and Footer', 'post type singular name'),
        'add_new' => _x('Add New', CUSTOM_HEADER_FOOTER_POST_TYPE),
        'add_new_item' => __('Add New Custom Header and Footer'),
        'edit_item' => __('Edit Custom Header and Footer'),
        'new_item' => __('New Custom Header and Footer'),
        'view_item' => __('View Custom Header and Footer'),
        'search_items' => __('Search Custom Header and Footer'),
        'not_found' => __('Nothing found'),
        'not_found_in_trash' => __('Nothing found in Trash'),
        'parent_item_colon' => ''
    );

    $args = array(
        'labels' => $labels,
        'public' => true,
        'publicly_queryable' => true,
        'exclude_from_search' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'query_var' => true,
        'rewrite' => array('slug' => CUSTOM_HEADER_FOOTER_POST_TYPE),
        'capability_type' => 'post',
        'has_archive' => false,
        'hierarchical' => false,
        'menu_position' => null,
        'supports' => array('title', 'editor'),
        'show_in_rest' => true
    );

    register_post_type(CUSTOM_HEADER_FOOTER_POST_TYPE, $args);
}

add_action('init', CUSTOM_HEADER_FOOTER_POST_TYPE);

function custom_header_footer_meta_box() {
    add_meta_box(
        'custom_header_footer_meta_box',
        'Header/Footer',
        'custom_header_footer_meta_box_callback',
        CUSTOM_HEADER_FOOTER_POST_TYPE,
        'side',
        'default'
    );
}

add_action('add_meta_boxes', 'custom_header_footer_meta_box');

function custom_header_footer_meta_box_callback($post) {
    wp_nonce_field("custom_header_footer_meta_box_callback", 'custom_header_footer_nonce');
    $header_or_footer = get_post_meta($post->ID, 'custom_header_footer_type', true);
    ?>
    <p>
        <label for="custom_header_footer_type">Is this post for the header or footer?</label>
        <br />
        <select name="custom_header_footer_type" id="custom_header_footer_type">
            <option value="header" <?php selected($header_or_footer, 'header'); ?>>Header</option>
            <option value="footer" <?php selected($header_or_footer, 'footer'); ?>>Footer</option>
        </select>
    </p>
    <?php
}

// Save custom meta box data
function custom_header_footer_save_meta_box_data($post_id)
{
    // Check if our nonce is set.
    if (!isset($_POST['custom_header_footer_nonce'])) {
        return;
    }

    // Verify that the nonce is valid.
    if (!wp_verify_nonce($_POST['custom_header_footer_nonce'], 'custom_header_footer_meta_box_callback')) {
        return;
    }

    // Check the user's permissions.
    if (isset($_POST['post_type']) && CUSTOM_HEADER_FOOTER_POST_TYPE == $_POST['post_type']) {

        if (current_user_can('edit_post', $post_id)) {

            // Save the header or footer selection.
            if (isset($_POST['custom_header_footer_type'])) {
                update_post_meta($post_id, 'custom_header_footer_type', sanitize_text_field($_POST['custom_header_footer_type']));
            }
        }
    }
}
add_action('save_post', 'custom_header_footer_save_meta_box_data');

function  custom_header_footer_get_custom_header() {
    $args = array(
        'post_type' => CUSTOM_HEADER_FOOTER_POST_TYPE,
        'meta_key' => 'custom_header_footer_type',
        'meta_value' => 'header',
        'posts_per_page' => 1
    );

    $header_query = new WP_Query($args);

    if ($header_query->have_posts()) {
        $header_query->the_post();
        the_content();
    }

    wp_reset_postdata();
}

function  custom_header_footer_get_custom_footer() {
    $args = array(
        'post_type' => CUSTOM_HEADER_FOOTER_POST_TYPE,
        'meta_key' => 'custom_header_footer_type',
        'meta_value' => 'footer',
        'posts_per_page' => 1
    );

    $header_query = new WP_Query($args);

    if ($header_query->have_posts()) {
        $header_query->the_post();
        the_content();
    }

    wp_reset_postdata();
}