<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package denifire
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function denifire_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Adds a class of no-sidebar when there is no sidebar present.
	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'no-sidebar';
	}

	return $classes;
}
add_filter( 'body_class', 'denifire_body_classes' );

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function denifire_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}
add_action( 'wp_head', 'denifire_pingback_header' );




/**
 * Disable the emoji's
 */
function disable_emojis() {
    remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
    remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
    remove_action( 'wp_print_styles', 'print_emoji_styles' );
    remove_action( 'admin_print_styles', 'print_emoji_styles' );
    remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
    remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
    remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
    add_filter( 'tiny_mce_plugins', 'disable_emojis_tinymce' );
    add_filter( 'wp_resource_hints', 'disable_emojis_remove_dns_prefetch', 10, 2 );
}
add_action( 'init', 'disable_emojis' );

/**
 * Filter function used to remove the tinymce emoji plugin.
 *
 * @param array $plugins
 * @return array Difference between the two arrays
 */
function disable_emojis_tinymce( $plugins ) {
    if ( is_array( $plugins ) ) {
        return array_diff( $plugins, array( 'wpemoji' ) );
    } else {
        return array();
    }
}

/**
 * Remove emoji CDN hostname from DNS prefetching hints.
 *
 * @param array $urls URLs to print for resource hints.
 * @param string $relation_type The relation type the URLs are printed for.
 * @return array Difference betwen the two arrays.
 */
function disable_emojis_remove_dns_prefetch( $urls, $relation_type ) {
    if ( 'dns-prefetch' == $relation_type ) {
        /** This filter is documented in wp-includes/formatting.php */
        $emoji_svg_url = apply_filters( 'emoji_svg_url', 'https://s.w.org/images/core/emoji/2/svg/' );

        $urls = array_diff( $urls, array( $emoji_svg_url ) );
    }

    return $urls;
}


/**
 * Move Gutenberg Styles to footer
 */
function guten_deregister_styles() {
    wp_dequeue_style( 'wp-block-library' );
    wp_dequeue_style( 'wp-block-library-theme' );
}
add_action( 'wp_print_styles', 'guten_deregister_styles', 100 );

function guten_add_footer_styles() {
    wp_enqueue_style( 'wp-block-library' );
    wp_enqueue_style( 'wp-block-library-theme' );
};
add_action( 'get_footer', 'guten_add_footer_styles' );


/**
 * Remove prepend from the archive titles
 */
add_filter( 'get_the_archive_title', function ($title) {
    if ( is_category() ) {
        $title = single_cat_title( '', false );
    } elseif ( is_tag() ) {
        $title = single_tag_title( '', false );
    } elseif ( is_author() ) {
        $title = '<span class="vcard">' . get_the_author() . '</span>' ;
    } elseif ( is_tax() ) { //for custom post types
        $title = sprintf( __( '%1$s' ), single_term_title( '', false ) );
    } elseif ( is_post_type_archive() ) {
        /* translators: Post type archive title. %s: Post type name. */
        $title = sprintf( __( '%1$s' ), post_type_archive_title( '', false ) );
    }
    return $title;
});

function numeric_pagination() {

    if( is_singular() )
        return;

    global $wp_query;

    /** Stop execution if there's only 1 page */
    if( $wp_query->max_num_pages <= 1 )
        return;

    $paged = get_query_var( 'paged' ) ? absint( get_query_var( 'paged' ) ) : 1;
    $max   = intval( $wp_query->max_num_pages );

    /** Add current page to the array */
    if ( $paged >= 1 )
        $links[] = $paged;

    /** Add the pages around the current page to the array */
    if ( $paged >= 3 ) {
        $links[] = $paged - 1;
        $links[] = $paged - 2;
    }

    if ( ( $paged + 2 ) <= $max ) {
        $links[] = $paged + 2;
        $links[] = $paged + 1;
    }

    echo '<div class="navigation"><ul>' . "\n";

    /** Previous Post Link */
    if ( get_previous_posts_link() )
        printf( '<li>%s</li>' . "\n", get_previous_posts_link() );

    /** Link to first page, plus ellipses if necessary */
    if ( ! in_array( 1, $links ) ) {
        $class = 1 == $paged ? ' class="active"' : '';

        printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( 1 ) ), '1' );

        if ( ! in_array( 2, $links ) )
            echo '<li>…</li>';
    }

    /** Link to current page, plus 2 pages in either direction if necessary */
    sort( $links );
    foreach ( (array) $links as $link ) {
        $class = $paged == $link ? ' class="active"' : '';
        printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $link ) ), $link );
    }

    /** Link to last page, plus ellipses if necessary */
    if ( ! in_array( $max, $links ) ) {
        if ( ! in_array( $max - 1, $links ) )
            echo '<li>…</li>' . "\n";

        $class = $paged == $max ? ' class="active"' : '';
        printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $max ) ), $max );
    }

    /** Next Post Link */
    if ( get_next_posts_link() )
        printf( '<li>%s</li>' . "\n", get_next_posts_link() );

    echo '</ul></div>' . "\n";

}

if ( ! function_exists( 'singleblog_entry_meta_nds' ) ) :
	function singleblog_entry_meta_nds( $postID ) {
		$delimiter = " | ";
		global $post;
		/* translators: %1$s: current date, %2$s: current time */
        $post_ID = ( isset( $postID ) ? $postID : $post->ID );

		echo '<div class="entry_meta">';
		echo '<div class="entry_meta_info has-d-font-size">';
		echo '<time class="updated" datetime="' . get_the_time( 'c' ) . '">' . get_the_date()  . '</time>';
		echo $delimiter;
		echo ( display_read_time( $post_ID ) ? "<p class='read_time'>" . display_read_time( $post_ID ) . " " . __( 'min read', 'webiz_starter' ) . "</p>" : "" );
		echo '</div>';
		//echo '<div class="entry_meta_category"><a href="'.get_category_link(get_the_category($post)[0]).'">'.get_the_category($post)[0]->name.'</a></div>';
		echo '</div>';
	}
endif;

if ( ! function_exists( 'display_read_time' ) ) :
function display_read_time( $postID ) {
	$content = get_post_field( 'post_content', $postID );
	$count_words = str_word_count( strip_tags( $content ) );
	$read_time = ceil($count_words / 250);

	return $read_time;
}
endif;

if ( ! function_exists( 'display_related_posts' ) ) :
function display_related_posts() {
	global $post;
	$related_posts = get_posts(array(
		'category__in' => wp_get_post_categories($post->ID),
		'numberposts' => 3,
		'post__not_in' => array($post->ID)
	));

	if(!empty($related_posts)) {
		echo '<div class="related-posts-wrapper">';
		foreach($related_posts as $related_post) {
			$category = get_the_category($related_post->ID)[0];

            $template_args = array(
                'post_ID' => $related_post->ID,
                'category_name' => $category->name,
                'image_url' => get_the_post_thumbnail_url($related_post->ID, 'full'),
                'post_title' => $related_post->post_title,
                'post_date' => get_the_date('', $related_post->ID),
                'post_link' => get_permalink($related_post->ID)
            );
			get_template_part( 'template-parts/content-related', 'single', $template_args );
		}
		echo '</div>';
	}
}
endif;

if ( ! function_exists( 'social_share' ) ) :
	function social_share() {
		if ( shortcode_exists( 'kadence_simple_share' ) ) {
			?>
			<div class="social_share">
				<?php echo do_shortcode('[kadence_simple_share]'); ?>
			</div>
			<?php
		}
	}
endif;