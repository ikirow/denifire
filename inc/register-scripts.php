<?php

/**
 * Register/Deregister main styles and scripts
 * Make sure the priority is low enough to avoid conflicts with plugins
 *
 * filemtime() can be used for dynamic versioning
 *
 * @since  1.0
 * @return void
 */

//Enable if using google fonts or need other prefetch
//add_action( 'wp_head', 'prefetch_resources' );
function prefetch_resources() {
    ?>
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="anonymous">
    <?php
}


add_action( 'wp_enqueue_scripts', 'denifire_scripts' );
function denifire_scripts() {

    wp_enqueue_style( 'denifire-style', get_template_directory_uri() . '/assets/css/site.css', array('wp-block-library'), filemtime(
        get_template_directory
        () .
        '/assets/css/site.css' ) );
//    wp_style_add_data( 'denifire-style', 'rtl', 'replace' );

    wp_enqueue_script( 'denifire-navigation', get_template_directory_uri() . '/assets/js/navigation.js', array(), '20151215', true );

    wp_enqueue_script( 'denifire-skip-link-focus-fix', get_template_directory_uri() . '/assets/js/skip-link-focus-fix.js', array(),
        '20151215',
        true );

    wp_enqueue_script(
        'denifire-app',
        get_template_directory_uri() . '/assets/js/app.js',
        array( 'jquery' ),
        filemtime(
            get_template_directory() .
            '/assets/js/app.js' ), true
    );

    // @todo add conditionals to limit the js load

    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' ); 
        
    }
}



/*
 * Add styling to visualise blocks in the admin
 */

add_action( 'enqueue_block_editor_assets', 'gutenberg_assets' );
function gutenberg_assets() {
    // Load the theme styles within Gutenberg.
    wp_enqueue_style( 'gutenberg-styles', get_template_directory_uri() . '/assets/css/site-admin.css', false );
    /*
    wp_enqueue_script( 'guten-script',
        get_template_directory_uri() . '/assets/js/guten.js', array( 'wp-blocks'), filemtime( get_template_directory() . '/assets/js/guten.js')
    );
    */
}




