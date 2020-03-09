<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package brunoyes
 */
echo '<article id="post-' . get_the_ID() . '" class="' . join( ' ', get_post_class( $class, $post_id ) ) . '">';
echo '<header class="entry-header text_press-link" data-id="' . get_the_ID() . '">';
if (is_singular()) {
    echo get_field( 'resumen_detalles' );
    echo '</header><!-- .entry-header -->';
    echo '<div class="entry-content mobile" data-id="' . get_the_ID() . '">' . get_the_content() . '</div>';
} else {
    echo get_field( 'resumen_catalogo' );
    echo '</header><!-- .entry-header -->';
    echo '<div class="entry-content mobile" data-id="' . get_the_ID() . '"></div>';
}
echo '</article><!-- #post-' . get_the_ID() . ' -->';
?>
