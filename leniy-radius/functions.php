<?php
/**
 * Leniy Radius functions and definitions
 *
 * @package Leniy Radius
 */

if ( ! isset( $content_width ) ) {
	$content_width = 640; /* pixels */
}

add_theme_support( "title-tag" );

if ( ! function_exists( 'leniyradius_setup' ) ) :
function leniyradius_setup() {

	load_theme_textdomain( 'leniyradius', get_template_directory() . '/languages' );

	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'post-thumbnails' );
	add_editor_style();

	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'leniyradius' ),
	) );

	//add_theme_support( 'post-formats', array( 'aside', 'image', 'video', 'quote', 'link' ) );

	add_theme_support( 'custom-background', apply_filters( 'leniyradius_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => get_template_directory_uri() .'/images/default_bg.jpg',
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
	wp_enqueue_script( 'js3' , get_template_directory_uri() . '/js/sidebar-follow-jquery.js',  array( 'jquery' ), false, false);
	wp_enqueue_script( 'js4' , get_template_directory_uri() . '/js/jquery.gotop.js',           array( 'jquery' ), false, false);

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	//be placed before the </body> end tag

	wp_enqueue_script( 'leniyradius-navigation',          get_template_directory_uri() . '/js/navigation.js',          array(), '20120206', true );
	wp_enqueue_script( 'leniyradius-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );
	wp_enqueue_script( 'js99',                            get_template_directory_uri() . '/js/functions.js' ,    array( 'jquery','js1','js3','js4'), '20131225', true );
}
add_action( 'wp_enqueue_scripts', 'leniyradius_scripts' );

require get_template_directory() . '/inc/custom-header.php';

require get_template_directory() . '/inc/template-tags.php';

require get_template_directory() . '/inc/extras.php';

require get_template_directory() . '/inc/customizer.php';




/* Archives list by zwwooooo | http://zww.me */
function zww_archives_list() {
    if( !$output = get_option('zww_archives_list') ){
        $output = '<div id="zww_archives"><p><a id="al_expand_collapse" href="#">' . __('全部展开/收缩', 'leniyradius') . '</a> <em>' . __('(注: 点击月份可以展开)', 'leniyradius') . '</em></p>';
        $the_query = new WP_Query( 'posts_per_page=-1&ignore_sticky_posts=1' );
        $year=0; $mon=0; $i=0; $j=0;
        while ( $the_query->have_posts() ) : $the_query->the_post();
            $year_tmp = get_the_time('Y');
            $mon_tmp = get_the_time('m');
            $y=$year; $m=$mon;
            if ($mon != $mon_tmp && $mon > 0) $output .= '</ul></li>';
            if ($year != $year_tmp && $year > 0) $output .= '</ul>';
            if ($year != $year_tmp) {
                $year = $year_tmp;
                $output .= '<h3 class="al_year">'. $year .' 年</h3><ul class="al_mon_list">';
            }
            if ($mon != $mon_tmp) {
                $mon = $mon_tmp;
                $output .= '<li><span class="al_mon">'. $mon .' 月</span><ul class="al_post_list">';
            }
            $output .= '<li>'. get_the_time('d日: ') .'<a href="'. get_permalink() .'">'. get_the_title() .'</a> <em>('. get_comments_number('0', '1', '%') .')</em></li>';
        endwhile;
        wp_reset_postdata();
        $output .= '</ul></li></ul></div>';
        update_option('zww_archives_list', $output);
    }
    echo $output;
}
function clear_zal_cache() {
    update_option('zww_archives_list', '');
}
add_action('save_post', 'clear_zal_cache');