<?php
/**
 * Modify the site queries before loading
 *
 * @package denifire
 */


add_filter( 'pre_get_posts', function ( $query ) {

    // do not modify queries in the admin
    if ( is_admin() ) {
        return $query;
    }

    // /**
    //  * Bit of confusion
    //  * @see https://developer.wordpress.org/reference/functions/is_home/
    //  */
    // if ( is_home() && !isset( $query->query_vars[ 'post_type' ] ) ) {
    //     // Check if we have queries in the URL
    //     $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;

    //     $query->set( 'paged', $paged );

    //     // Check if the user is searching for a member and add the parameter
    //     $filter_tag = isset( $_GET[ 'category' ] ) ? $_GET[ 'category' ] : false;

    //     // Check if one of the filters is passed
    //     if ( $filter_tag ) {
    //         // Modify the query according the the filters passed
    //         $taxquery = array(
    //             array(
    //                 'taxonomy' => 'category',
    //                 'field'    => 'slug',
    //                 'terms'    => $filter_tag,
    //             ),
    //         );

    //         $query->set( 'tax_query', $taxquery );

    //     }


    // }

    return $query;

} );
