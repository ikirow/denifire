<?php
/**
 * WooCommerce Compatibility File
 */

/**
 * WooCommerce setup function.
 *
 * @link https://docs.woocommerce.com/document/third-party-custom-theme-compatibility/
 * @link https://github.com/woocommerce/woocommerce/wiki/Enabling-product-gallery-features-(zoom,-swipe,-lightbox)
 * @link https://github.com/woocommerce/woocommerce/wiki/Declaring-WooCommerce-support-in-themes
 *
 * @return void
 */
function denifire_woocommerce_setup() {
    add_theme_support(
        'woocommerce',
        array(
            'thumbnail_image_width' => 150,
            'single_image_width'    => 300,
            'product_grid'          => array(
                'default_rows'    => 3,
                'min_rows'        => 1,
                'default_columns' => 4,
                'min_columns'     => 1,
                'max_columns'     => 6,
            ),
        )
    );
    add_theme_support( 'wc-product-gallery-zoom' );
    add_theme_support( 'wc-product-gallery-lightbox' );
    add_theme_support( 'wc-product-gallery-slider' );
}
add_action( 'after_setup_theme', 'denifire_woocommerce_setup' );

/**
 * WooCommerce specific scripts & stylesheets.
 *
 * @return void
 */
function denifire_woocommerce_scripts() {
    wp_enqueue_style( 'woo-woocommerce-style', get_template_directory_uri() . '/assets/css/woocommerce.css', array(), filemtime( get_template_directory() . '/assets/css/woocommerce.css') );

    /*
     * Enable if needed
    $font_path   = WC()->plugin_url() . '/assets/fonts/';
    $inline_font = '@font-face {
			font-family: "star";
			src: url("' . $font_path . 'star.eot");
			src: url("' . $font_path . 'star.eot?#iefix") format("embedded-opentype"),
				url("' . $font_path . 'star.woff") format("woff"),
				url("' . $font_path . 'star.ttf") format("truetype"),
				url("' . $font_path . 'star.svg#star") format("svg");
			font-weight: normal;
			font-style: normal;
		}';

    wp_add_inline_style( 'denifire-woocommerce-style', $inline_font );
    */
}
add_action( 'wp_enqueue_scripts', 'denifire_woocommerce_scripts' );

/**
 * Disable the default WooCommerce stylesheet.
 *
 * Removing the default WooCommerce stylesheet and enqueing your own will
 * protect you during WooCommerce core updates.
 *
 * @link https://docs.woocommerce.com/document/disable-the-default-stylesheet/
 */
add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );

/**
 * Add 'woocommerce-active' class to the body tag.
 *
 * @param  array $classes CSS classes applied to the body tag.
 * @return array $classes modified to include 'woocommerce-active' class.
 */
function denifire_woocommerce_active_body_class( $classes ) {
    $classes[] = 'woocommerce-active';

    return $classes;
}
add_filter( 'body_class', 'denifire_woocommerce_active_body_class' );

/**
 * Related Products Args.
 *
 * @param array $args related products args.
 * @return array $args related products args.
 */
function denifire_woocommerce_related_products_args( $args ) {
    $defaults = array(
        'posts_per_page' => 3,
        'columns'        => 3,
    );

    $args = wp_parse_args( $defaults, $args );

    return $args;
}
add_filter( 'woocommerce_output_related_products_args', 'denifire_woocommerce_related_products_args' );

/**
 * Remove default WooCommerce wrapper.
 */
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );

if ( ! function_exists( 'denifire_woocommerce_wrapper_before' ) ) {
    /**
     * Before Content.
     *
     * Wraps all WooCommerce content in wrappers which match the theme markup.
     *
     * @return void
     */
    function denifire_woocommerce_wrapper_before() {
        ?>
        <div class="container">
            <main id="primary" class="site-main">
            
            
        <?php
    }
}

