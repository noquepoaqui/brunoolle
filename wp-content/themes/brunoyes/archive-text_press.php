<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package brunoyes
 */

get_header();
?>

    <div id="primary" class="content-area">
        <main id="main" class="site-main row">

        <?php if ( have_posts() ) : ?>
            <div class="posts two-columns">
            <?php
            /* Start the Loop */
            while ( have_posts() ) :
                the_post();

                /*
                 * Include the Post-Type-specific template for the content.
                 * If you want to override this in a child theme, then include a file
                 * called content-___.php (where ___ is the Post Type name) and that will be used instead.
                 */
                get_template_part( 'template-parts/content', get_post_type() );

            endwhile;
            the_posts_navigation(); ?>
            </div>
            <div class="two-columns main-entry-content"></div>
        <?php
        else :

            get_template_part( 'template-parts/content', 'none' );

        endif;
        ?>

        </main><!-- #main -->
    </div><!-- #primary -->
<script>
    (function ($) {
        function scrollToElementHeader(element) {
            var body = $([document.documentElement, document.body]);
            if (body.width() < 783) {
                $([document.documentElement, document.body]).animate({
                    scrollTop: element.offset().top - 80
                }, 250);
            }
        }

        $(".text_press-link").click(function (e) {
            e.preventDefault();

            $('.entry-content').hide();

            var $this = $(this);
            var entryContent = $this.siblings('.entry-content');
            var mainEntryContent = $('.main-entry-content').hide();

            if (!entryContent.children().length) {
                var id_post = $(this).data('id');
                $.ajax({
                    type: 'POST',
                    url: '<?php echo admin_url('admin-ajax.php'); ?>',
                    data: {
                        'post_id': id_post,
                        'action': 'brunoyes_get_post_content' //this is the name of the AJAX method called in WordPress
                    }, success: function (result) {
                        entryContent.append(result);

                        var closeButton = $('<a href="#" class="close-article">close x</a>').on('click', function(ev) {
                            ev.preventDefault();
                            entryContent.hide();
                        });

                        entryContent.append(closeButton).show();

                        mainEntryContent.data('id', id_post).html($this.parents('article').html()).show();

                        scrollToElementHeader($this);
                    },
                    error: function () {
                        alert("error");
                    }
                });
            } else {
                entryContent.show();
                mainEntryContent.html($this.parents('article').html()).show();
                scrollToElementHeader($this);
            }
        });
    } (jQuery) );
</script>
<?php
get_sidebar();
get_footer();
