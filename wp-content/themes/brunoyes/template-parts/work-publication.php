<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package brunoyes
 */
if (is_singular()) {
    echo '<article id="post-' . get_the_ID() . '" class="' . join( ' ', get_post_class( $class, $post_id ) ) . '" data-bgColor="' . get_field('color_fondo') . '" data-color="'. get_field('color_texto'). '" data-colorcontent="' . get_field('color_texto_contenido') . '" style="color: ' . get_field('color_texto_contenido') . ';">';
    echo '<header class="entry-header">';
        echo get_field( 'resumen_detalles' );
    echo '</header><!-- .entry-header -->';
    echo '<div class="entry-content">' . get_the_content() . '</div>';
    echo '<div class="extra-content">' . get_field('extra') . '</div>';
} else {
    echo '<article id="post-' . get_the_ID() . '" class="' . join( ' ', get_post_class( $class, $post_id ) ) . '">';
    echo '<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">';
        echo '<header class="entry-header">';
            echo get_field( 'resumen_catalogo' );
        echo '</header><!-- .entry-header -->';
    echo "</a>";
    brunoyes_post_thumbnail();
}
echo '</article><!-- #post-' . get_the_ID() . ' -->';
?>
