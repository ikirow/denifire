<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package denifire
 */

get_header();
?>
    <header class="page-header hero_section with-title">
        <h1 ><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'denifire' ); ?></h1>
    </header><!-- .page-header -->
    <div id="primary" class="content-area wrapper">
        
        <main id="main" class="site-main">

            

            <div class="page-content">
                <p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'denifire' ); ?></p>

                <?php
                get_search_form();

                ?>

            </div><!-- .page-content -->

        </main><!-- #main -->
    </div><!-- #primary -->


<?php
get_footer();
