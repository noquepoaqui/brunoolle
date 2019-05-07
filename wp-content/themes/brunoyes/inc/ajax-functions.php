<?php

add_action( 'wp_ajax_brunoyes_get_post_content', 'brunoyes_get_post_content_callback' );
// If you want not logged in users to be allowed to use this function as well, register it again with this function:
add_action( 'wp_ajax_nopriv_brunoyes_get_post_content', 'brunoyes_get_post_content_callback' );

function brunoyes_get_post_content_callback() {

    // retrieve post_id, and sanitize it to enhance security
    $post_id = intval($_POST['post_id'] );

    // Check if the input was a valid integer
    if ( $post_id == 0 ) {
        echo "Invalid Input";
        die();
    }

    // get the post
    $thispost = get_post( $post_id );

    // check if post exists
    if ( !is_object( $thispost ) ) {
        echo 'There is no post with the ID ' . $post_id;
        die();
    }

    echo wpautop($thispost->post_content); //Maybe you want to echo wpautop( $thispost->post_content );

    die();

}
