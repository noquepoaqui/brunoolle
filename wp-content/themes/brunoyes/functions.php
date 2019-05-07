<?php
/**
 * brunoyes functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package brunoyes
 */

/**
 * Enable ACF 5 early access
 * Requires at least version ACF 4.4.12 to work
 */
// define('ACF_EARLY_ACCESS', '5');

if ( ! function_exists( 'brunoyes_setup' ) ) :
    /**
     * Sets up theme defaults and registers support for various WordPress features.
     *
     * Note that this function is hooked into the after_setup_theme hook, which
     * runs before the init hook. The init hook is too late for some features, such
     * as indicating support for post thumbnails.
     */
    function brunoyes_setup() {
        /*
         * Make theme available for translation.
         * Translations can be filed in the /languages/ directory.
         * If you're building a theme based on brunoyes, use a find and replace
         * to change 'brunoyes' to the name of your theme in all the template files.
         */
        load_theme_textdomain( 'brunoyes', get_template_directory() . '/languages' );

        // Add default posts and comments RSS feed links to head.
        add_theme_support( 'automatic-feed-links' );

        /*
         * Let WordPress manage the document title.
         * By adding theme support, we declare that this theme does not use a
         * hard-coded <title> tag in the document head, and expect WordPress to
         * provide it for us.
         */
        add_theme_support( 'title-tag' );

        /*
         * Enable support for Post Thumbnails on posts and pages.
         *
         * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
         */
        add_theme_support( 'post-thumbnails' );

        // This theme uses wp_nav_menu() in one location.
        register_nav_menus( array(
            'menu-1' => esc_html__( 'Primary', 'brunoyes' ),
        ) );

        /*
         * Switch default core markup for search form, comment form, and comments
         * to output valid HTML5.
         */
        add_theme_support( 'html5', array(
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
        ) );

        // Set up the WordPress core custom background feature.
        add_theme_support( 'custom-background', apply_filters( 'brunoyes_custom_background_args', array(
            'default-color' => 'ffffff',
            'default-image' => '',
        ) ) );

        // Add theme support for selective refresh for widgets.
        add_theme_support( 'customize-selective-refresh-widgets' );

        /**
         * Add support for core custom logo.
         *
         * @link https://codex.wordpress.org/Theme_Logo
         */
        add_theme_support( 'custom-logo', array(
            'height'      => 250,
            'width'       => 250,
            'flex-width'  => true,
            'flex-height' => true,
        ) );
    }
endif;
add_action( 'after_setup_theme', 'brunoyes_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function brunoyes_content_width() {
    // This variable is intended to be overruled from themes.
    // Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
    // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
    $GLOBALS['content_width'] = apply_filters( 'brunoyes_content_width', 640 );
}
add_action( 'after_setup_theme', 'brunoyes_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function brunoyes_widgets_init() {
    register_sidebar( array(
        'name'          => esc_html__( 'Sidebar', 'brunoyes' ),
        'id'            => 'sidebar-1',
        'description'   => esc_html__( 'Add widgets here.', 'brunoyes' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ) );
}
add_action( 'widgets_init', 'brunoyes_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function brunoyes_scripts() {
    wp_enqueue_style( 'brunoyes-style', get_stylesheet_uri() );
    wp_enqueue_script( 'jquery' );
    wp_enqueue_script( 'brunoyes-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );

    wp_enqueue_script( 'brunoyes-flexslider', get_template_directory_uri() . '/js/flexslider.js', array(), '20151215', true );

    wp_enqueue_script( 'brunoyes-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }
}
add_action( 'wp_enqueue_scripts', 'brunoyes_scripts' );

/**
 * Ajax function calls
 */
require get_template_directory() . '/inc/ajax-functions.php';

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
    require get_template_directory() . '/inc/jetpack.php';
}

function brunoyes_embed_wrapper($cache) {
    return '<div class="video-container">'.$cache.'</div>';
}
add_filter( 'embed_oembed_html', 'brunoyes_embed_wrapper' );

if ( ! function_exists( 'toplevel_admin_menu_pages' ) ) {
    function toplevel_admin_menu_pages(){
        if ( !current_user_can('administrator') ) {  // If the user is not the administrator remove and add new menus
            remove_menu_page( 'edit.php' );                   //Posts
            remove_menu_page( 'edit.php?post_type=about' );   //About
            remove_menu_page( 'edit.php?post_type=page' );    //Page
            remove_menu_page( 'edit-comments.php' );          //Comments
            remove_menu_page( 'options-general.php' );        //Settings
            remove_menu_page( 'tools.php' );                  //Tools
        }
        add_menu_page( 'Home', 'Home', 'edit_posts', 'post.php?post=2&action=edit', '', 'dashicons-admin-home', 4 );
        add_menu_page( 'About', 'About', 'edit_posts', 'post.php?post=146&action=edit', '', 'dashicons-editor-help', 8 );
        add_menu_page( 'Contact', 'Contact', 'edit_posts', 'post.php?post=26&action=edit', '', 'dashicons-email', 9 );
    }
    add_action( 'admin_menu', 'toplevel_admin_menu_pages' );
}

add_filter('jpeg_quality', function($arg){return 100;});
