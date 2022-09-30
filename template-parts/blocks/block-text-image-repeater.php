

<?php
/**
 * Block template file: 
 *
 * Text Image Repeater Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'text-image-repeater-' . $block['id'];
if ( ! empty($block['anchor'] ) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$classes = 'block-text-image-repeater';
if ( ! empty( $block['className'] ) ) {
    $classes .= ' ' . $block['className'];
}
if ( ! empty( $block['align'] ) ) {
    $classes .= ' align' . $block['align'];
}
?>

<div id="<?php echo esc_attr( $id ); ?>" class="<?php echo esc_attr( $classes ); ?> image-text-repeater">
	<?php if ( have_rows( 'text_and_image_repeater' ) ) : ?>
		<?php while ( have_rows( 'text_and_image_repeater' ) ) : the_row(); ?>
			<?php $image = get_sub_field( 'image' ); ?>
			<?php $size = 'full'; ?>
			<div>
                <?php if ( $image ) : ?> 
                    <?php echo wp_get_attachment_image( $image, $size ); ?>
				<?php endif; ?>
				<label>
					<a href="<?php the_sub_field( 'file_link' ); ?>">
						<?php the_sub_field( 'label' ); ?>
					</a>
				</label>
                
            </div>
		<?php endwhile; ?>
	<?php else : ?>
		<?php // no rows found ?>
	<?php endif; ?>
</div>