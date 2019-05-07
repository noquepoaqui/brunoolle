<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package brunoyes
 */
if (is_singular()) {
    echo '<article id="post-' . get_the_ID() . '" class="' . join( ' ', get_post_class( $class, $post_id ) ) . '">';
    echo '<header class="entry-header text_press-link" data-id="' . get_the_ID() . '">';
        echo get_field( 'resumen_detalles' );
    echo '</header><!-- .entry-header -->';
    echo '<div class="entry-content mobile">' . get_the_content() . '</div>';
} else {
    echo '<article id="post-' . get_the_ID() . '" class="' . join( ' ', get_post_class( $class, $post_id ) ) . '">';
    echo '<header class="entry-header text_press-link" data-id="' . get_the_ID() . '">';
        echo get_field( 'resumen_catalogo' );
    echo '</header><!-- .entry-header -->';
    echo '<div class="entry-content mobile"></div>';
}
echo '</article><!-- #post-' . get_the_ID() . ' -->';
?>
