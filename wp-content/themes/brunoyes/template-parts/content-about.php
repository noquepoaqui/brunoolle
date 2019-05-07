<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> data-bgColor="<?php the_field('color_fondo'); ?>" data-color="<?php the_field('color_texto'); ?>" data-colorcontent="<?php the_field('color_texto_contenido') ?>" style="color: <?php the_field('color_texto_contenido') ?>;">

    <?php the_field('about'); ?>

</article><!-- #post-<?php the_ID(); ?> -->
