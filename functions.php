<?php
/**
 * _t functions and definitions
 *
 * @package _t
 */
 
/* * * * * * * * * * * * * * * * * *
 * ORIGINAL
 * * * * * * * * * * * * * * * * * */
require_once("countrylist.php");

function getImagePath($filename){

	$path = get_template_directory_uri();
	$path .= "/media/";
	
	if( ua_smartphone() ){
		$path .= "sp/";
	}
	else{
		$path .= "pc/";
	}
	
	$path .= $filename;
	
	return $path;
}
function ua_smartphone(){
	//ユーザーエージェントを取得
	$ua = $_SERVER['HTTP_USER_AGENT'];
	//スマホと判定する文字リスト
	$ua_list = array('iPhone','Android');
	 foreach ($ua_list as $ua_smt) {
	//ユーザーエージェントに文字リストの単語を含む場合はTRUE、それ以外はFALSE
		if (strpos($ua, $ua_smt) !== false) {
		 return true;
		}
	 } return false;
}


/* * * * * * * * * * * * * * * * * *
 * Theme Default
 * * * * * * * * * * * * * * * * * */
if ( ! defined( '_T_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_T_VERSION', '1.0.0' );
}

if ( ! function_exists( '_t_setup' ) ) :
	function _t_setup() {
		load_theme_textdomain( '_t', get_template_directory() . '/languages' );
		add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'title-tag' );
		add_theme_support( 'post-thumbnails' );
		register_nav_menus(
			array(
				'menu-1' => esc_html__( 'Primary', '_t' ),
			)
		);
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
			)
		);
		add_theme_support(
			'custom-background',
			apply_filters(
				'_s_custom_background_args',
				array(
					'default-color' => 'ffffff',
					'default-image' => '',
				)
			)
		);
		add_theme_support( 'customize-selective-refresh-widgets' );
		add_theme_support(
			'custom-logo',
			array(
				'height'      => 250,
				'width'       => 250,
				'flex-width'  => true,
				'flex-height' => true,
			)
		);
	}
endif;
add_action( 'after_setup_theme', '_t_setup' );

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

/**
 * Load WooCommerce compatibility file.
 */
if ( class_exists( 'WooCommerce' ) ) {
	require get_template_directory() . '/inc/woocommerce.php';
}
