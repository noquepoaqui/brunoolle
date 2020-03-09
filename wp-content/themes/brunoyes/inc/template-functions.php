<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package brunoyes
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function brunoyes_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Adds a class of no-sidebar when there is no sidebar present.
	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'no-sidebar';
	}

	return $classes;
}
add_filter( 'body_class', 'brunoyes_body_classes' );

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function brunoyes_pingback_header() {
	if ( is_singular() && pings_open() ) {
		echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
	}
}
add_action( 'wp_head', 'brunoyes_pingback_header' );

function brunoyes_mime_types($mimes) {
  $mimes['svg'] = 'image/svg+xml';
  return $mimes;
}
add_filter('upload_mimes', 'brunoyes_mime_types');

// Customize the format dropdown items
function base_custom_mce_format($init) {
    $style_formats = array(
        array(
            'title' => 'GT Walsheim 14',
            'items' => array(
                array(
                    'title' => 'GT Walsheim 14 light',
                    'block' => 'p',
                    'classes' => 'gt-walsheim-14-light',
                    'wrap' => true,
                ),
                array(
                    'title' => 'GT Walsheim 14 regular',
                    'block' => 'p',
                    'classes' => 'gt-walsheim-14-regular',
                    'wrap' => true,
                ),
                array(
                    'title' => 'GT Walsheim 14 bold',
                    'block' => 'p',
                    'classes' => 'gt-walsheim-14-bold',
                    'wrap' => true,
                ),
            ),
        ),

        array(
            'title' => 'GT Walsheim 24',
            'items' => array(
                array(
                    'title' => 'GT Walsheim 24 light',
                    'block' => 'p',
                    'classes' => 'gt-walsheim-24-light',
                    'wrap' => true,
                ),
                array(
                    'title' => 'GT Walsheim 24 regular',
                    'block' => 'p',
                    'classes' => 'gt-walsheim-24-regular',
                    'wrap' => true,
                ),
                array(
                    'title' => 'GT Walsheim 24 bold',
                    'block' => 'p',
                    'classes' => 'gt-walsheim-24-bold',
                    'wrap' => true,
                ),
            ),
        ),

        array(
            'title' => 'Minion Pro 16',
            'items' => array(
                array(
                    'title' => 'Minion Pro 16 regular',
                    'block' => 'p',
                    'classes' => 'minion-pro-16-regular',
                    'wrap' => true,
                ),
                array(
                    'title' => 'Minion Pro 16 bold',
                    'block' => 'p',
                    'classes' => 'minion-pro-16-bold',
                    'wrap' => true,
                ),
            ),
        ),

        array(
            'title' => 'Minion Pro 22',
            'items' => array(
                array(
                    'title' => 'Minion Pro 22 regular',
                    'block' => 'p',
                    'classes' => 'minion-pro-22-regular',
                    'wrap' => true,
                ),
                array(
                    'title' => 'Minion Pro 22 bold',
                    'block' => 'p',
                    'classes' => 'minion-pro-22-bold',
                    'wrap' => true,
                ),
            ),
        ),
    );
    $init['style_formats'] = json_encode( $style_formats );

    // Add block format elements you want to show in dropdown
    $init['theme_advanced_blockformats'] = 'p,h2,h3,h4,h5,h6,pre';
    $init['theme_advanced_text_colors'] = '0f3156,636466,0486d3';
    $init['theme_advanced_styles'] = "bigTitle=bigTitle;Call To Action Button=ctaButton,Rounded Corners=rounded";
    // Add elements not included in standard tinyMCE dropdown p,h1,h2,h3,h4,h5,h6
    $init['extended_valid_elements'] = 'code[*]';
    return $init;
}
add_filter('tiny_mce_before_init', 'base_custom_mce_format' );

/**
 * Apply font live show in backend (when creating, editing a post, page)
 */

function ln_admin_editor_fonts($hook) {
    if($hook != 'post.php') {
        return;
    }
    wp_register_style( 'custom_wp_admin_css', get_theme_file_uri( 'css/tinymce.css' ));
    wp_enqueue_style( 'custom_wp_admin_css' );
}
add_action( 'admin_enqueue_scripts', 'ln_admin_editor_fonts' );

