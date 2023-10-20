<?php


?>
<div class="related-article">
    <a href="<?php echo $args['post_link']; ?>">
        <div class="image-part" style="background-image: url(' <?php echo $args['image_url'] ?> ')">
            <span class="category-badge category-badge-view"><?php echo $args['category_name'] ?></span>
        </div>
    </a>
    <div class="content-part">
        <h2 class="post-title"><?php echo $args['post_title'] ?></h2>
        <?php singleblog_entry_meta_nds( $args['post_ID'] ); ?>
    </div>
</div>
