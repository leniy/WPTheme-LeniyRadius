<?php
/**
 * Leniy Radius functions and definitions
 *
 * @package Leniy Radius
 */

if ( ! isset( $content_width ) ) {
	$content_width = 640; /* pixels */
}

if ( ! function_exists( 'leniyradius_setup' ) ) :
function leniyradius_setup() {

	load_theme_textdomain( 'leniyradius', get_template_directory() . '/languages' );

	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'post-thumbnails' );

	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'leniyradius' ),
	) );

	//add_theme_support( 'post-formats', array( 'aside', 'image', 'video', 'quote', 'link' ) );

	add_theme_support( 'custom-background', apply_filters( 'leniyradius_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => get_template_directory_uri() .'/images/default_bg.png',
	) ) );
}
endif; // leniyradius_setup
add_action( 'after_setup_theme', 'leniyradius_setup' );

function leniyradius_widgets_init() {
	$args1 = array(
		'id'            => 'leniyradius_sidebarupper',
		'name'          => __( 'Leniy Radius sidebar upper', 'leniyradius' ),
		'description'   => __( 'Leniy Radius sidebar upper', 'leniyradius' ),
		'class'         => 'leniyradius_sidebar',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
	);
	$args2 = array(
		'id'            => 'leniyradius_sidebarlower',
		'name'          => __( 'Leniy Radius sidebar lower', 'leniyradius' ),
		'description'   => __( 'Leniy Radius sidebar lower, can auto float', 'leniyradius' ),
		'class'         => 'leniyradius_sidebar',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
	);
	register_sidebar( $args1 );
	register_sidebar( $args2 );
}
add_action( 'widgets_init', 'leniyradius_widgets_init' );

function leniyradius_scripts() {

	//be placed in <head>

	wp_enqueue_style( 'leniyradius-style' , get_stylesheet_uri() );
	wp_enqueue_style( 'genericons'        , get_template_directory_uri() . '/genericons/genericons.css' );

	wp_enqueue_script( 'js1' , get_template_directory_uri() . '/js/prefixfree.min.js',         array( 'jquery' ), false, false);
	wp_enqueue_script( 'js2' , get_template_directory_uri() . '/js/jquery.backstretch.min.js', array( 'jquery' ), false, false);
	wp_enqueue_script( 'js3' , get_template_directory_uri() . '/js/sidebar-follow-jquery.js',  array( 'jquery' ), false, false);
	wp_enqueue_script( 'js4' , get_template_directory_uri() . '/js/jquery.gotop.js',           array( 'jquery' ), false, false);

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	//be placed before the </body> end tag

	wp_enqueue_script( 'leniyradius-navigation',          get_template_directory_uri() . '/js/navigation.js',          array(), '20120206', true );
	wp_enqueue_script( 'leniyradius-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );
	wp_enqueue_script( 'js99',                            get_template_directory_uri() . '/js/functions.js' ,    array( 'jquery','js1','js2','js3','js4'), '20131225', true );
}
add_action( 'wp_enqueue_scripts', 'leniyradius_scripts' );

require get_template_directory() . '/inc/custom-header.php';

require get_template_directory() . '/inc/template-tags.php';

require get_template_directory() . '/inc/extras.php';

require get_template_directory() . '/inc/customizer.php';
