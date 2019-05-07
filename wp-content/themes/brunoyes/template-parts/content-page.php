<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package brunoyes
 */

?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> data-bgColor="<?php the_field('color_fondo'); ?>" data-color="<?php the_field('color_texto'); ?>" data-colorcontent="<?php the_field('color_texto_contenido') ?>" style="color: <?php the_field('color_texto_contenido') ?>;">
	<!--header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
	</header--><!-- .entry-header -->

	<?php brunoyes_post_thumbnail(); ?>

	<div class="entry-content">
		<?php
		the_content();

		wp_link_pages( array(
			'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'brunoyes' ),
			'after'  => '</div>',
		) );
		?>
	</div><!-- .entry-content -->

	<?php if ( get_edit_post_link() ) : ?>
		<footer class="entry-footer">
			<?php
			edit_post_link(
				sprintf(
					wp_kses(
						/* translators: %s: Name of current post. Only visible to screen readers */
						__( 'Edit <span class="screen-reader-text">%s</span>', 'brunoyes' ),
						array(
							'span' => array(
								'class' => array(),
							),
						)
					),
					get_the_title()
				),
				'<span class="edit-link">',
				'</span>'
			);
			?>
		</footer><!-- .entry-footer -->
	<?php endif; ?>
</article><!-- #post-<?php the_ID(); ?> -->
<div class="background-image-container" data-url="<?php echo the_field('imagen_de_fondo'); ?>"></div>
<script>
    (function ($) {
        var image = '<?php echo the_field('imagen_de_fondo'); ?>';
        if (image) {
            $('.background-image-container')
                .css('background-image', 'url(' + image + ')')
        }
    })(jQuery);
</script>
