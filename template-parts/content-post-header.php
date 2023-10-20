<?php
/**
 * Template part for displaying post hero in single.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package webiz_starter
 */

?>

<section class="blog-single-header">
    <div class="main-container single-container-inner-width">

        <p class="bsh-category m-b-32 category-badge-view clear-margin"><?php echo get_the_category($post)[0]->name?></p>

        <h1 class="bsh-title has-xxl-font-size narrow-900"><?php the_title();?></h1>

        <div class="bsh-meta">
			<?php singleblog_entry_meta_nds( false );  ?>
        </div>
        <div class="bsh-social-share">
			<?php social_share();  ?>
        </div>
    </div>
</section>
