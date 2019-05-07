<?php
/**
 * brunoyes Theme Customizer
 *
 * @package brunoyes
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function brunoyes_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial( 'blogname', array(
			'selector'        => '.site-title a',
			'render_callback' => 'brunoyes_customize_partial_blogname',
		) );
		$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
			'selector'        => '.site-description',
			'render_callback' => 'brunoyes_customize_partial_blogdescription',
		) );
	}
}
add_action( 'customize_register', 'brunoyes_customize_register' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function brunoyes_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function brunoyes_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function brunoyes_customize_preview_js() {
	wp_enqueue_script( 'brunoyes-customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'brunoyes_customize_preview_js' );

// Add the custom columns to the work post type:
add_filter( 'manage_work_posts_columns', 'set_custom_edit_work_columns' );
function set_custom_edit_work_columns($columns) {
    $columns['thumbnail'] = __( 'Thumbnail', 'thumbnail' );
    return $columns;
}

// Add the data to the custom columns for the work post type:
add_action( 'manage_work_posts_custom_column' , 'custom_work_column', 10, 2 );
function custom_work_column( $column, $post_id ) {
    switch ( $column ) {

        case 'thumbnail' :
            echo the_post_thumbnail( array(75, 75) );
            break;
    }
}

// Add the custom columns to the publications post type:
add_filter( 'manage_publications_posts_columns', 'set_custom_edit_publications_columns' );
function set_custom_edit_publications_columns($columns) {
    $columns['thumbnail'] = __( 'Thumbnail', 'thumbnail' );
    return $columns;
}

// Add the data to the custom columns for the publications post type:
add_action( 'manage_publications_posts_custom_column' , 'custom_publications_column', 10, 2 );
function custom_publications_column( $column, $post_id ) {
    switch ( $column ) {

        case 'thumbnail' :
            echo the_post_thumbnail( array(75, 75) );
            break;
    }
}

