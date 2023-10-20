<?php

$social_type = $args['social-type'];

if( $social_type == "author" ):
    $author_id = get_the_author_meta('ID');
    $author_linkedin = get_field('linkedin', 'user_'. $author_id );
    $author_twitter = get_field('twitter', 'user_'. $author_id );
    ?>
    <div class="author-socials">
        <?php if($author_linkedin){?>
            <a href="<?php echo $author_linkedin; ?>" target="_blank" class="connect_social"><img src="<?php echo get_stylesheet_directory_uri();?>/assets/icons/linkedin.svg" alt="Linkedin icon"/></a>
        <?php } ?>
        <?php if($author_twitter){?>
            <a href="<?php echo $author_twitter; ?>" target="_blank" class="connect_social"><img src="<?php echo get_stylesheet_directory_uri();?>/assets/icons/twitter.svg" alt="Twitter icon"/></a>
        <?php } ?>
    </div>
    <?php
else:
    ?>
    <div class="bsh-social-share">
		<?php social_share();  ?>
    </div>
<?php
endif;
