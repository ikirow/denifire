<?php
/**
 * Denifire functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package denifire
 */

if ( !function_exists( 'denifire_setup' ) ) :
    /**
     * Sets up theme defaults and registers support for various WordPress features.
     *
     * Note that this function is hooked into the after_setup_theme hook, which
     * runs before the init hook. The init hook is too late for some features, such
     * as indicating support for post thumbnails.
     */
    function denifire_setup() {
        /*
         * Make theme available for translation.
         * Translations can be filed in the /languages/ directory.
         * If you're building a theme based on Denifire, use a find and replace
         * to change 'denifire' to the name of your theme in all the template files.
         */
        load_theme_textdomain( 'denifire', get_template_directory() . '/languages' );

        // Add default posts and comments RSS feed links to head.
        add_theme_support( 'automatic-feed-links' );

        /*
         * Let WordPress manage the document title.
         * By adding theme support, we declare that this theme does not use a
         * hard-coded <title> tag in the document head, and expect WordPress to
         * provide it for us.
         */
        add_theme_support( 'title-tag' );

        /*
         * Enable support for Post Thumbnails on posts and pages.
         *
         * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
         */
        add_theme_support( 'post-thumbnails' );

        // This theme uses wp_nav_menu() in one location.
        register_nav_menus( array(
            'menu-1'   => esc_html__( 'Primary', 'denifire' ),
            'footer-1' => esc_html__( 'Footer first column', 'denifire' ),
            'footer-2' => esc_html__( 'Footer second column', 'denifire' ),
        ) );

        /*
         * Switch default core markup for search form, comment form, and comments
         * to output valid HTML5.
         */
        add_theme_support( 'html5', array(
            'script',
            'style',
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
        ) );


        // Set up the WordPress core custom background feature.
        add_theme_support( 'custom-background', apply_filters( 'denifire_custom_background_args', array(
            'default-color' => 'ffffff',
            'default-image' => '',
        ) ) );

        // Add theme support for selective refresh for widgets.
        add_theme_support( 'customize-selective-refresh-widgets' );

        /**
         * Add support for core custom logo.
         *
         * @link https://codex.wordpress.org/Theme_Logo
         */
        add_theme_support( 'custom-logo', array(
            'height'      => 250,
            'width'       => 250,
            'flex-width'  => true,
            'flex-height' => true,
        ) );


        /**
         * Support wide(and Full) alignment for editor blocks.
         *
         * @link https://wordpress.org/gutenberg/handbook/extensibility/theme-support/
         */
        add_theme_support( 'align-wide' );


        /**
         * Support default editor block styles.
         *
         * @link https://wordpress.org/gutenberg/handbook/extensibility/theme-support/
         */
        add_theme_support( 'wp-block-styles' );


        /**
         * Add support for editor styles.
         *
         * @link https://wordpress.org/gutenberg/handbook/extensibility/theme-support/
         */
        add_theme_support( 'editor-styles' );


        add_theme_support( 'responsive-embeds' );


        /**
         * Support custom editor block color palette.
         * Don't forget to edit resources/styles/shared/variables.scss when you update these.
         * Uses Material Design colors.
         *
         * @link https://wordpress.org/gutenberg/handbook/extensibility/theme-support/
         */
        add_theme_support(
            'editor-color-palette',
            [
                [
                    'name'  => __( 'Grey Text', 'denifire' ),
                    'slug'  => 'grey-text',
                    'color' => '#646464',
                ],
                [
                    'name'  => __( 'Dark Grey', 'denifire' ),
                    'slug'  => 'dark-grey',
                    'color' => '#333',
                ],
            ]
        );

        /**
         * Support color palette enforcement.
         *
         * @link https://wordpress.org/gutenberg/handbook/extensibility/theme-support/
         */
        // phpcs:ignore
        // add_theme_support( 'disable-custom-colors' );

        /**
         * Support custom editor block font sizes.
         * Don't forget to edit resources/styles/shared/variables.scss when you update these.
         *
         * @link https://wordpress.org/gutenberg/handbook/extensibility/theme-support/
         */
        add_theme_support(
            'editor-font-sizes',
            [
                [
                    'name'      => __( 'Extra small', 'denifire' ),
                    'shortName' => __( 'XS', 'denifire' ),
                    'size'      => 12,
                    'slug'      => 'xs',
                ],
                [
                    'name'      => __( 'Default', 'denifire' ),
                    'shortName' => __( 'D', 'denifire' ),
                    'size'      => 16,
                    'slug'      => 's',
                ],
                [
                    'name'      => __( 'Bigger', 'denifire' ),
                    'shortName' => __( 'B', 'denifire' ),
                    'size'      => 18,
                    'slug'      => 'm',
                ],
                [
                    'name'      => __( 'Large', 'denifire' ),
                    'shortName' => __( 'L', 'denifire' ),
                    'size'      => 28,
                    'slug'      => 'l',
                ],
                [
                    'name'      => __( 'Extra Large', 'denifire' ),
                    'shortName' => __( 'XL', 'denifire' ),
                    'size'      => 36,
                    'slug'      => 'xl',
                ],
            ]
        );


        /**
         * Add Image Sizes here
         */
        // add_image_size( 'hero-banner', 1920, 250, array( 'center' , 'center' ), true ); // Wide cropped banner

    }
endif;
add_action( 'after_setup_theme', 'denifire_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function denifire_content_width() {
    // This variable is intended to be overruled from themes.
    // Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
    // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
    $GLOBALS[ 'content_width' ] = apply_filters( 'denifire_content_width', 720 );
}

add_action( 'after_setup_theme', 'denifire_content_width', 0 );


/**
 * Register scripts, widgets, blocks and other WP elements.
 */
require get_template_directory() . '/inc/register-scripts.php';
// Register widgets
require get_template_directory() . '/inc/register-widgets.php';

require get_template_directory() . '/inc/register-block-styles.php';
// ACF Gutenberg blocks
require get_template_directory() . '/inc/register-blocks.php';
// ACFInclude theme options
//require get_template_directory() . '/inc/register-theme-options.php';

/**
 * Register custom post types and taxonomies
 */

// require get_template_directory() . '/inc/post-types/example-post-type.php';
// require get_template_directory() . '/inc/taxonomies/example-taxonomy.php';


/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * WooCommerce Related functionality
 */
if ( class_exists( 'WooCommerce' ) ) {
    require get_template_directory() . '/inc/woocommerce/woocommerce-functions.php';
}

/**
 * Browser sync trigger for admin changes
 */
add_action('plugins_loaded', function () { // Trigger after the TriggerBrowsersync plugin has loaded
    if (class_exists('TriggerBrowsersync')) { // Check the TriggerBrowsersync plugin loaded correctly
        // Add any configuration filters you may need here.
        // Activate the integration by creating an instance.
        new TriggerBrowsersync();
    }
});
