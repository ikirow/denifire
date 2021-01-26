<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package denifire
 */

?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>	

        <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail();  ?></a>


        <?php        
        if ( is_singular() ) :   
            the_title( '<h1 class="entry-title">', '</h1>' );
        else :
            
        ?>
            <a href="<?php the_permalink(); ?>"><?php the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );; ?></a>
        <?php
        
        endif;
        
        if ( 'post' === get_post_type() ) :
            
            ?>                    
            <div class="entry-meta">
                <?php
                denifire_posted_on();
                denifire_posted_by();
                ?>
            </div><!-- .entry-meta -->
        <?php endif; ?>
    
	<?php
    
	wp_link_pages( array(
		'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'denifire' ),
		'after'  => '</div>',
	) );
	?>
</article>
<!-- .entry-content -->
	

	