// TinyMCE: First line toolbar customizations
if( !function_exists('base_extended_editor_mce_buttons') ){
    function base_extended_editor_mce_buttons($buttons) {
        // The settings are returned in this array. Customize to suite your needs.
        return array(
            'styleselect', 'forecolor', 'italic', 'bold', 'underline', 'alignleft', 'aligncenter', 'alignright', 'bullist', 'numlist', 'link', 'unlink', 'charmap', 'removeformat', 'fullscreen', 'columns', 'wp_more'
        );
        /* WordPress Default
        return array(
            'bold', 'italic', 'strikethrough', 'separator',
            'bullist', 'numlist', 'blockquote', 'separator',
            'justifyleft', 'justifycenter', 'justifyright', 'separator',
            'link', 'unlink', 'wp_more', 'separator',
            'spellchecker', 'fullscreen', 'wp_adv'
        ); */
    }
    add_filter("mce_buttons", "base_extended_editor_mce_buttons", 0);
}

// Adds behavior for columns button
if( !function_exists('brunoyes_add_buttons') ) {
    function brunoyes_add_buttons($plugin_array) {
        $plugin_array['columns'] = get_template_directory_uri().'/js/tinymce_buttons.js';
        return $plugin_array;
    }
}
add_filter( 'mce_external_plugins', 'brunoyes_add_buttons' );

// TinyMCE: Second line toolbar customizations
if( !function_exists('base_extended_editor_mce_buttons_2') ){
    function base_extended_editor_mce_buttons_2($buttons) {
        // The settings are returned in this array. Customize to suite your needs. An empty array is used here because I remove the second row of icons.
        return array();
        /* WordPress Default
        return array(
            'formatselect', 'underline', 'justifyfull', 'forecolor', 'separator',
            'pastetext', 'pasteword', 'removeformat', 'separator',
            'media', 'charmap', 'separator',
            'outdent', 'indent', 'separator',
            'undo', 'redo', 'wp_help'
        ); */
    }
    add_filter("mce_buttons_2", "base_extended_editor_mce_buttons_2", 0);
}

function my_theme_add_editor_styles() {
    add_editor_style( 'style.css' );
}
add_action( 'init', 'my_theme_add_editor_styles' );


function build_gallery_content( $attrs ){

    static $instance = 0;
    $instance++;

    /*
    Limiting what the user can do by
    locking down most short code options.
    */
    extract(shortcode_atts(array(
            'id'         => $post->ID,
            'include'    => '',
            'exclude'    => ''
    ), $attrs));

    $id = intval($id);

    if ( !empty($include) ) {
         $params = array(
                    'include' => $include,
                    'post_status' => 'inherit',
                    'post_type' => 'attachment',
                    'post_mime_type' => 'image',
                    'order' => 'ASC',
                    'orderby' => 'menu_order ID');
            $_attachments = get_posts( $params );
            $attachments = array();
            foreach ( $_attachments as $key => $val ) {
                    $attachments[$val->ID] = $_attachments[$key];
            }
    } elseif ( !empty($exclude) ) {
            $params = array(
                    'post_parent' => $id,
                    'exclude' => $exclude,
                    'post_status' => 'inherit',
                    'post_type' => 'attachment',
                    'post_mime_type' => 'image',
                    'order' => 'ASC',
                    'orderby' => 'menu_order ID');
            $attachments = get_children( $params );
    } else {
            $params = array(
                    'post_parent' => $id,
                    'post_status' => 'inherit',
                    'post_type' => 'attachment',
                    'post_mime_type' => 'image',
                    'order' => 'ASC',
                    'orderby' => 'menu_order ID');
            $attachments = get_children( $params );
    }

    if ( empty($attachments) )
            return '';

    $selector = "gallery-{$instance}";

    $gallery_div = sprintf("<div class='flexslider'><ul id='%s' class='slides gallery galleryid-%d gallery-columns-1 gallery-size-full'>", $selector, $id);
    $output = $gallery_div;


    foreach ( $attachments as $id => $attachment ) {
        /*
        Use wp_get_attachment_link to return a photo + link
        to attachment page or image
        http://codex.wordpress.org/Function_Reference/wp_get_attachment_link
        */
        $img = wp_get_attachment_image( $id, 'full', false);

        $caption = '';

        /*
        Set the caption string if there is one.
        */

        if( $captiontag && trim($attachment->post_excerpt) ){
            $caption = sprintf("\n\t<figcaption class='wp-caption-text gallery-caption'>\n\t<div>\n%s\n\t</div>\n\t</figcaption>", wptexturize($attachment->post_excerpt));
        }

        /*
        Set the output for each slide.
        */
        $output .= sprintf("<li class='gallery-item'><figure class='gallery-icon'>%s\n\t%s</figure></li>", $img, $caption);
    }
    $output .= '</ul></div>';
    return $output;
}

