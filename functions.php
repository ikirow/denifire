<?php
/**
 * Denifire functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package denifire
 */

if ( ! function_exists( 'write_log' ) ) {
	function write_log( $log ) {
		if ( is_array( $log ) || is_object( $log ) ) {
			error_log( print_r( $log, true ) );
		} else {
			error_log( $log );
		}
	}
}

if ( ! function_exists( 'denifire_setup' ) ) :
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
		register_nav_menus(
			array(
				'menu-1'   => esc_html__( 'Primary', 'denifire' ),
				'footer-1' => esc_html__( 'Footer first column', 'denifire' ),
				'footer-2' => esc_html__( 'Footer second column', 'denifire' ),
				'footer-3' => esc_html__( 'Footer third column', 'denifire' ),
			)
		);

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'script',
				'style',
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
			)
		);

		// Set up the WordPress core custom background feature.
		add_theme_support(
			'custom-background',
			apply_filters(
				'denifire_custom_background_args',
				array(
					'default-color' => 'ffffff',
					'default-image' => '',
				)
			)
		);

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support(
			'custom-logo',
			array(
				'height'      => 250,
				'width'       => 250,
				'flex-width'  => true,
				'flex-height' => true,
			)
		);

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
			array(
				array(
					'name'  => __( 'Grey Text', 'denifire' ),
					'slug'  => 'grey-text',
					'color' => '#646464',
				),
				array(
					'name'  => __( 'Dark Grey', 'denifire' ),
					'slug'  => 'dark-grey',
					'color' => '#333',
				),
			)
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
			array(
				array(
					'name'      => __( 'Extra small', 'denifire' ),
					'shortName' => __( 'XS', 'denifire' ),
					'size'      => 12,
					'slug'      => 'xs',
				),
				array(
					'name'      => __( 'Default', 'denifire' ),
					'shortName' => __( 'D', 'denifire' ),
					'size'      => 16,
					'slug'      => 's',
				),
				array(
					'name'      => __( 'Bigger', 'denifire' ),
					'shortName' => __( 'B', 'denifire' ),
					'size'      => 18,
					'slug'      => 'm',
				),
				array(
					'name'      => __( 'Large', 'denifire' ),
					'shortName' => __( 'L', 'denifire' ),
					'size'      => 26,
					'slug'      => 'l',
				),
				array(
					'name'      => __( 'Extra Large', 'denifire' ),
					'shortName' => __( 'XL', 'denifire' ),
					'size'      => 42,
					'slug'      => 'xl',
				),
			)
		);

		/**
		 * Add Image Sizes here
		 */
		// add_image_size( 'hero-banner', 1920, 250, array( 'center' , 'center' ), true ); // Wide cropped banner
		add_image_size( 'blog-iamge', 422, 237, true );
		add_image_size( 'blog-archive-iamge', 355, 237, false );
		add_image_size( 'categories-list-img', 80, 120, false );
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
	$GLOBALS['content_width'] = apply_filters( 'denifire_content_width', 720 );
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
// require get_template_directory() . '/inc/register-theme-options.php';

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
add_action(
	'plugins_loaded',
	function () {
		// Trigger after the TriggerBrowsersync plugin has loaded
		if ( class_exists( 'TriggerBrowsersync' ) ) { // Check the TriggerBrowsersync plugin loaded correctly
			// Add any configuration filters you may need here.
			// Activate the integration by creating an instance.
			new TriggerBrowsersync();
		}
	}
);


/**
 * Change number of products that are displayed per page (shop page)
 */
add_filter( 'loop_shop_per_page', 'new_loop_shop_per_page', 20 );

function new_loop_shop_per_page( $cols ) {
	// $cols contains the current number of products per page based on the value stored on Options –> Reading
	// Return the number of products you wanna show per page.
	$cols = 16;
	return $cols;
}

function custom_render_block_wc_product_categories( string $block_content, array $block ): string {
	if (
		$block['blockName'] !== 'woocommerce/product-categories'
		|| is_admin()
		|| wp_is_json_request()
		|| is_home()
	) {
		return $block_content;
	}

	$html = '';

	global $wp;
	$current_slug = trim( $wp->request, '/' );

	$dom = new DOMDocument();
	$dom->loadHTML( $block_content );
	$elements = $dom->getElementsByTagName( 'a' );

	if ( $elements['length'] ) {
		foreach ( $elements as $node ) {
			$href = parse_url( $node->getAttribute( 'href' ) );
			$path = trim( $href['path'], '/' );

			if ( $path === $current_slug ) {
				$class  = $node->parentNode->getAttribute( 'class' );
				$class .= ' current-category-item';
				$node->parentNode->setAttribute( 'class', $class );
				break;
			}
		}
	}

	$html .= "<div class='block-outer-wrapper'>";
	$html .= '<header><h4>' . __( 'Categories', 'woocommerce' ) . '</h4></header>';
	$html .= $dom->saveHTML();
	$html .= '</div>';

	return $html;
}
add_filter( 'render_block', 'custom_render_block_wc_product_categories', 10, 2 );


// Exact match for sku search with relevanssi
add_filter( 'relevanssi_hits_filter', 'rlv_sku_exact_match' );
function rlv_sku_exact_match( $hits ) {
	global $wpdb;
	$post_ids = $wpdb->get_col(
		$wpdb->prepare(
			"SELECT post_id FROM $wpdb->postmeta WHERE meta_key = '_sku' AND meta_value = %s",
			$hits[1]
		)
	);
	if ( ! $post_ids ) {
		// No matches found, don't touch the results.
		return $hits;
	}
	// Return only results with ID numbers that are in $post_ids.
	$hits[0] = array_filter(
		$hits[0],
		function ( $hit ) use ( $post_ids ) {
			return in_array( $hit->ID, $post_ids, false );
		}
	);
	return $hits;
}




// if (get_locale() == 'en_GB') {
// add_filter( 'get_search_form', 'rlv_modify_search_form' );
// function rlv_modify_search_form( $form ) {
// $form = str_replace( 'value="Search by name or product number"', 'value="Find"', $form );
// return $form;
// }
// } else {
// add_filter( 'get_search_form', 'rlv_modify_search_form' );
// function rlv_modify_search_form( $form ) {
// $form = str_replace( 'value="Търси по име или продуктов номер"', 'value="Find"', $form );
// return $form;
// }
// }

add_filter( 'relevanssi_search_form', 'rlv_fix_placeholder' );
function rlv_fix_placeholder( $form ) {
	$placeholder_text = 'Search';

	if ( get_locale() == 'en_GB' ) {
		$placeholder_text .= ' Search by name or product number';
	}

	if ( get_locale() == 'bg_BG' ) {
		$placeholder_text .= ' Search by name or product number';
	}
	return str_replace( 'placeholder="Search"', 'placeholder="' . $placeholder_text . '"', $form );
}


/*
 * Manual Contact Form 7 Scripts
 */

// Disable contact-form-7 enqueue actions
add_filter( 'wpcf7_load_js', '__return_false' ); // Disable CF7 JavaScript
add_filter( 'wpcf7_load_css', '__return_false' ); // Disable CF7 CSS

remove_action( 'wp_enqueue_scripts', 'wpcf7_recaptcha_enqueue_scripts', 20 );

// Trigger contact-form-7 enqueue actions when form shortcode is executed
add_filter( 'shortcode_atts_wpcf7', 'contact_form_7_enqueue_scripts' );


function contact_form_7_enqueue_scripts( $out ) {
	if ( function_exists( 'wpcf7_enqueue_scripts' ) ) {
		wpcf7_enqueue_scripts();
	}
	if ( function_exists( 'wpcf7_enqueue_styles' ) ) {
		wpcf7_enqueue_styles();
	}
	if ( function_exists( 'wpcf7_recaptcha_enqueue_scripts' ) ) {
		wpcf7_recaptcha_enqueue_scripts();
	}
	return $out;
}

/*
 * Change WP Login file URL using "login_url" filter hook
 * https://developer.wordpress.org/reference/hooks/login_url/
 */
add_filter( 'login_url', 'custom_login_url', PHP_INT_MAX );
function custom_login_url( $login_url ) {
	// $login_url = site_url( 'denifire-signin.php', 'login' );
	return $login_url;
}

remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 );


add_filter( 'relevanssi_fuzzy_query', 'rlv_match_inside_words' );
function rlv_match_inside_words( $query ) {
	return "(relevanssi.term LIKE '%#term#%') ";
}

