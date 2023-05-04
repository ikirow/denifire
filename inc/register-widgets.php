<?php

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */

add_action( 'widgets_init', function () {

    register_sidebar( array(
        'name'          => esc_html__( 'Sidebar', 'denifire' ),
        'id'            => 'sidebar-1',
        'description'   => esc_html__( 'Add widgets here.', 'denifire' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ) );

    register_sidebar( array(
        'name'          => esc_html__( 'Footer widget', 'denifire' ),
        'id'            => 'footer-widget-1',
        'description'   => esc_html__( 'Add widgets here.', 'denifire' ),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ) );

    register_sidebar( array(
        'name'          => esc_html__( 'Footer widget 2', 'denifire' ),
        'id'            => 'footer-widget-2',
        'description'   => esc_html__( 'Add widgets here.', 'denifire' ),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ) );

} );
