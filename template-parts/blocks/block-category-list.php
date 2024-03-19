<?php
/**
 * Block template file:
 *
 * Category List Block Template.
 *
 * @param array $block The block settings and attributes.
 * @param string $content The block inner HTML (empty).
 * @param bool $is_preview True during AJAX preview.
 * @param (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'category-list-' . $block['id'];
if ( ! empty( $block['anchor'] ) ) {
	$id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$classes = 'block-category-list';
if ( ! empty( $block['className'] ) ) {
	$classes .= ' ' . $block['className'];
}
if ( ! empty( $block['align'] ) ) {
	$classes .= ' align' . $block['align'];
}
?>

<style type="text/css">
	<?php echo '#' . $id; ?> {
		/* Add styles that use ACF values here */
	}
</style>

<div id="<?php echo esc_attr( $id ); ?>" class="<?php echo esc_attr( $classes ); ?>">
	<?php if ( have_rows( 'categories' ) ) : ?>
		<?php
		while ( have_rows( 'categories' ) ) :
			the_row();
			?>
			<?php $single_category = get_sub_field( 'single_category' ); ?>
			<?php $term = get_term_by( 'id', $single_category, 'product_cat' ); ?>
			<?php if ( $term ) : ?>
				<div class="single-cat">
				<?php $custom_link = get_sub_field( 'custom_link' ); ?>
				<?php if ( $custom_link ) : ?>
				<a href="<?php the_sub_field( 'custom_link' ); ?>" > 
				<?php endif; ?>
				<?php
				// get the thumbnail id using the queried category term_id
				$thumbnail_id = get_term_meta( $term->term_id, 'thumbnail_id', true );

				// get the image URL
				$image = wp_get_attachment_image( $thumbnail_id, 'categories-list-img' );

				echo $image;
				?>
					<h2><?php echo esc_html( $term->name ); ?></h2>
				</a>
				</div>
			<?php endif; ?>
		<?php endwhile; ?>
	<?php else : ?>
		<?php // no rows found ?>
	<?php endif; ?>
</div>