function add_leading_zero_to_all_skus() {
	global $wpdb;

	// Get all product IDs
	$product_ids = $wpdb->get_col(
		"
        SELECT ID
        FROM {$wpdb->posts}
        WHERE post_type = 'product'
        AND post_status = 'publish'
    "
	);

	// Loop through each product ID
	foreach ( $product_ids as $product_id ) {
		// Get the SKU
		$sku = get_post_meta( $product_id, '_sku', true );

		// Check if SKU is not empty and is numeric
		if ( ! empty( $sku ) && is_numeric( $sku ) ) {
			// Trim leading zeros
			$sku = ltrim( $sku, '0' );

			// Add leading zero if necessary
			$new_sku = '0' . $sku;

			// Update the product SKU if it's changed
			if ( $new_sku !== $sku ) {
				update_post_meta( $product_id, '_sku', $new_sku );
			}
		}
	}
}
// add_action( 'init', 'add_leading_zero_to_all_skus' );

function my_custom_wp_block_patterns() {

	register_block_pattern(
		'my-patterns/my-custom-pattern',
		array(
			'title'       => __( 'Services page pattern', 'denifire' ),

			'description' => _x( 'Template for new service page', 'Block pattern description', 'denifire' ),

			'content'     => '<!-- wp:kadence/rowlayout {"uniqueID":"9044_ab1bb5-a4","tabletLayout":"row","columnGutter":"none","customGutter":[0,"",""],"colLayout":"equal","maxWidth":1100,"overlayOpacity":0,"align":"full","firstColumnWidth":50,"secondColumnWidth":50,"columnsInnerHeight":true,"padding":["xxl","","xxl",""],"kbVersion":2} -->
            <!-- wp:kadence/column {"background":"#ffffff","borderWidth":["","","",""],"borderRadius":[10,10,10,10],"uniqueID":"9044_069c91-d7","rowGap":[32,"",""],"rowGapVariable":["md","",""],"padding":["xl","xxl","xl","xxl"],"mobilePadding":["sm","xs","sm","xs"],"margin":["","xl","",""],"tabletMargin":["","0","",""],"kbVersion":2,"className":"inner-column-1"} -->
            <div class="wp-block-kadence-column kadence-column9044_069c91-d7 inner-column-1"><div class="kt-inside-inner-col"><!-- wp:kadence/advancedheading {"uniqueID":"9044_c1da5b-bc","color":"palette3","markBorder":"","markBorderStyles":[{"top":[null,"",""],"right":[null,"",""],"bottom":[null,"",""],"left":[null,"",""],"unit":"px"}],"tabletMarkBorderStyles":[{"top":[null,"",""],"right":[null,"",""],"bottom":[null,"",""],"left":[null,"",""],"unit":"px"}],"mobileMarkBorderStyles":[{"top":[null,"",""],"right":[null,"",""],"bottom":[null,"",""],"left":[null,"",""],"unit":"px"}],"colorClass":"theme-palette3","tabletAlign":"center","fontSize":[28,"",""],"fontHeight":[1.2,"",""]} -->
            <h2 class="kt-adv-heading9044_c1da5b-bc wp-block-kadence-advancedheading has-theme-palette-3-color has-text-color" data-kb-block="kb-adv-heading9044_c1da5b-bc">Мобилни Сервизи за Пожарна Техника в Цялата Страна</h2>
            <!-- /wp:kadence/advancedheading -->
            
            <!-- wp:kadence/advancedheading {"uniqueID":"9044_35effc-fc","markBorder":"","markBorderStyles":[{"top":[null,"",""],"right":[null,"",""],"bottom":[null,"",""],"left":[null,"",""],"unit":"px"}],"tabletMarkBorderStyles":[{"top":[null,"",""],"right":[null,"",""],"bottom":[null,"",""],"left":[null,"",""],"unit":"px"}],"mobileMarkBorderStyles":[{"top":[null,"",""],"right":[null,"",""],"bottom":[null,"",""],"left":[null,"",""],"unit":"px"}],"mobileAlign":"center","htmlTag":"p"} -->
            <p class="kt-adv-heading9044_35effc-fc wp-block-kadence-advancedheading" data-kb-block="kb-adv-heading9044_35effc-fc">Изпитайте прецизност в пожарната безопасност с нашите мобилни услуги за поддръжка на пожарна техника. Нашият прецизен подход гарантира, че всеки компонент е внимателно проверен. Доверете ни се за щателен процес на поддръжка, за да може вашата пожарогасителна техника да е в оптимално състояние, готова за бърза реакция и надеждна при възникване на пожар.</p>
            <!-- /wp:kadence/advancedheading -->
            
            <!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"}} -->
            <div class="wp-block-buttons"><!-- wp:button {"style":{"color":{"background":"#ffffff","text":"#000000"}},"className":"is-style-red-button"} -->
            <div class="wp-block-button is-style-red-button"><a class="wp-block-button__link has-text-color has-background wp-element-button" href="https://www.denifire.com/%d0%b7%d0%b0%d0%bf%d0%b8%d1%82%d0%b2%d0%b0%d0%bd%d0%b5/" style="color:#000000;background-color:#ffffff">НАправи запитване</a></div>
            <!-- /wp:button --></div>
            <!-- /wp:buttons --></div></div>
            <!-- /wp:kadence/column -->
            
            <!-- wp:kadence/column {"id":2,"borderWidth":["","","",""],"uniqueID":"9044_ba4f41-08","rowGap":[32,"",""],"rowGapVariable":["custom","",""],"mobilePadding":[0,0,0,0],"mobileMargin":[0,0,0,0],"kbVersion":2,"className":"inner-column-2"} -->
            <div class="wp-block-kadence-column kadence-column9044_ba4f41-08 inner-column-2"><div class="kt-inside-inner-col"><!-- wp:kadence/image {"align":"center","id":8539,"imgMaxWidth":-35,"sizeSlug":"medium_large","linkDestination":"none","uniqueID":"9044_051049-0b","borderRadius":[10,10,10,10]} -->
            <div class="wp-block-kadence-image kb-image9044_051049-0b"><figure class="aligncenter size-medium_large"><img src="https://www.denifire.com/wp-content/uploads/2023/09/IMG_6043-768x576.jpg" alt="" class="kb-img wp-image-8539"/></figure></div>
            <!-- /wp:kadence/image -->
            
            <!-- wp:kadence/rowlayout {"uniqueID":"9044_f3d16c-64","customGutter":[32,"",""],"colLayout":"equal","verticalAlignment":"middle","padding":[0,"0","0","0"],"margin":[null,"","",""],"tabletMargin":["xl","","",""],"kbVersion":2} -->
            <!-- wp:kadence/column {"borderWidth":["","","",""],"uniqueID":"9044_8f682e-10","verticalAlignment":"top","padding":["0","0","0","0"],"kbVersion":2} -->
            <div class="wp-block-kadence-column kadence-column9044_8f682e-10"><div class="kt-inside-inner-col"><!-- wp:kadence/infobox {"uniqueID":"9044_73e6b2-4f","hAlign":"left","hAlignTablet":"center","hAlignMobile":"center","containerBackground":"#ffffff","containerBackgroundOpacity":1,"containerHoverBackgroundOpacity":1,"mediaType":"none","mediaImage":[{"url":"","id":"","alt":"","width":"","height":"","maxWidth":100,"hoverAnimation":"none","flipUrl":"","flipId":"","flipAlt":"","flipWidth":"","flipHeight":"","subtype":"","flipSubtype":""}],"mediaIcon":[{"icon":"fas_check","size":20,"width":2,"title":"","color":"palette1","hoverColor":"palette1","hoverAnimation":"none","flipIcon":""}],"mediaStyle":[{"background":"palette9","hoverBackground":"palette9","border":"#eeeeee","hoverBorder":"#eeeeee","borderRadius":40,"borderWidth":[0,0,0,0],"padding":[14,14,14,14],"margin":[0,0,0,0]}],"titleFont":[{"level":3,"size":["md","",""],"sizeType":"px","lineHeight":[1.2,"",""],"lineType":"em","letterSpacing":"","textTransform":"","family":"","google":false,"style":"normal","weight":"bold","variant":"","subset":"","loadGoogle":true,"padding":[0,0,0,0],"paddingControl":"linked","margin":[5,0,10,0],"marginControl":"individual"}],"textFont":[{"size":["","",""],"sizeType":"px","lineHeight":[1.5,"",""],"lineType":"em","letterSpacing":"","family":"","google":"","style":"","weight":"","variant":"","subset":"","loadGoogle":true}],"textSpacing":[{"padding":["","","",""],"paddingControl":"linked","margin":[0,0,0,0],"marginControl":"individual"}],"learnMoreStyles":[{"size":["","",""],"sizeType":"px","lineHeight":["","",""],"lineType":"px","letterSpacing":"","family":"","google":"","style":"","weight":"","variant":"","subset":"","loadGoogle":true,"padding":[4,8,4,8],"paddingControl":"individual","margin":[10,0,10,0],"marginControl":"individual","color":"","background":"transparent","border":"#555555","borderRadius":0,"borderWidth":[0,0,0,0],"borderControl":"linked","colorHover":"#ffffff","backgroundHover":"#444444","borderHover":"#444444","hoverEffect":"revealBorder"}],"shadow":[{"color":"#000000","opacity":0.1,"spread":-10,"blur":80,"hOffset":0,"vOffset":0}],"shadowHover":[{"color":"#000000","opacity":0.1,"spread":-10,"blur":80,"hOffset":0,"vOffset":0}],"mediaVAlign":"top","mediaAlignMobile":"top","borderStyle":[{"top":["var(\u002d\u002dglobal-palette7, #eeeeee)","",0],"right":["var(\u002d\u002dglobal-palette7, #eeeeee)","",0],"bottom":["var(\u002d\u002dglobal-palette7, #eeeeee)","",0],"left":["var(\u002d\u002dglobal-palette7, #eeeeee)","",0],"unit":"px"}],"borderHoverStyle":[{"top":["palette9","",""],"right":["palette9","",""],"bottom":["palette9","",""],"left":["palette9","",""],"unit":"px"}],"borderRadius":[10,10,10,10],"kbVersion":2} -->
            <div class="wp-block-kadence-infobox kt-info-box9044_73e6b2-4f"><span class="kt-blocks-info-box-link-wrap info-box-link kt-blocks-info-box-media-align-top kt-info-halign-left kb-info-box-vertical-media-align-top kb-info-tablet-halign-center kb-info-mobile-halign-center"><div class="kt-infobox-textcontent"><h3 class="kt-blocks-info-box-title">Поддръжка на Място</h3><p class="kt-blocks-info-box-text">Независимо от местоположението на Вашия обект, нашите мобилни екипи ще дойдат и ще осигурят качествена техническа поддръжка на вашата пожарна техника без да нарушат работния ви процес.</p></div></span></div>
            <!-- /wp:kadence/infobox --></div></div>
            <!-- /wp:kadence/column -->
            
            <!-- wp:kadence/column {"borderWidth":["","","",""],"uniqueID":"9044_555be4-57","verticalAlignment":"top","padding":["0","0","0","0"],"kbVersion":2} -->
            <div class="wp-block-kadence-column kadence-column9044_555be4-57"><div class="kt-inside-inner-col"><!-- wp:kadence/infobox {"uniqueID":"9044_0674f1-2c","hAlign":"left","hAlignTablet":"center","hAlignMobile":"center","containerBackground":"#ffffff","containerBackgroundOpacity":1,"containerHoverBackgroundOpacity":1,"mediaType":"none","mediaImage":[{"url":"","id":"","alt":"","width":"","height":"","maxWidth":100,"hoverAnimation":"none","flipUrl":"","flipId":"","flipAlt":"","flipWidth":"","flipHeight":"","subtype":"","flipSubtype":""}],"mediaIcon":[{"icon":"fas_check","size":20,"width":2,"title":"","color":"palette1","hoverColor":"palette1","hoverAnimation":"none","flipIcon":""}],"mediaStyle":[{"background":"palette9","hoverBackground":"palette9","border":"#eeeeee","hoverBorder":"#eeeeee","borderRadius":40,"borderWidth":[0,0,0,0],"padding":[14,14,14,14],"margin":[0,0,0,0]}],"titleFont":[{"level":3,"size":["md","",""],"sizeType":"px","lineHeight":[1.2,"",""],"lineType":"em","letterSpacing":"","textTransform":"","family":"","google":false,"style":"normal","weight":"bold","variant":"","subset":"","loadGoogle":true,"padding":[0,0,0,0],"paddingControl":"linked","margin":[5,0,10,0],"marginControl":"individual"}],"textFont":[{"size":["","",""],"sizeType":"px","lineHeight":[1.5,"",""],"lineType":"em","letterSpacing":"","family":"","google":"","style":"","weight":"","variant":"","subset":"","loadGoogle":true}],"textSpacing":[{"padding":["","","",""],"paddingControl":"linked","margin":[0,0,0,0],"marginControl":"individual"}],"learnMoreStyles":[{"size":["","",""],"sizeType":"px","lineHeight":["","",""],"lineType":"px","letterSpacing":"","family":"","google":"","style":"","weight":"","variant":"","subset":"","loadGoogle":true,"padding":[4,8,4,8],"paddingControl":"individual","margin":[10,0,10,0],"marginControl":"individual","color":"","background":"transparent","border":"#555555","borderRadius":0,"borderWidth":[0,0,0,0],"borderControl":"linked","colorHover":"#ffffff","backgroundHover":"#444444","borderHover":"#444444","hoverEffect":"revealBorder"}],"shadow":[{"color":"#000000","opacity":0.1,"spread":-10,"blur":80,"hOffset":0,"vOffset":0}],"shadowHover":[{"color":"#000000","opacity":0.1,"spread":-10,"blur":80,"hOffset":0,"vOffset":0}],"mediaVAlign":"top","mediaAlignMobile":"top","borderStyle":[{"top":["var(\u002d\u002dglobal-palette7, #eeeeee)","",0],"right":["var(\u002d\u002dglobal-palette7, #eeeeee)","",0],"bottom":["var(\u002d\u002dglobal-palette7, #eeeeee)","",0],"left":["var(\u002d\u002dglobal-palette7, #eeeeee)","",0],"unit":"px"}],"borderHoverStyle":[{"top":["palette9","",""],"right":["palette9","",""],"bottom":["palette9","",""],"left":["palette9","",""],"unit":"px"}],"borderRadius":[10,10,10,10],"kbVersion":2} -->
            <div class="wp-block-kadence-infobox kt-info-box9044_0674f1-2c"><span class="kt-blocks-info-box-link-wrap info-box-link kt-blocks-info-box-media-align-top kt-info-halign-left kb-info-box-vertical-media-align-top kb-info-tablet-halign-center kb-info-mobile-halign-center"><div class="kt-infobox-textcontent"><h3 class="kt-blocks-info-box-title">Покриваме Цялата Страна</h3><p class="kt-blocks-info-box-text">Без значение дали сте в големия град или в по-малко населено място, ние обслужваме клиенти от цялата страна. Не се притеснявайте да се свържете с нас без значение къде се намира вашия обект.</p></div></span></div>
            <!-- /wp:kadence/infobox --></div></div>
            <!-- /wp:kadence/column -->
            <!-- /wp:kadence/rowlayout --></div></div>
            <!-- /wp:kadence/column -->
            <!-- /wp:kadence/rowlayout -->
            
            <!-- wp:kadence/rowlayout {"uniqueID":"9044_4dc9b2-00","columns":1,"colLayout":"equal","maxWidth":1100,"bgColor":"#ffffff","align":"full","padding":["xxl","","xxl",""],"kbVersion":2} -->
            <!-- wp:kadence/column {"borderWidth":["","","",""],"uniqueID":"9044_f568f1-65","padding":["0","0","0","0"],"tabletPadding":["","3xl","","3xl"],"mobilePadding":["","0","","0"],"kbVersion":2} -->
            <div class="wp-block-kadence-column kadence-column9044_f568f1-65"><div class="kt-inside-inner-col"><!-- wp:kadence/advancedheading {"uniqueID":"9044_a63b72-eb","align":"center","color":"palette3","margin":["0","","lg",""],"markBorder":"","markBorderStyles":[{"top":[null,"",""],"right":[null,"",""],"bottom":[null,"",""],"left":[null,"",""],"unit":"px"}],"tabletMarkBorderStyles":[{"top":[null,"",""],"right":[null,"",""],"bottom":[null,"",""],"left":[null,"",""],"unit":"px"}],"mobileMarkBorderStyles":[{"top":[null,"",""],"right":[null,"",""],"bottom":[null,"",""],"left":[null,"",""],"unit":"px"}],"colorClass":"theme-palette3","fontSize":[28,"",""],"fontHeight":[1.2,"",""],"maxWidth":[800,"",""]} -->
            <h2 class="kt-adv-heading9044_a63b72-eb wp-block-kadence-advancedheading has-theme-palette-3-color has-text-color" data-kb-block="kb-adv-heading9044_a63b72-eb">Дейности, извършвани от нашите мобилни сервизи</h2>
            <!-- /wp:kadence/advancedheading -->
            
            <!-- wp:kadence/iconlist {"listStyles":[{"size":["md","",""],"sizeType":"px","lineHeight":["","",""],"lineType":"px","letterSpacing":"","family":"","google":false,"style":"","weight":"","variant":"","subset":"","loadGoogle":true,"color":"palette3","textTransform":""}],"listGap":24,"listLabelGap":20,"uniqueID":"9044_579a18-51","iconSize":[20,"",""],"icon":"fas_arrow-right","color":"palette1","background":"palette8","borderRadius":50,"padding":15,"borderWidth":0,"style":"stacked"} -->
            <div class="wp-block-kadence-iconlist kt-svg-icon-list-items kt-svg-icon-list-items9044_579a18-51 kt-svg-icon-list-columns-1 alignnone"><ul class="kt-svg-icon-list"><!-- wp:kadence/listitem {"uniqueID":"9044_cc9f12-6b","icon":"fas_arrow-right","text":"Годишна техническа поддръжка на пожарогасители - контрол, техническо обслужване","color":"#ff0000"} -->
            <li class="wp-block-kadence-listitem kt-svg-icon-list-item-wrap kt-svg-icon-list-item-9044_cc9f12-6b"><span data-name="fas_arrow-right" data-stroke="USE_PARENT_DEFAULT_WIDTH" data-class="kt-svg-icon-list-single" class="kadence-dynamic-icon"></span><span class="kt-svg-icon-list-text">Годишна техническа поддръжка на пожарогасители - контрол, техническо обслужване</span></li>
            <!-- /wp:kadence/listitem -->
            
            <!-- wp:kadence/listitem {"uniqueID":"9044_68785a-61","icon":"fas_arrow-right","text":"Ремонт и презареждане на всички видове преносими и возими (на количка) пожарогасители","color":"#ff0000"} -->
            <li class="wp-block-kadence-listitem kt-svg-icon-list-item-wrap kt-svg-icon-list-item-9044_68785a-61"><span data-name="fas_arrow-right" data-stroke="USE_PARENT_DEFAULT_WIDTH" data-class="kt-svg-icon-list-single" class="kadence-dynamic-icon"></span><span class="kt-svg-icon-list-text">Ремонт и презареждане на всички видове преносими и возими (на количка) пожарогасители</span></li>
            <!-- /wp:kadence/listitem -->
            
            <!-- wp:kadence/listitem {"uniqueID":"9044_d6e3a6-e0","icon":"fas_arrow-right","text":"Годишна техническа поддръжка на вътрешни пожарни кранове и шлангови системи","color":"#ff0000"} -->
            <li class="wp-block-kadence-listitem kt-svg-icon-list-item-wrap kt-svg-icon-list-item-9044_d6e3a6-e0"><span data-name="fas_arrow-right" data-stroke="USE_PARENT_DEFAULT_WIDTH" data-class="kt-svg-icon-list-single" class="kadence-dynamic-icon"></span><span class="kt-svg-icon-list-text">Годишна техническа поддръжка на вътрешни пожарни кранове и шлангови системи</span></li>
            <!-- /wp:kadence/listitem -->
            
            <!-- wp:kadence/listitem {"uniqueID":"9044_ee3424-75","icon":"fas_arrow-right","text":"Годишна техническа поддръжка на всички видове външни хидранти","color":"#ff0000"} -->
            <li class="wp-block-kadence-listitem kt-svg-icon-list-item-wrap kt-svg-icon-list-item-9044_ee3424-75"><span data-name="fas_arrow-right" data-stroke="USE_PARENT_DEFAULT_WIDTH" data-class="kt-svg-icon-list-single" class="kadence-dynamic-icon"></span><span class="kt-svg-icon-list-text">Годишна техническа поддръжка на всички видове външни хидранти</span></li>
            <!-- /wp:kadence/listitem -->
            
            <!-- wp:kadence/listitem {"uniqueID":"9044_060d2a-3d","icon":"fas_arrow-right","text":"Техническо обслужване, профилактика и сервиз на пожароизвестителни системи","color":"#ff0000"} -->
            <li class="wp-block-kadence-listitem kt-svg-icon-list-item-wrap kt-svg-icon-list-item-9044_060d2a-3d"><span data-name="fas_arrow-right" data-stroke="USE_PARENT_DEFAULT_WIDTH" data-class="kt-svg-icon-list-single" class="kadence-dynamic-icon"></span><span class="kt-svg-icon-list-text">Техническо обслужване, профилактика и сервиз на пожароизвестителни системи</span></li>
            <!-- /wp:kadence/listitem -->
            
            <!-- wp:kadence/listitem {"uniqueID":"9044_b6af4d-c5","icon":"fas_arrow-right","text":"Техническо обслужване, профилактика и сервиз на пожарогасителни системи","color":"#ff0000"} -->
            <li class="wp-block-kadence-listitem kt-svg-icon-list-item-wrap kt-svg-icon-list-item-9044_b6af4d-c5"><span data-name="fas_arrow-right" data-stroke="USE_PARENT_DEFAULT_WIDTH" data-class="kt-svg-icon-list-single" class="kadence-dynamic-icon"></span><span class="kt-svg-icon-list-text">Техническо обслужване, профилактика и сервиз на пожарогасителни системи</span></li>
            <!-- /wp:kadence/listitem -->
            
            <!-- wp:kadence/listitem {"uniqueID":"9044_9073c7-bf","icon":"fas_arrow-right","text":"Техническо обслужване, профилактика и сервиз на евакуационно и аварийно осветление","color":"#ff0000"} -->
            <li class="wp-block-kadence-listitem kt-svg-icon-list-item-wrap kt-svg-icon-list-item-9044_9073c7-bf"><span data-name="fas_arrow-right" data-stroke="USE_PARENT_DEFAULT_WIDTH" data-class="kt-svg-icon-list-single" class="kadence-dynamic-icon"></span><span class="kt-svg-icon-list-text">Техническо обслужване, профилактика и сервиз на евакуационно и аварийно осветление</span></li>
            <!-- /wp:kadence/listitem -->
            
            <!-- wp:kadence/listitem {"uniqueID":"9044_ee2b4d-e1","icon":"fas_arrow-right","text":"Поддръжка и профилактика на системи за отвеждане на дим и топлина","color":"#ff0000"} -->
            <li class="wp-block-kadence-listitem kt-svg-icon-list-item-wrap kt-svg-icon-list-item-9044_ee2b4d-e1"><span data-name="fas_arrow-right" data-stroke="USE_PARENT_DEFAULT_WIDTH" data-class="kt-svg-icon-list-single" class="kadence-dynamic-icon"></span><span class="kt-svg-icon-list-text">Поддръжка и профилактика на системи за отвеждане на дим и топлина</span></li>
            <!-- /wp:kadence/listitem --></ul></div>
            <!-- /wp:kadence/iconlist --></div></div>
            <!-- /wp:kadence/column -->
            <!-- /wp:kadence/rowlayout -->
            
            <!-- wp:kadence/rowlayout {"uniqueID":"9044_c62bb8-45","columns":1,"colLayout":"equal","maxWidth":1100,"align":"full","padding":["xxl","","xxl",""],"kbVersion":2} -->
            <!-- wp:kadence/column {"borderWidth":["","","",""],"uniqueID":"9044_f80063-2e","kbVersion":2} -->
            <div class="wp-block-kadence-column kadence-column9044_f80063-2e"><div class="kt-inside-inner-col"><!-- wp:kadence/rowlayout {"uniqueID":"9044_2f5891-e0","colLayout":"left-golden","padding":["0","0","0","0"],"margin":["","","sm",""],"kbVersion":2} -->
            <!-- wp:kadence/column {"borderWidth":["","","",""],"uniqueID":"9044_600ebe-a2","kbVersion":2} -->
            <div class="wp-block-kadence-column kadence-column9044_600ebe-a2"><div class="kt-inside-inner-col"><!-- wp:kadence/advancedheading {"uniqueID":"9044_16cdd1-30","color":"palette3","margin":["0","","md",""],"markBorder":"","markBorderStyles":[{"top":[null,"",""],"right":[null,"",""],"bottom":[null,"",""],"left":[null,"",""],"unit":"px"}],"tabletMarkBorderStyles":[{"top":[null,"",""],"right":[null,"",""],"bottom":[null,"",""],"left":[null,"",""],"unit":"px"}],"mobileMarkBorderStyles":[{"top":[null,"",""],"right":[null,"",""],"bottom":[null,"",""],"left":[null,"",""],"unit":"px"}],"colorClass":"theme-palette3","fontSize":["lg","",""],"fontHeight":[1.2,"",""]} -->
            <h2 class="kt-adv-heading9044_16cdd1-30 wp-block-kadence-advancedheading has-theme-palette-3-color has-text-color" data-kb-block="kb-adv-heading9044_16cdd1-30">Мобилни Сервизни Екипи</h2>
            <!-- /wp:kadence/advancedheading -->
            
            <!-- wp:kadence/advancedheading {"uniqueID":"9044_39a87e-dd","color":"palette3","markBorder":"","markBorderStyles":[{"top":[null,"",""],"right":[null,"",""],"bottom":[null,"",""],"left":[null,"",""],"unit":"px"}],"tabletMarkBorderStyles":[{"top":[null,"",""],"right":[null,"",""],"bottom":[null,"",""],"left":[null,"",""],"unit":"px"}],"mobileMarkBorderStyles":[{"top":[null,"",""],"right":[null,"",""],"bottom":[null,"",""],"left":[null,"",""],"unit":"px"}],"colorClass":"theme-palette3","htmlTag":"p"} -->
            <p class="kt-adv-heading9044_39a87e-dd wp-block-kadence-advancedheading has-theme-palette-3-color has-text-color" data-kb-block="kb-adv-heading9044_39a87e-dd">Представяме ви нашите мобилни сервизни екипи, това е нашето специализирано звено, предназначено за ефективна поддръжка на пожарогасители във всяка една точка на страната. Нашите мобилни сервизи за пожарогасители са оборудвани с най-съвременни инструменти и в комбинация с квалифицирания ни екип осигуряваме обслужване , проверка и презареждане, гарантирайки надеждността на Вашето противопожарно оборудване. Бъдете подготвени и сигурни с нашите всеобхватни услуги.</p>
            <!-- /wp:kadence/advancedheading --></div></div>
            <!-- /wp:kadence/column -->
            
            <!-- wp:kadence/column {"id":2,"borderWidth":["","","",""],"uniqueID":"9044_b96652-40","kbVersion":2} -->
            <div class="wp-block-kadence-column kadence-column9044_b96652-40"><div class="kt-inside-inner-col"><!-- wp:kadence/image {"align":"center","id":3730,"imgMaxWidth":200,"linkDestination":"none","uniqueID":"9044_dedbe6-7f"} -->
            <div class="wp-block-kadence-image kb-image9044_dedbe6-7f"><figure class="aligncenter image-is-svg"><img src="https://www.denifire.com/wp-content/uploads/2021/01/Group-36.svg" alt="" class="kb-img wp-image-3730"/></figure></div>
            <!-- /wp:kadence/image -->
            
            <!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"}} -->
            <div class="wp-block-buttons"><!-- wp:button {"style":{"color":{"background":"#ffffff","text":"#000000"}},"className":"is-style-red-button"} -->
            <div class="wp-block-button is-style-red-button"><a class="wp-block-button__link has-text-color has-background wp-element-button" href="https://www.denifire.com/%d0%b7%d0%b0%d0%bf%d0%b8%d1%82%d0%b2%d0%b0%d0%bd%d0%b5/" style="color:#000000;background-color:#ffffff">Направи запитване</a></div>
            <!-- /wp:button --></div>
            <!-- /wp:buttons --></div></div>
            <!-- /wp:kadence/column -->
            <!-- /wp:kadence/rowlayout -->
            
            <!-- wp:kadence/rowlayout {"uniqueID":"9044_48f3ac-b8","columns":3,"tabletLayout":"row","colLayout":"equal","padding":["0","0","0","0"],"kbVersion":2} -->
            <!-- wp:kadence/column {"borderWidth":["","","",""],"uniqueID":"9044_195c20-dc","kbVersion":2} -->
            <div class="wp-block-kadence-column kadence-column9044_195c20-dc"><div class="kt-inside-inner-col"><!-- wp:kadence/infobox {"uniqueID":"9044_333cd9-06","hAlign":"left","hAlignTablet":"center","hAlignMobile":"center","containerBackground":"#ffffff","containerHoverBackground":"palette9","containerPadding":["lg","lg","lg","lg"],"mediaType":"number","mediaIcon":[{"icon":"fe_aperture","size":130,"width":2,"title":"","color":"palette8","hoverColor":"","hoverAnimation":"none","flipIcon":"","tabletSize":"","mobileSize":""}],"mediaStyle":[{"background":"","hoverBackground":"","border":"","hoverBorder":"","borderRadius":0,"borderWidth":[0,0,0,0],"padding":[0,0,8,0],"margin":[-32,15,0,15]}],"titleFont":[{"level":3,"size":["md","",""],"sizeType":"px","lineHeight":["","",""],"lineType":"px","letterSpacing":"","textTransform":"","family":"","google":false,"style":"","weight":"","variant":"","subset":"","loadGoogle":true,"padding":["","","",""],"paddingControl":"linked","margin":[-96,0,32,0],"marginControl":"individual"}],"learnMoreStyles":[{"size":["","",""],"sizeType":"px","lineHeight":["","",""],"lineType":"px","letterSpacing":"","family":"","google":"","style":"","weight":"","variant":"","subset":"","loadGoogle":true,"padding":[0,0,"",0],"paddingControl":"individual","margin":[32,0,0,0],"marginControl":"individual","color":"palette1","background":"transparent","border":"","borderRadius":0,"borderWidth":[0,0,0,0],"borderControl":"linked","colorHover":"palette2","backgroundHover":"","borderHover":"","hoverEffect":"revealBorder","paddingTablet":["","","",""],"paddingMobile":["","","",""],"paddingType":"px","textTransform":""}],"mediaNumber":[{"family":"","google":false,"hoverAnimation":"none","style":"","weight":"700","variant":"","subset":"","loadGoogle":true}],"borderStyle":[{"top":["palette7","",1],"right":["palette7","",1],"bottom":["palette7","",1],"left":["palette7","",1],"unit":"px"}],"borderRadius":[10,10,10,10],"kbVersion":2} -->
            <div class="wp-block-kadence-infobox kt-info-box9044_333cd9-06"><span class="kt-blocks-info-box-link-wrap info-box-link kt-blocks-info-box-media-align-top kt-info-halign-left kb-info-tablet-halign-center kb-info-mobile-halign-center"><div class="kt-blocks-info-box-media-container"><div class="kt-blocks-info-box-media kt-info-media-animate-none"><div class="kadence-info-box-number-container kt-info-number-animate-none"><div class="kadence-info-box-number-inner-container"><div class="kt-blocks-info-box-number">01</div></div></div></div></div><div class="kt-infobox-textcontent"><h3 class="kt-blocks-info-box-title">Спестени Разходи</h3><p class="kt-blocks-info-box-text">Спестяваме ненужни разходи за транспортиране на оборудването до стационарната ни сервизна база</p></div></span></div>
            <!-- /wp:kadence/infobox --></div></div>
            <!-- /wp:kadence/column -->
            
            <!-- wp:kadence/column {"borderWidth":["","","",""],"uniqueID":"9044_0358a9-0f","kbVersion":2} -->
            <div class="wp-block-kadence-column kadence-column9044_0358a9-0f"><div class="kt-inside-inner-col"><!-- wp:kadence/infobox {"uniqueID":"9044_47e315-a8","hAlign":"left","hAlignTablet":"center","hAlignMobile":"center","containerBackground":"palette9","containerHoverBackground":"palette9","containerPadding":["lg","lg","lg","lg"],"mediaType":"number","mediaIcon":[{"icon":"fe_aperture","size":130,"width":2,"title":"","color":"palette8","hoverColor":"","hoverAnimation":"none","flipIcon":"","tabletSize":"","mobileSize":""}],"mediaStyle":[{"background":"","hoverBackground":"","border":"","hoverBorder":"","borderRadius":0,"borderWidth":[0,0,0,0],"padding":[0,0,8,0],"margin":[-32,15,0,15]}],"titleFont":[{"level":3,"size":["md","",""],"sizeType":"px","lineHeight":["","",""],"lineType":"px","letterSpacing":"","textTransform":"","family":"","google":false,"style":"","weight":"","variant":"","subset":"","loadGoogle":true,"padding":["","","",""],"paddingControl":"linked","margin":[-96,0,32,0],"marginControl":"individual"}],"learnMoreStyles":[{"size":["","",""],"sizeType":"px","lineHeight":["","",""],"lineType":"px","letterSpacing":"","family":"","google":"","style":"","weight":"","variant":"","subset":"","loadGoogle":true,"padding":[0,0,"",0],"paddingControl":"individual","margin":[32,0,0,0],"marginControl":"individual","color":"palette1","background":"transparent","border":"","borderRadius":0,"borderWidth":[0,0,0,0],"borderControl":"linked","colorHover":"palette2","backgroundHover":"","borderHover":"","hoverEffect":"revealBorder","paddingTablet":["","","",""],"paddingMobile":["","","",""],"paddingType":"px","textTransform":""}],"mediaNumber":[{"family":"","google":false,"hoverAnimation":"none","style":"","weight":"700","variant":"","subset":"","loadGoogle":true}],"borderStyle":[{"top":["palette7","",1],"right":["palette7","",1],"bottom":["palette7","",1],"left":["palette7","",1],"unit":"px"}],"borderRadius":[10,10,10,10],"kbVersion":2} -->
            <div class="wp-block-kadence-infobox kt-info-box9044_47e315-a8"><span class="kt-blocks-info-box-link-wrap info-box-link kt-blocks-info-box-media-align-top kt-info-halign-left kb-info-tablet-halign-center kb-info-mobile-halign-center"><div class="kt-blocks-info-box-media-container"><div class="kt-blocks-info-box-media kt-info-media-animate-none"><div class="kadence-info-box-number-container kt-info-number-animate-none"><div class="kadence-info-box-number-inner-container"><div class="kt-blocks-info-box-number">02</div></div></div></div></div><div class="kt-infobox-textcontent"><h3 class="kt-blocks-info-box-title">Непрекъсната Сигурност</h3><p class="kt-blocks-info-box-text">Не оставяме обекта без налични пожарогасителни средства по времето на годишната им профилактика</p></div></span></div>
            <!-- /wp:kadence/infobox --></div></div>
            <!-- /wp:kadence/column -->
            
            <!-- wp:kadence/column {"borderWidth":["","","",""],"uniqueID":"9044_c537b9-58","kbVersion":2} -->
            <div class="wp-block-kadence-column kadence-column9044_c537b9-58"><div class="kt-inside-inner-col"><!-- wp:kadence/infobox {"uniqueID":"9044_f2f41a-b7","hAlign":"left","hAlignTablet":"center","hAlignMobile":"center","containerBackground":"palette9","containerHoverBackground":"palette9","containerPadding":["lg","lg","lg","lg"],"mediaType":"number","mediaIcon":[{"icon":"fe_aperture","size":130,"width":2,"title":"","color":"palette8","hoverColor":"","hoverAnimation":"none","flipIcon":"","tabletSize":"","mobileSize":""}],"mediaStyle":[{"background":"","hoverBackground":"","border":"","hoverBorder":"","borderRadius":0,"borderWidth":[0,0,0,0],"padding":[0,0,8,0],"margin":[-32,15,0,15]}],"titleFont":[{"level":3,"size":["md","",""],"sizeType":"px","lineHeight":["","",""],"lineType":"px","letterSpacing":"","textTransform":"","family":"","google":false,"style":"","weight":"","variant":"","subset":"","loadGoogle":true,"padding":["","","",""],"paddingControl":"linked","margin":[-96,0,32,0],"marginControl":"individual"}],"learnMoreStyles":[{"size":["","",""],"sizeType":"px","lineHeight":["","",""],"lineType":"px","letterSpacing":"","family":"","google":"","style":"","weight":"","variant":"","subset":"","loadGoogle":true,"padding":[0,0,"",0],"paddingControl":"individual","margin":[32,0,0,0],"marginControl":"individual","color":"palette1","background":"transparent","border":"","borderRadius":0,"borderWidth":[0,0,0,0],"borderControl":"linked","colorHover":"palette2","backgroundHover":"","borderHover":"","hoverEffect":"revealBorder","paddingTablet":["","","",""],"paddingMobile":["","","",""],"paddingType":"px","textTransform":""}],"mediaNumber":[{"family":"","google":false,"hoverAnimation":"none","style":"","weight":"700","variant":"","subset":"","loadGoogle":true}],"borderStyle":[{"top":["palette7","",1],"right":["palette7","",1],"bottom":["palette7","",1],"left":["palette7","",1],"unit":"px"}],"borderRadius":[10,10,10,10],"kbVersion":2} -->
            <div class="wp-block-kadence-infobox kt-info-box9044_f2f41a-b7"><span class="kt-blocks-info-box-link-wrap info-box-link kt-blocks-info-box-media-align-top kt-info-halign-left kb-info-tablet-halign-center kb-info-mobile-halign-center"><div class="kt-blocks-info-box-media-container"><div class="kt-blocks-info-box-media kt-info-media-animate-none"><div class="kadence-info-box-number-container kt-info-number-animate-none"><div class="kadence-info-box-number-inner-container"><div class="kt-blocks-info-box-number">03</div></div></div></div></div><div class="kt-infobox-textcontent"><h3 class="kt-blocks-info-box-title">Мониторинг на Процеса</h3><p class="kt-blocks-info-box-text">Позволяваме да извършите мониторинг на нашата дейност, за да се убедите сами в професионалния ни подход</p></div></span></div>
            <!-- /wp:kadence/infobox --></div></div>
            <!-- /wp:kadence/column -->
            <!-- /wp:kadence/rowlayout --></div></div>
            <!-- /wp:kadence/column -->
            <!-- /wp:kadence/rowlayout -->
            
            <!-- wp:kadence/rowlayout {"uniqueID":"9044_850f76-27","tabletLayout":"row","collapseGutter":"wider","customRowGutter":[60,"",""],"colLayout":"right-golden","maxWidth":1100,"bgColor":"#ffffff","overlayOpacity":0,"align":"full","padding":["xxl","","xxl",""],"kbVersion":2} -->
            <!-- wp:kadence/column {"borderWidth":["","","",""],"uniqueID":"9044_8343eb-f6","rowGap":[32,"",""],"rowGapVariable":["md","",""],"padding":["","xs","",""],"tabletPadding":["","0","",""],"kbVersion":2} -->
            <div class="wp-block-kadence-column kadence-column9044_8343eb-f6"><div class="kt-inside-inner-col"><!-- wp:kadence/advancedheading {"uniqueID":"9044_b7a503-e8","color":"","margin":["0","","xs",""],"markBorder":"","markBorderStyles":[{"top":[null,"",""],"right":[null,"",""],"bottom":[null,"",""],"left":[null,"",""],"unit":"px"}],"tabletMarkBorderStyles":[{"top":[null,"",""],"right":[null,"",""],"bottom":[null,"",""],"left":[null,"",""],"unit":"px"}],"mobileMarkBorderStyles":[{"top":[null,"",""],"right":[null,"",""],"bottom":[null,"",""],"left":[null,"",""],"unit":"px"}],"colorClass":"","tabletAlign":"center","fontSize":["lg","",""],"fontHeight":[1.2,"",""]} -->
            <h2 class="kt-adv-heading9044_b7a503-e8 wp-block-kadence-advancedheading" data-kb-block="kb-adv-heading9044_b7a503-e8">Открит Процес</h2>
            <!-- /wp:kadence/advancedheading -->
            
            <!-- wp:kadence/advancedheading {"uniqueID":"9044_a02f3e-c5","color":"","markBorder":"","markBorderStyles":[{"top":[null,"",""],"right":[null,"",""],"bottom":[null,"",""],"left":[null,"",""],"unit":"px"}],"tabletMarkBorderStyles":[{"top":[null,"",""],"right":[null,"",""],"bottom":[null,"",""],"left":[null,"",""],"unit":"px"}],"mobileMarkBorderStyles":[{"top":[null,"",""],"right":[null,"",""],"bottom":[null,"",""],"left":[null,"",""],"unit":"px"}],"colorClass":"","tabletAlign":"center","htmlTag":"p"} -->
            <p class="kt-adv-heading9044_a02f3e-c5 wp-block-kadence-advancedheading" data-kb-block="kb-adv-heading9044_a02f3e-c5">Нашият ангажимент към качеството и детайла ни правят предпочитан избор на мнозина за поддържането на тяхната пожарна безопасност. Нашите специалисти следват строги процедури, за да гарантират, че всеки пожарогасител е в оптимално състояние и готов да функционира, когато е най-необходим.</p>
            <!-- /wp:kadence/advancedheading -->
            
            <!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"}} -->
            <div class="wp-block-buttons"><!-- wp:button {"style":{"color":{"background":"#ffffff","text":"#000000"}},"className":"is-style-red-button"} -->
            <div class="wp-block-button is-style-red-button"><a class="wp-block-button__link has-text-color has-background wp-element-button" href="https://www.denifire.com/%d0%b7%d0%b0%d0%bf%d0%b8%d1%82%d0%b2%d0%b0%d0%bd%d0%b5/" style="color:#000000;background-color:#ffffff">Направи Запитване</a></div>
            <!-- /wp:button --></div>
            <!-- /wp:buttons --></div></div>
            <!-- /wp:kadence/column -->
            
            <!-- wp:kadence/column {"id":2,"borderWidth":["","","",""],"uniqueID":"9044_d255bb-2b","kbVersion":2} -->
            <div class="wp-block-kadence-column kadence-column9044_d255bb-2b"><div class="kt-inside-inner-col"><!-- wp:kadence/advancedgallery {"uniqueID":"9044_bda7c2-35","columns":[2,2,2,2,1,1],"ids":[8541,9065,9067,9069],"type":"grid","gutter":[1,"",""],"gutterUnit":"rem","imagesDynamic":[{"id":8541,"link":"https://www.denifire.com/?attachment_id=8541","alt":"","url":"https://www.denifire.com/wp-content/uploads/2023/09/IMG_6044.jpg","customLink":"","linkTarget":"","linkSponsored":"","thumbUrl":"https://www.denifire.com/wp-content/uploads/2023/09/IMG_6044-1024x768.jpg","lightUrl":"https://www.denifire.com/wp-content/uploads/2023/09/IMG_6044.jpg","width":1024,"height":768},{"id":9065,"link":"https://www.denifire.com/?attachment_id=9065","alt":"","caption":{"raw":"","rendered":""},"url":"https://www.denifire.com/wp-content/uploads/2024/03/IMG_5745-scaled.jpg","customLink":"","linkTarget":"","linkSponsored":"","thumbUrl":"https://www.denifire.com/wp-content/uploads/2024/03/IMG_5745-1024x683.jpg","lightUrl":"https://www.denifire.com/wp-content/uploads/2024/03/IMG_5745-scaled.jpg","width":1024,"height":683},{"id":9067,"link":"https://www.denifire.com/?attachment_id=9067","alt":"","caption":{"raw":"","rendered":""},"url":"https://www.denifire.com/wp-content/uploads/2024/03/IMG_5761-scaled.jpg","customLink":"","linkTarget":"","linkSponsored":"","thumbUrl":"https://www.denifire.com/wp-content/uploads/2024/03/IMG_5761-1024x683.jpg","lightUrl":"https://www.denifire.com/wp-content/uploads/2024/03/IMG_5761-scaled.jpg","width":1024,"height":683},{"id":9069,"link":"https://www.denifire.com/?attachment_id=9069","alt":"","caption":{"raw":"","rendered":""},"url":"https://www.denifire.com/wp-content/uploads/2024/03/IMG_5794-scaled.jpg","customLink":"","linkTarget":"","linkSponsored":"","thumbUrl":"https://www.denifire.com/wp-content/uploads/2024/03/IMG_5794-1024x683.jpg","lightUrl":"https://www.denifire.com/wp-content/uploads/2024/03/IMG_5794-scaled.jpg","width":1024,"height":683}],"kbVersion":2} /--></div></div>
            <!-- /wp:kadence/column -->
            <!-- /wp:kadence/rowlayout -->
            
            <!-- wp:kadence/rowlayout {"uniqueID":"9044_0c2928-eb","columns":1,"colLayout":"equal","maxWidth":1100,"align":"full","padding":["xxl","","xxl",""],"kbVersion":2} -->
            <!-- wp:kadence/column {"borderWidth":["","","",""],"uniqueID":"9044_d2fd28-48","padding":["","5xl","","5xl"],"mobilePadding":["","0","","0"],"kbVersion":2,"className":"inner-column-1"} -->
            <div class="wp-block-kadence-column kadence-column9044_d2fd28-48 inner-column-1"><div class="kt-inside-inner-col"><!-- wp:kadence/advancedheading {"uniqueID":"9044_1d96a0-29","align":"center","color":"","margin":["0","","sm",""],"markBorder":"","markBorderStyles":[{"top":[null,"",""],"right":[null,"",""],"bottom":[null,"",""],"left":[null,"",""],"unit":"px"}],"colorClass":"","fontSize":["lg","",""],"fontHeight":[1.2,"",""],"maxWidth":[null,"",""]} -->
            <h2 class="kt-adv-heading9044_1d96a0-29 wp-block-kadence-advancedheading" data-kb-block="kb-adv-heading9044_1d96a0-29">Отзиви от Клиенти</h2>
            <!-- /wp:kadence/advancedheading --></div></div>
            <!-- /wp:kadence/column -->
            
            <!-- wp:kadence/column {"borderWidth":["","","",""],"uniqueID":"9044_601354-c7","textColor":"palette3","linkColor":"palette1","linkHoverColor":"palette2","kbVersion":2,"className":"inner-column-1"} -->
            <div class="wp-block-kadence-column kadence-column9044_601354-c7 inner-column-1"><div class="kt-inside-inner-col"><!-- wp:kadence/rowlayout {"uniqueID":"9044_6e7b28-fe","columns":4,"tabletLayout":"row","colLayout":"two-grid","kbVersion":2} -->
            <!-- wp:kadence/column {"borderWidth":["","","",""],"borderRadius":[16,16,16,16],"uniqueID":"9044_e7f4c0-c7","textAlign":["","center",""],"direction":["vertical","horizontal",""],"justifyContent":["","center",""],"padding":["0","0","0","0"],"kbVersion":2} -->
            <div class="wp-block-kadence-column kadence-column9044_e7f4c0-c7 kb-section-dir-vertical kb-section-md-dir-horizontal"><div class="kt-inside-inner-col"><!-- wp:kadence/testimonials {"uniqueID":"9044_3f349a-0c","hAlign":"left","containerMaxWidth":800,"containerBackground":"palette9","responsiveContainerBorderRadius":[5,5,5,5],"containerPadding":["lg","lg","lg","lg"],"mediaStyles":[{"width":50,"backgroundSize":"cover","background":"","backgroundOpacity":1,"border":"","borderRadius":"","borderWidth":["","","",""],"padding":["","","",""],"margin":["","","",""],"ratio":""}],"mediaBorderStyle":[{"top":["","",0],"right":["","",0],"bottom":["","",0],"left":["","",0],"unit":"px"}],"displayTitle":false,"titleFont":[{"color":"","level":2,"size":["","",""],"sizetype":"px","lineHeight":["","",""],"linetype":"px","letterSpacing":"","textTransform":"","family":"","google":false,"style":"","weight":"","variant":"","subset":"","loadGoogle":true,"padding":["","","",""],"margin":["","","",""]}],"contentFont":[{"color":"palette3","size":[20,"",""],"sizetype":"px","lineHeight":[null,"",""],"linetype":"px","letterSpacing":"","textTransform":"","family":"","google":"","style":"","weight":"","variant":"","subset":"","loadGoogle":true,"lineType":""}],"nameFont":[{"color":"palette1","size":["","",""],"sizetype":"px","lineHeight":["","",""],"linetype":"px","letterSpacing":"","textTransform":"uppercase","family":"","google":"","style":"","weight":"","variant":"","subset":"","loadGoogle":true}],"occupationFont":[{"color":"palette6","size":["sm","",""],"sizetype":"px","lineHeight":["","",""],"linetype":"px","letterSpacing":"","textTransform":"","family":"","google":"","style":"","weight":"","variant":"","subset":"","loadGoogle":true}],"ratingStyles":[{"color":"#ffd700","size":16,"margin":["","","",""],"iconSpacing":"","icon":"fas_star","stroke":2}],"displayShadow":true,"shadow":[{"color":"#000000","opacity":0.05,"spread":-10,"blur":80,"hOffset":0,"vOffset":0}],"kbVersion":2} -->
            <!-- wp:kadence/testimonial {"uniqueID":"9044_42b28c-a5","content":"Страхотно обслужване. Силно препоръчвам.","name":"Венци М.","occupation":"Клиент"} /-->
            <!-- /wp:kadence/testimonials --></div></div>
            <!-- /wp:kadence/column -->
            
            <!-- wp:kadence/column {"borderWidth":["","","",""],"borderRadius":[16,16,16,16],"uniqueID":"9044_1f6ff4-e4","textAlign":["","center",""],"direction":["vertical","horizontal",""],"justifyContent":["","center",""],"padding":["0","0","0","0"],"kbVersion":2} -->
            <div class="wp-block-kadence-column kadence-column9044_1f6ff4-e4 kb-section-dir-vertical kb-section-md-dir-horizontal"><div class="kt-inside-inner-col"><!-- wp:kadence/testimonials {"uniqueID":"9044_b0cef2-ce","hAlign":"left","containerMaxWidth":800,"containerBackground":"palette9","responsiveContainerBorderRadius":[5,5,5,5],"containerPadding":["lg","lg","lg","lg"],"mediaStyles":[{"width":50,"backgroundSize":"cover","background":"","backgroundOpacity":1,"border":"","borderRadius":"","borderWidth":["","","",""],"padding":["","","",""],"margin":["","","",""],"ratio":""}],"mediaBorderStyle":[{"top":["","",0],"right":["","",0],"bottom":["","",0],"left":["","",0],"unit":"px"}],"displayTitle":false,"titleFont":[{"color":"","level":2,"size":["","",""],"sizetype":"px","lineHeight":["","",""],"linetype":"px","letterSpacing":"","textTransform":"","family":"","google":false,"style":"","weight":"","variant":"","subset":"","loadGoogle":true,"padding":["","","",""],"margin":["","","",""]}],"contentFont":[{"color":"palette3","size":[20,"",""],"sizetype":"px","lineHeight":[null,"",""],"linetype":"px","letterSpacing":"","textTransform":"","family":"","google":"","style":"","weight":"","variant":"","subset":"","loadGoogle":true,"lineType":""}],"nameFont":[{"color":"palette1","size":["","",""],"sizetype":"px","lineHeight":["","",""],"linetype":"px","letterSpacing":"","textTransform":"uppercase","family":"","google":"","style":"","weight":"","variant":"","subset":"","loadGoogle":true}],"occupationFont":[{"color":"palette6","size":["sm","",""],"sizetype":"px","lineHeight":["","",""],"linetype":"px","letterSpacing":"","textTransform":"","family":"","google":"","style":"","weight":"","variant":"","subset":"","loadGoogle":true}],"ratingStyles":[{"color":"#ffd700","size":16,"margin":["","","",""],"iconSpacing":"","icon":"fas_star","stroke":2}],"displayShadow":true,"shadow":[{"color":"#000000","opacity":0.05,"spread":-10,"blur":80,"hOffset":0,"vOffset":0}],"kbVersion":2} -->
            <!-- wp:kadence/testimonial {"uniqueID":"9044_4b50f6-21","content":"Много любезни и коректни. Силно препоръчвам.","name":"ВЛАДИМИР М.","occupation":"Клиент"} /-->
            <!-- /wp:kadence/testimonials --></div></div>
            <!-- /wp:kadence/column -->
            
            <!-- wp:kadence/column {"borderWidth":["","","",""],"borderRadius":[16,16,16,16],"uniqueID":"9044_c1392d-37","textAlign":["","center",""],"direction":["vertical","horizontal",""],"justifyContent":["","center",""],"padding":["0","0","0","0"],"kbVersion":2} -->
            <div class="wp-block-kadence-column kadence-column9044_c1392d-37 kb-section-dir-vertical kb-section-md-dir-horizontal"><div class="kt-inside-inner-col"><!-- wp:kadence/testimonials {"uniqueID":"9044_b9dbf4-1e","hAlign":"left","containerMaxWidth":800,"containerBackground":"palette9","responsiveContainerBorderRadius":[5,5,5,5],"containerPadding":["lg","lg","lg","lg"],"mediaStyles":[{"width":50,"backgroundSize":"cover","background":"","backgroundOpacity":1,"border":"","borderRadius":"","borderWidth":["","","",""],"padding":["","","",""],"margin":["","","",""],"ratio":""}],"mediaBorderStyle":[{"top":["","",0],"right":["","",0],"bottom":["","",0],"left":["","",0],"unit":"px"}],"displayTitle":false,"titleFont":[{"color":"","level":2,"size":["","",""],"sizetype":"px","lineHeight":["","",""],"linetype":"px","letterSpacing":"","textTransform":"","family":"","google":false,"style":"","weight":"","variant":"","subset":"","loadGoogle":true,"padding":["","","",""],"margin":["","","",""]}],"contentFont":[{"color":"palette3","size":[20,"",""],"sizetype":"px","lineHeight":[null,"",""],"linetype":"px","letterSpacing":"","textTransform":"","family":"","google":"","style":"","weight":"","variant":"","subset":"","loadGoogle":true,"lineType":""}],"nameFont":[{"color":"palette1","size":["","",""],"sizetype":"px","lineHeight":["","",""],"linetype":"px","letterSpacing":"","textTransform":"uppercase","family":"","google":"","style":"","weight":"","variant":"","subset":"","loadGoogle":true}],"occupationFont":[{"color":"palette6","size":["sm","",""],"sizetype":"px","lineHeight":["","",""],"linetype":"px","letterSpacing":"","textTransform":"","family":"","google":"","style":"","weight":"","variant":"","subset":"","loadGoogle":true}],"ratingStyles":[{"color":"#ffd700","size":16,"margin":["","","",""],"iconSpacing":"","icon":"fas_star","stroke":2}],"displayShadow":true,"shadow":[{"color":"#000000","opacity":0.05,"spread":-10,"blur":80,"hOffset":0,"vOffset":0}],"kbVersion":2} -->
            <!-- wp:kadence/testimonial {"uniqueID":"9044_1216c1-c9","content":"Изключително коректно обслужване, и на високо ниво.","name":"Дарена К.","occupation":"Клиент"} /-->
            <!-- /wp:kadence/testimonials --></div></div>
            <!-- /wp:kadence/column -->
            
            <!-- wp:kadence/column {"borderWidth":["","","",""],"borderRadius":[16,16,16,16],"uniqueID":"9044_1c5629-54","textAlign":["","center",""],"direction":["vertical","horizontal",""],"justifyContent":["","center",""],"padding":["0","0","0","0"],"kbVersion":2} -->
            <div class="wp-block-kadence-column kadence-column9044_1c5629-54 kb-section-dir-vertical kb-section-md-dir-horizontal"><div class="kt-inside-inner-col"><!-- wp:kadence/testimonials {"uniqueID":"9044_eea4fb-27","hAlign":"left","containerMaxWidth":800,"containerBackground":"palette9","responsiveContainerBorderRadius":[5,5,5,5],"containerPadding":["lg","lg","lg","lg"],"mediaStyles":[{"width":50,"backgroundSize":"cover","background":"","backgroundOpacity":1,"border":"","borderRadius":"","borderWidth":["","","",""],"padding":["","","",""],"margin":["","","",""],"ratio":""}],"mediaBorderStyle":[{"top":["","",0],"right":["","",0],"bottom":["","",0],"left":["","",0],"unit":"px"}],"displayTitle":false,"titleFont":[{"color":"","level":2,"size":["","",""],"sizetype":"px","lineHeight":["","",""],"linetype":"px","letterSpacing":"","textTransform":"","family":"","google":false,"style":"","weight":"","variant":"","subset":"","loadGoogle":true,"padding":["","","",""],"margin":["","","",""]}],"contentFont":[{"color":"palette3","size":[20,"",""],"sizetype":"px","lineHeight":[null,"",""],"linetype":"px","letterSpacing":"","textTransform":"","family":"","google":"","style":"","weight":"","variant":"","subset":"","loadGoogle":true,"lineType":""}],"nameFont":[{"color":"palette1","size":["","",""],"sizetype":"px","lineHeight":["","",""],"linetype":"px","letterSpacing":"","textTransform":"uppercase","family":"","google":"","style":"","weight":"","variant":"","subset":"","loadGoogle":true}],"occupationFont":[{"color":"palette6","size":["sm","",""],"sizetype":"px","lineHeight":["","",""],"linetype":"px","letterSpacing":"","textTransform":"","family":"","google":"","style":"","weight":"","variant":"","subset":"","loadGoogle":true}],"ratingStyles":[{"color":"#ffd700","size":16,"margin":["","","",""],"iconSpacing":"","icon":"fas_star","stroke":2}],"displayShadow":true,"shadow":[{"color":"#000000","opacity":0.05,"spread":-10,"blur":80,"hOffset":0,"vOffset":0}],"kbVersion":2} -->
            <!-- wp:kadence/testimonial {"uniqueID":"9044_25c514-f5","content":"Работят бързо и безупречно.","name":"ПЛАМЕН А.","occupation":"Клиент"} /-->
            <!-- /wp:kadence/testimonials --></div></div>
            <!-- /wp:kadence/column -->
            <!-- /wp:kadence/rowlayout --></div></div>
            <!-- /wp:kadence/column -->
            <!-- /wp:kadence/rowlayout -->',

			'categories'  => array( 'denifire' ),
		)
	);
}
add_action( 'init', 'my_custom_wp_block_patterns' );


/**
 * Add a new options page named "Denifire Options".
 */
if ( function_exists( 'acf_add_options_page' ) ) {

	acf_add_options_page(
		array(
			'page_title' => 'Denifire Options',
			'menu_title' => 'Denifire Options',
			'menu_slug'  => 'denifire_options',
			'capability' => 'edit_posts',
			'redirect'   => false,
		)
	);


}