add_action('woocommerce_before_main_content', 'remove_sidebar' );
    function remove_sidebar()
    {
        if ( is_shop() ) { 
         remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10);
       }
    }

add_action( 'woocommerce_before_main_content', 'denifire_woocommerce_wrapper_before' );

if ( ! function_exists( 'denifire_woocommerce_wrapper_after' ) ) {
    /**
     * After Content.
     *
     * Closes the wrapping divs.
     *
     * @return void
     */
    function denifire_woocommerce_wrapper_after() {
        ?>  
            
        </main><!-- #main -->
        <?php
    }
}

add_action( 'woocommerce_sidebar', 'add_wrapper_after_sidebar', 11 );
function add_wrapper_after_sidebar() {
    ?>  
            
        </div><!-- wrapper -->

    <?php
}

add_action( 'woocommerce_after_main_content', 'denifire_woocommerce_wrapper_after' );

/**
 * Sample implementation of the WooCommerce Mini Cart.
 *
 * You can add the WooCommerce Mini Cart to header.php like so ...
 *
<?php
if ( function_exists( 'denifire_woocommerce_header_cart' ) ) {
denifire_woocommerce_header_cart();
}
?>
 */

if ( ! function_exists( 'denifire_woocommerce_cart_link_fragment' ) ) {
    /**
     * Cart Fragments.
     *
     * Ensure cart contents update when products are added to the cart via AJAX.
     *
     * @param array $fragments Fragments to refresh via AJAX.
     * @return array Fragments to refresh via AJAX.
     */
    function denifire_woocommerce_cart_link_fragment( $fragments ) {
        ob_start();
        denifire_woocommerce_cart_link();
        $fragments['a.cart-contents'] = ob_get_clean();

        return $fragments;
    }
}
add_filter( 'woocommerce_add_to_cart_fragments', 'denifire_woocommerce_cart_link_fragment' );

if ( ! function_exists( 'denifire_woocommerce_cart_link' ) ) {
    /**
     * Cart Link.
     *
     * Displayed a link to the cart including the number of items present and the cart total.
     *
     * @return void
     */
    function denifire_woocommerce_cart_link() {
        ?>
        <a class="cart-contents" href="<?php echo esc_url( wc_get_cart_url() ); ?>" title="<?php esc_attr_e( 'View your shopping cart', 'denifire' ); ?>">
            <?php
            $item_count_text = sprintf(
            /* translators: number of items in the mini cart. */
                _n( '%d item', '%d items', WC()->cart->get_cart_contents_count(), 'denifire' ),
                WC()->cart->get_cart_contents_count()
            );
            ?>
            <span class="amount"><?php echo wp_kses_data( WC()->cart->get_cart_subtotal() ); ?></span> <span class="count"><?php echo esc_html( $item_count_text ); ?></span>
        </a>
        <?php
    }
}

if ( ! function_exists( 'denifire_woocommerce_header_cart' ) ) {
    /**
     * Display Header Cart.
     *
     * @return void
     */
    function denifire_woocommerce_header_cart() {
        if ( is_cart() ) {
            $class = 'current-menu-item';
        } else {
            $class = '';
        }
        ?>
        <ul id="site-header-cart" class="site-header-cart">
            <li class="<?php echo esc_attr( $class ); ?>">
                <?php denifire_woocommerce_cart_link(); ?>
            </li>
            <li>
                <?php
                $instance = array(
                    'title' => '',
                );

                the_widget( 'WC_Widget_Cart', $instance );
                ?>
            </li>
        </ul>
        <?php
    }
}


/**
 * Remove Sidebar on product page
 *
 * @return void
 */
add_action( 'wp', 'remove_sidebar_product_pages' );
function remove_sidebar_product_pages() {
    if ( is_product() ) {
        remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );
    }
}


/**
 * Hide shipping rates when free shipping is available.
 * Updated to support WooCommerce 2.6 Shipping Zones.
 *
 * @param array $rates Array of rates found for the package.
 * @return array
 */
