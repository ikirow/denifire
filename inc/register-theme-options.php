<?php
/**
 * Register theme options page here
 *
 * @package denifire
 */

function register_denifire_options_pages() {

    // Check function exists.
    if ( !function_exists( 'acf_add_options_page' ) )
        return;

    // register options page.
    $option_page = acf_add_options_page( array(
        'page_title'  => __( 'denifire Theme General Settings', 'denifire' ),
        'menu_title'  => __( 'Theme Settings', 'denifire' ),
        'menu_slug'   => 'theme-general-settings',
        'parent_slug' => 'options-general.php',
        'capability'  => 'edit_posts',
        'redirect'    => false,
        'update_button' => __( 'Save', 'denifire' ),
        // 'autoload' => true,
    ) );
}

// Hook into acf initialization.
add_action( 'acf/init', 'register_denifire_options_pages' );