<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package denifire
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">

    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">
    <a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'denifire' ); ?></a>

    <header id="masthead" class="site-header">
        <div class="row space-between">
            <div class="site-branding">
                <?php
                if ( has_custom_logo() ) {
                    the_custom_logo();
                } else {
                    echo '<a href="' . esc_url( home_url( '/' ) ) . '" class="logo-text" rel="home">';
                    // Get the site name and cut the words
                    $site_name = get_bloginfo( 'name' );
                    $new_site_name = explode( " ", $site_name );

                    if ( $new_site_name ) {
                        echo $new_site_name[0];
                        $total_words = count( $new_site_name );
                        if ( $total_words > 1 ) {
                            $i = 1;
                            while( $i < $total_words ) {
                                echo '<span class="green">' . $new_site_name[$i] . '</span>';
                                $i++;
                            }
                        }
                    }
                    echo '</a>';
                }

                $denifire_description = get_bloginfo( 'description', 'display' );
                if ( $denifire_description || is_customize_preview() ) {
                    // echo $denifire_description; /* WPCS: xss ok. */
                }
                ?>

            </div><!-- .site-branding -->

            <nav id="site-navigation" class="main-navigation">
                <div class="hamburger menu-toggle" aria-controls="primary-menu"
                        aria-expanded="false">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
                <?php
                // Just echo the main menu
                if ( has_nav_menu( 'menu-1' ) ) {

                    wp_nav_menu( array(
                        'theme_location' => 'menu-1',
                        'container'      => false,
                        'items_wrap'     => '<ul id="%1$s" class="%2$s" data-responsive-menu="drilldown">%3$s</ul>',
                        'menu_class'     => 'megamenu-wrapper',
                        'menu_id'        => 'primary-menu',
                    ) );

                }

                ?>
            </nav><!-- #site-navigation -->
        </div>
    </header><!-- #masthead -->

    <style>
        <?php
        $hero_override = get_field( 'hero_background_override' );
        if($hero_override){?>
            .hero_section{
                background-image: url(<?php echo $hero_override; ?>)!important;
            }
        <?php } ?>
        <?php
        $mobile_hero_override = get_field( 'mobile_background_override' );
        if($mobile_hero_override){?>
            @media(max-width: 480px) {
                .hero_section {
                    background-image: url(<?php echo $mobile_hero_override; ?>)!important;
                }
            }
        <?php } ?>
    </style>
    <?php

    $show_hero = false;
    if(is_archive() || is_singular('product')|| is_home()){
        $show_hero = true;
    }elseif ((is_page() || is_single()) && !(get_field( 'show_hero' ) === false)){
        $show_hero = true;
    }

    $show_title = false;
    if((is_page() || is_single()) && !(get_field( 'show_hero' ) === false)){
        $show_title = true;
    }else if(is_archive() || is_home()){
        $show_title = true;
    }

    $title = get_the_title();
    if(is_archive() || is_home()){
        $title = get_the_archive_title();
    }

    ?>

    <?php if(!is_front_page()){
        if($show_hero){
        ?>
        <div class="hero_section <?php if($show_title){ echo 'with-title';}?>">
            <?php if($show_title){ ?>
                <h1><?php echo $title;?></h1>
            <?php } ?>
        </div>
        <?php } ?>
    <?php } ?>

    <div id="content" class="site-content">
