<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package denifire
 */

get_header();

get_template_part( 'template-parts/content-post', 'hero' );

?>

	<div id="primary" class="content-area wrapper">
		<aside id="secondary" class="widget-area">
			<?php dynamic_sidebar( 'sidebar-1' ); ?>
		</aside><!-- #secondary -->
		<main id="main" class="site-main">
			<?php if (function_exists('rank_math_the_breadcrumbs') && !is_front_page()) rank_math_the_breadcrumbs(); ?>
			<?php
			while ( have_posts() ) : 
				the_post();

				get_template_part( 'template-parts/content', 'page' );


			endwhile; // End of the loop.
			?>

		</main><!-- #main -->
	</div><!-- #primary -->


<?php

get_footer();