add_filter('woocommerce_package_rates', 'my_hide_shipping_when_free_is_available', 100);
function my_hide_shipping_when_free_is_available($rates)
{
    $free = array();

    foreach ($rates as $rate_id => $rate) {
        if ('free_shipping' === $rate->method_id) {
            $free[$rate_id] = $rate;
            break;
        }
    }

    return !empty($free) ? $free : $rates;
}

/**
 * Add make request button after single product image / before single product summary.
 */
add_action( 'woocommerce_before_single_product_summary', 'add_make_request_button', 22 );

function add_make_request_button()
{
    ?>
        <a href="#form__request" class="red-button product__requestBtn">
            Направи запитване
        </a>
    <?php
}

/**
 * Add wrapper around product name and product details.
 */
add_action( 'woocommerce_before_single_product_summary', 'add_summary_wrapper_before', 24  );
function add_summary_wrapper_before()
{
    ?>
        <section class='product__summaryWrapper'>
    <?php
}


add_action( 'woocommerce_after_single_product_summary', 'add_summary_wrapper_after' ); 
function add_summary_wrapper_after()
{
    ?>
        </section>
    <?php
}

/* Remove Categories from Single Products */ 
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );

/* Add SKU to Single Products */ 

add_action( 'woocommerce_single_product_summary', 'show_sku_singl_product_page', 5 );
function show_sku_singl_product_page(){
    global $product;
    ?>
        <div class="single-product__sku">
            <p>Продуктов код:</p>
            <p>
                <?php echo $product->get_sku(); ?>
            </p>
        </div>
    <?php
}

/**
 * Add wrapper around product thumbnail and make request button.
 */
add_action( 'woocommerce_before_single_product_summary', 'add_thumbanil_wrapper_before', 11  );
function add_thumbanil_wrapper_before()
{
    ?>
        <section class='product__thumbnailWrapper'>
    <?php
}


add_action( 'woocommerce_before_single_product_summary', 'add_thumbanil_wrapper_after', 23 ); 
function add_thumbanil_wrapper_after()
{
    ?>
        </section>
    <?php
}

/**
 * Add contact form.
 */



add_action( 'woocommerce_after_single_product', 'add_contact_form' );

function add_contact_form()
{    
    global $product;
    ?>  
        
        <section id="form__request" class="form__request">
            <h1>
                направи запитване
            </h1>
            <div class="form__request--header">
                <div>
                    <h1>
                        <?php
                            echo $product->get_name();
                        ?>
                    </h1>
                    <h2>
                        <?php
                            echo $product->get_weight();
                        ?>
                    </h2>
                </div>
                <div>
                    <p>
                        Продуктов код
                    </p>
                    <h2>
                        <?php
                            echo $product->get_sku();
                        ?>
                    </h2>
                </div>
            </div>
    <?php
    echo do_shortcode( '[contact-form-7 id="11" title="Contact form 1"]' ); 
    ?>
        </section>
    <?php
}

add_filter( 'woocommerce_get_image_size_thumbnail', function( $size ) {
    return array(
    'width' => 185,
    'height' => 200,
    'crop' => 0,
    );
} );

add_filter( 'woocommerce_get_image_size_single', function( $size ) {
    return array(
    'width' => 444,
    'height' => 444,
    'crop' => 0,
    );
} );


/*
 * Disable reviews.
 */


function iconic_disable_reviews() {
    remove_post_type_support( 'product', 'comments' );
}

add_action( 'init', 'iconic_disable_reviews' );


/*
 * Add heading for mobile
 */
add_action( 'woocommerce_before_single_product_summary', 'add_heading_before_product_image', 10 );
function add_heading_before_product_image(){
    global $product;
    ?>
        <h1 class="mobile-only">
            <?php
                echo $product->get_name();
            ?>
        </h1>
    <?php  
}