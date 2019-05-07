<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package brunoyes
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">

    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page-wrapper" class="page-wrapper">
<div id="page" class="site">
    <a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'brunoyes' ); ?></a>

    <header id="masthead" class="site-header">
        <div class="site-branding">
            <?php
            the_custom_logo();
            if ( is_front_page() && is_home() ) :
                ?>
                <h1 class="site-title gt-walsheim-14-bold"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
                <?php
            else :
                ?>
                <p class="site-title gt-walsheim-14-bold"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
                <?php
            endif;
            $brunoyes_description = get_bloginfo( 'description', 'display' );
            if ( $brunoyes_description || is_customize_preview() ) :
                ?>
                <p class="site-description"><?php echo $brunoyes_description; /* WPCS: xss ok. */ ?></p>
            <?php endif; ?>
        </div><!-- .site-branding -->

        <nav id="site-navigation" class="main-navigation">
            <button class="menu-toggle" aria-controls="menu-container" aria-expanded="false">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 23.5 18">
                    <defs>
                        <style>
                            .cls-1 {
                                stroke-width: 2px;
                            }
                        </style>
                    </defs>
                    <g id="Symbol_1_1" data-name="Symbol 1 – 1" transform="translate(-331 -26)">
                        <line id="Line_117" data-name="Line 117" class="cls-1 global-stroke" x2="23.5" transform="translate(331 27)"/>
                        <line id="Line_118" data-name="Line 118" class="cls-1 global-stroke" x2="23.5" transform="translate(331 35)"/>
                        <line id="Line_119" data-name="Line 119" class="cls-1 global-stroke" x2="23.5" transform="translate(331 43)"/>
                    </g>
                </svg>
            </button>
            <div class="menu-container" id="menu-container">
                <button class="close-btn" aria-controls="menu-container">
                    <svg class="close-btn-svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 7.309 7.224">
                        <g id="Symbol_2_1" data-name="Symbol 2 – 1" transform="translate(-309.042 -89.931)">
                            <line id="Line_157" data-name="Line 157" class="global-stroke" x2="6.607" y2="6.511" transform="translate(309.393 90.287)"/>
                            <line id="Line_158" data-name="Line 158" class="global-stroke" x1="6.607" y2="6.511" transform="translate(309.393 90.287)"/>
                        </g>
                    </svg>
                </button>
                <?php
                wp_nav_menu( array(
                    'theme_location' => 'menu-1',
                    'menu_id'        => 'primary-menu',
                    'container'      => '',
                ) );
                ?>
            </div>
        </nav><!-- #site-navigation -->
    </header><!-- #masthead -->

    <div id="content" class="site-content">
