<?php

/**
 * Gutenberg category registration
 *
 * @package denifire
 */
function denifire_block_category( $categories, $post ) {
    return array_merge(
        $categories,
        array(
            array(
                'slug'  => 'denifire-blocks',
                'title' => __( 'Webiz Blocks', 'denifire' ),
            ),
        )
    );
}

add_filter( 'block_categories', 'denifire_block_category', 10, 2 );



/**
 * Gutenberg blocks registration through ACF
 *
 * @package denifire
 */

add_action( 'acf/init', function () {
    // check function exists
    if ( function_exists( 'acf_register_block' ) ) {

        // ACF Docs
        // https://www.advancedcustomfields.com/resources/acf_register_block_type/

        // register a info block
        acf_register_block( array(
            'name'            => 'example', //Slug - also used for template filename
            'title'           => __( 'Example Box' ),
            'description'     => __( 'Example Description' ),
            'render_callback' => 'denifire_acf_block_render_callback',
            'category'        => 'denifire-blocks',
            'icon'            => 'admin-comments', // change icon?
            'keywords'        => array( 'example', 'keyword' ), // Used for search
            'supports'        => array( 'align' => array( 'full' ), ),
            'mode'            => 'edit',
            'align'           => 'true', // Set to 'full' if it needs to be fullwidth
            // 'enqueue_style' => get_template_directory_uri() . '/template-parts/blocks/css/block-example.css',
            'enqueue_assets' => wp_enqueue_style( 'block-example', get_template_directory_uri() . '/template-parts/blocks/css/block-example.css', array(), filemtime(get_template_directory() . '/template-parts/blocks/css/block-example.css')),           
            
        ) );

        // register category repeater block
        acf_register_block( array(
            'name'            => 'image-link-repeater', //Slug - also used for template filename
            'title'           => __( 'Image link repeater' ),
            'description'     => __( 'repeater with link and image' ),
            'render_callback' => 'denifire_acf_block_render_callback',
            'category'        => 'denifire-blocks',
            'icon'            => 'admin-comments', // change icon?
            'keywords'        => array( 'example', 'keyword' ), // Used for search 
            'supports'        => array( 'align' => array( 'full' ), ),
            'mode'            => 'edit',
            'align'           => 'true', // Set to 'full' if it needs to be fullwidth
            // 'enqueue_style' => get_template_directory_uri() . '/template-parts/blocks/css/block-example.css',
            'enqueue_assets' => wp_enqueue_style( 'image-link-repeater', get_template_directory_uri() . '/template-parts/blocks/css/block-image-link-repeater.css', array(), filemtime(get_template_directory() . '/template-parts/blocks/css/block-image-link-repeater.css')),           
            
        ) );

        acf_register_block( array(
            'name'            => 'text-image-repeater', //Slug - also used for template filename
            'title'           => __( 'Text and image repeater' ),
            'render_callback' => 'denifire_acf_block_render_callback',
            'category'        => 'denifire-blocks',
            'icon'            => 'admin-comments', // change icon?
            'keywords'        => array( 'example', 'keyword' ), // Used for search
            'supports'        => array( 'align' => array( 'full' ), ),
            'mode'            => 'edit',
            'align'           => 'true', // Set to 'full' if it needs to be fullwidth
            // 'enqueue_style' => get_template_directory_uri() . '/template-parts/blocks/css/block-example.css',
            'enqueue_assets' => wp_enqueue_style( 'text-image-repeater', get_template_directory_uri() . '/template-parts/blocks/css/block-text-image-repeater.css', array(), filemtime(get_template_directory() . '/template-parts/blocks/css/block-text-image-repeater.css')),           
            
        ) );
    }
} );

/*
 * General callback function
 *
 * @see https://www.advancedcustomfields.com/blog/acf-5-8-introducing-acf-blocks-for-gutenberg/
 */

function denifire_acf_block_render_callback( $block ) {

    // convert name ("acf/testimonial") into path friendly slug ("testimonial")
    $slug = str_replace( 'acf/', '', $block[ 'name' ] );

    // include a template part from within the "template-parts/blocks" folder
    if ( file_exists( get_theme_file_path( "/template-parts/blocks/block-{$slug}.php" ) ) ) {
        include( get_theme_file_path( "/template-parts/blocks/block-{$slug}.php" ) );
    }
}