<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package webiz_starter
 */

 get_header();

 get_template_part( 'template-parts/content-post', 'header' );
 
 ?>
 
	 <div id="primary" class="single-blog content-area container">
		 <main id="main" class="site-main blog-relative">
			 <?php
			 while ( have_posts() ) :
				 the_post();
 
				 get_template_part( 'template-parts/content', 'post' );
 
 
			 endwhile; // End of the loop.
			 ?>
 
		 </main><!-- #main -->
	 </div><!-- #primary -->
 
	 <?php get_template_part( 'template-parts/content-related', 'posts' ); ?>
 
 <?php
 
 get_footer();