function custom_gallery_shortcode( $output = '', $attrs){
    $return = $output;

    # Gallery function that returns new markup.
    $gallery = build_gallery_content( $attrs );


    if( !empty( $gallery ) ) {
        $return = $gallery;
    }

    return $return;
}

add_filter( 'post_gallery', 'custom_gallery_shortcode', 10, 2);

// Removes auto p filter
remove_filter('the_content', 'wpautop');
remove_filter('acf_the_content', 'wpautop');


/**
 * Set sizes atribute for responsive images and better performance
 * @param  array        $attr       markup attributes
 * @param  object       $attachment WP_Post image attachment post
 * @param  string|array $size       named image size or array
 * @return array        markup attributes
 */
function brunoyes_resp_img_sizes( $attr, $attachment, $size ) {
    if ( is_array( $size ) ) {
        $attr['sizes'] = $size[0] . 'px';
    } elseif ( $size == 'post-thumbnail') {
        $attr['sizes'] = '(max-width: 768px) calc(100vw - 40px), (max-width: 1024px) calc(50vw - 80px), (max-width: 1280px) calc((100vw / 3) - 113px), calc(1280px / 3)';
    } elseif ( $size == 'size-full') {
        $attr['sizes'] = '(max-width: 768px) calc(100vw-40px), (max-width: 1024px) 768px, (max-width: 1280px) 1000px, 1280px';
    }

    return $attr;
}
add_filter( 'wp_get_attachment_image_attributes', 'brunoyes_resp_img_sizes', 25, 3 );

function brunoyes_resp_img_sizes_2($sizes = null, $size, $image_src, $image_meta= null, $attachment_id= null) {
    if ($size[0] = 1280) {
        return '(max-width: 768px) calc(100vw - 40px), (max-width: 1024px) 768px, (max-width: 1280px) 1000px, 1280px';
    }
    else {
        return $sizes;
    }
}

add_filter( 'wp_calculate_image_sizes', 'brunoyes_resp_img_sizes_2', 25, 3);



/**
 * Takes a string and modifies any <img> tags within it by:
 * - Adding the class 'lazy'
 * - Removing the 'src' attribute
 * - Adding the 'data-original' attribute using the original 'src' value
 *
 * @param $content
 * @return string
 */
function brunoyes_lazyload_modify_img_tags( $content ) {

  $content = mb_convert_encoding($content, 'HTML-ENTITIES', "UTF-8");

  // Get out if we don't have any content
  if ( empty($content) )
    return $content;

  $document = new DOMDocument();
  libxml_use_internal_errors(true);
  $document->loadHTML(utf8_decode($content), LIBXML_HTML_NODEFDTD);

  // Grab all image tags
  $imgs = $document->getElementsByTagName('img');
  $imgsToRemove = [];
  // Loop through all image tags
  foreach ($imgs as $img) {
    $span = $document->createElement('span');
    $span->setAttribute('class', 'image_preload');
    $Image = new DOMDocument();
    $Image->appendChild($Image->importNode($img, true));
    $span->setAttribute('data-image', base64_encode($Image->saveHTML()));

    $span->setAttribute('class', 'image_preload');

    $back = $document->createElement('span');
    $back->setAttribute('class', 'back');

    $dummy = $document->createElement('span');
    $height = $img->getAttribute('height');
    $width = $img->getAttribute('width');
    $dummy->setAttribute('style', 'padding-bottom: ' . $height * 100 / $width . '%; background-color: #f6f6f6;');

    $span->appendChild($back);
    $span->appendChild($dummy);

    $img->parentNode->insertBefore($span, $img);
    $imgsToRemove[] = $img;
  }

  foreach ($imgsToRemove as $img) {
    $img->parentNode->removeChild($img);
  }

  $html = $document->saveHTML();

  $html = str_replace('<html><body>', '', $html);
  $html = str_replace('</body></html>', '', $html);

  return $html;
}
add_filter( 'acf_the_content', 'brunoyes_lazyload_modify_img_tags', 200 );
add_filter( 'the_content', 'brunoyes_lazyload_modify_img_tags', 200 );
