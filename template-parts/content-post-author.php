<?php

$author_id = get_the_author_meta('ID');
$author_description = get_the_author_meta( 'description' );
$author_linkedin = get_field('linkedin', 'user_'. $author_id );
$author_twitter = get_field('twitter', 'user_'. $author_id );
$author_image = get_field('profile_picture', 'user_'. $author_id );
if($author_image){
    if( $args['view_type'] == 'simple' ):
    ?>
    <div class="author-box-sidebar">
        <?php if ( !empty( $author_image ) ): ?>
        <div class="rounded_image">
            <div class="rounded_image_inner">
                <img src="<?php echo $author_image['url']; ?>" alt="<?php echo $author_image['alt']; ?>" />
            </div>
        </div>
        <?php endif; ?>
        <h5 class="clear-margin"><?php echo get_the_author_meta( 'first_name' ); ?> <?php echo get_the_author_meta( 'last_name' ); ?></h5>
        <p class="position clear-margin"><?php echo get_field('position', 'user_'. $author_id );?></p>
        <p class="bio clear-margin"><?php echo $author_description; ?></p>
        <?php get_template_part( 'template-parts/content', 'social', array( 'social-type' => 'author' ) ); ?>
    </div>
    <?php
    else:
    ?>
    <div class="author-box">
	    <?php if ( !empty( $author_image ) ): ?>
        <div class="author-box-image">
            <div class="rotated_image">
                <div class="rotated_image_inner">
                    <img src="<?php echo $author_image['url']; ?>" alt="<?php echo $author_image['alt']; ?>" />
                </div>
            </div>
        </div>
	    <?php endif; ?>
        <div class="author-box-bio">
            <p class="author-section-title clear-margin"><?php _e('Author ','denifire') ?></p>
            <div>
                <?php echo get_the_author_meta( 'first_name' ); ?> <?php echo get_the_author_meta( 'last_name' ); ?>
                <p class="clear-margin"><?php echo get_field('position', 'user_'. $author_id );?></p>

                <?php get_template_part( 'template-parts/content-author', 'social' ); ?>
            </div>
        </div>
        <div class="author-box-description">
            <p class="author-section-title clear-margin"><?php _e('About the author ','denifire') ?></p>
            <p class="clear-margin"><?php echo $author_description; ?></p>
        </div>
    </div>
    <?php
    endif;
}
