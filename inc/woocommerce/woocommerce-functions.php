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
            <?php echo __('Направи запитване:', 'denifire') ?>
        </a>
    <?php
}



/**
 * Add wrapper around product name and product details.
 */

add_action( 'woocommerce_before_single_product_summary', 'add_product_wrapper_before', 6  );
function add_product_wrapper_before()
{
    ?>
        <section class='product__Wrapper flex'>
    <?php
}

add_action( 'woocommerce_before_single_product_summary', 'add_summary_wrapper_before', 24  );
function add_summary_wrapper_before()
{
    ?>
        <section class='product__summaryWrapper'>
    <?php
}

add_action( 'woocommerce_before_single_product_summary', 'add_sidebar', 5  );
function add_sidebar()
{
   dynamic_sidebar( 'sidebar-1' ); 
}


add_action( 'woocommerce_after_single_product_summary', 'add_summary_wrapper_after', 23 ); 
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
    $catalouge_number = $product->get_attribute( 'CODE' );
    ?>
        <div class="single-product__sku">
            <p><?php echo __('Продуктов код:', 'denifire') ?></p>
            <p>
                <?php
                    if(get_field('product_code')){
                        the_field('product_code');
                    } else {
                        echo $product->get_sku();
                    }
                ?>
            </p>
        </div>
        <?php
            if ($catalouge_number) {
                ?>
                    <div class="single-product__sku">
                        <p><?php echo __('Каталожен номер:', 'denifire') ?></p>
                        <p>
                            <?php echo $catalouge_number ?>
                        </p>
                    </div>
                <?php
            }
        ?>
        
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


add_action( 'woocommerce_before_single_product_summary', 'add_thumbanil_wrapper_after', 22 ); 
function add_thumbanil_wrapper_after()
{
    ?>
        </section>
    <?php
}


add_action( 'woocommerce_after_single_product_summary', 'add_product_wrapper_after', 29  );
function add_product_wrapper_after()
{
    ?>
        <section>
    <?php
}

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

remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20);
add_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 25);

/**
 * Add contact form.
 */

add_action( 'woocommerce_after_single_product', 'add_contact_form', 15 );

function add_contact_form()
{    
    global $product;
    ?>  
        
        <section id="form__request" class="form__request">
            <h2 class="form__request--heading">
                <?php echo __('направи запитване', 'denifire') ?>
            </h2>
            <div class="form__request--header">
                <div>
                    <h2 class="form__request--product-name">
                        <?php
                            echo $product->get_name();
                        ?>
                    </h2>
                    <h3>
                        <?php
                            echo $product->get_weight();
                        ?>
                    </h3>
                </div>
                <div>
                    <p>
                        <p><?php echo __('Продуктов код:', 'denifire') ?></p>
                    </p>
                    <h2>
                        <?php
                            if(get_field('product_code')){
                                the_field('product_code');
                            } else {
                                echo $product->get_sku();
                            }
                        ?>
                    </h2>
                </div>
            </div>
    <?php
    
    if (get_locale() == 'en_GB' || get_locale() == 'en_US') {
        echo do_shortcode( '[contact-form-7 id="7027" title="Service inquiry"]' ); 
    } else {
        echo do_shortcode( '[contact-form-7 id="11" title="Contact form 1"]' ); 
    }
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


add_action('woocommerce_show_page_title', 'remove_woocommerce_page_title');
function remove_woocommerce_page_title() {
    return false;
}

//Add disclaimer to the category page
add_action( 'woocommerce_before_main_content', 'add_disclaimer', 1 );
// add_action( 'woocommerce_before_single_product', 'add_disclaimer', 10);
function add_disclaimer() {
    ?>
        <div class='container'>
        <p class="products-disclaimer">
            <?php echo __('Предлаганите продукти на сайта са с информативна цел. На пазара в Република България се предлагат и предоставят единствено продукти , които са одобрени  и разрешени за продажба съгласно действащите наредби в Република България. ', 'denifire'); ?>
        </p>
        </div>
    <?php
}