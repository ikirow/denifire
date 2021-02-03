

<?php
/**
 * Block template file: 
 *
 * All Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'all-' . $block['id'];
if ( ! empty($block['anchor'] ) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$classes = 'block-image-link-repeater';
if ( ! empty( $block['className'] ) ) {
    $classes .= ' ' . $block['className'];
}
if ( ! empty( $block['align'] ) ) {
    $classes .= ' align' . $block['align'];
}
?>

<div id="<?php echo esc_attr( $id ); ?>" class="<?php echo esc_attr( $classes ); ?>">
	<?php if ( have_rows( 'image-link-repeater' ) ) : ?>
		<?php while ( have_rows( 'image-link-repeater' ) ) : the_row(); ?>
			<?php $image = get_sub_field( 'image' ); ?>
			<?php $size = 'full'; ?>
			<div class="repeater__content">
				<?php if ( $image ) : ?>
					<?php echo wp_get_attachment_image( $image, $size ); ?>
				<?php endif; ?>
				<?php $link = get_sub_field( 'link' ); ?>
				<?php if ( $link ) : ?>
					<a href="<?php echo esc_url( $link['url'] ); ?>" target="<?php echo esc_attr( $link['target'] ); ?>"><?php echo esc_html( $link['title'] ); ?></a>
				<?php endif; ?>
			</div>			
		<?php endwhile; ?>
	<?php else : ?>
		<?php // no rows found ?>
	<?php endif; ?>
</div>