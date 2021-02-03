<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package denifire
 */

?>

</div><!-- #content -->

<footer id="colophon" class="site-footer">

    <div class="wrapper">
        <div class="row ">

            <div class="col-xs-4">
                <div class="site-branding">
                    <?php
                    // Site logo
                    the_custom_logo();
                    // Footer widget
                    if ( is_active_sidebar( 'footer-widget-1' ) ) {
                        dynamic_sidebar( 'footer-widget-1' );
                    }
                    ?>
                </div><!-- .site-branding -->
            </div>

            <div class="col-xs-4">
                <nav class="footer-navigation">
                    <?php
                    wp_nav_menu( array(
                        'theme_location' => 'footer-1',
                    ) );
                    ?>
                </nav><!-- #site-navigation -->
            </div>

            <div class="col-xs-4">
                <nav class="footer-navigation">
                    <?php
                    wp_nav_menu( array(
                        'theme_location' => 'footer-2',
                    ) );
                    ?>
                </nav><!-- #site-navigation -->
            </div>
        </div>
        <div class="socket">
            <div class="site-info">
                <?php
                /* translators: 1: Theme name, 2: Theme author. */
                printf( esc_html__( 'Denifire Ltd. © 2005 - %1$s %2$s ', 'denifire' ), date("Y"), 'ПОЖАРОГАСИТЕЛИ, ПРОТИВОПОЖАРНА ТЕХНИКА - ДЕНИ ФАЙЕР ООД.' );
                
                ?>
            </div><!-- .site-info -->
        </div>
    </div>

    

</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
