<?php
/**
 * Template part for displaying post content in single.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package denifire
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class('single-container-inner-width'); ?>>
    <?php get_template_part( 'template-parts/content-post', 'author', array( 'view_type' => 'simple' ) ); ?>
	<div class="entry-content">
		<?php
		the_content();

		wp_link_pages( array(
			'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'denifire' ),
			'after'  => '</div>',
		) );
		?>
	</div><!-- .entry-content -->

     <?php //aget_template_part( 'template-parts/content-post', 'subscribe' ); ?>

</article><!-- #post-<?php the_ID(); ?> -->
