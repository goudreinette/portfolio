<?php
/* De-register Contact Form 7 styles */
add_filter( 'wpcf7_load_js', '__return_false' );
add_filter( 'wpcf7_load_css', '__return_false' );

// Main Styles
function thb_main_styles() {	
	global $post;
	$thb_theme = wp_get_theme();
	// Enqueue
	wp_enqueue_style("thb-fa", THB_THEME_ROOT .  '/assets/css/font-awesome.min.css', null, null);
	wp_enqueue_style("thb-app", THB_THEME_ROOT .  "/assets/css/app.css", null, esc_attr($thb_theme->get( 'Version' )));
	
	if ( $_SERVER['HTTP_HOST'] !== 'werkstatt.fuelthemes.net') {
		wp_enqueue_style('thb-style', get_stylesheet_uri(), null, null);	
	}
	wp_enqueue_style( 'thb-google-fonts', thb_google_webfont(), array(), null );
	wp_add_inline_style( 'thb-app', thb_selection() );
	
	if ( $post ) {
		if ( has_shortcode($post->post_content, 'contact-form-7') && function_exists( 'wpcf7_enqueue_styles' ) ) {
			wpcf7_enqueue_styles();
		}
	}
}
add_action('wp_enqueue_scripts', 'thb_main_styles');

// Main Scripts
function thb_register_js() {
	if (!is_admin()) {
		global $post;
		$thb_theme = wp_get_theme();
		$thb_api_key = ot_get_option('map_api_key');
		
		// Register 
		wp_enqueue_script('thb-vendor', THB_THEME_ROOT . '/assets/js/vendor.min.js', array('jquery'), esc_attr($thb_theme->get( 'Version' )), TRUE);
		wp_enqueue_script('thb-app', THB_THEME_ROOT . '/assets/js/app.min.js', array('jquery', 'thb-vendor'), esc_attr($thb_theme->get( 'Version' )), TRUE);
		
		if ( is_singular() AND comments_open() AND (get_option('thread_comments') == 1) ) {
			wp_enqueue_script('comment-reply');
		}
		
		if ( $post ) {
			if ( has_shortcode($post->post_content, 'thb_map_parent') ) {
				wp_enqueue_script('gmapdep', 'https://maps.google.com/maps/api/js?key='.esc_attr($thb_api_key).'', false, null, false);
			}
			
			if ( has_shortcode($post->post_content, 'contact-form-7') && function_exists( 'wpcf7_enqueue_scripts' ) ) {
				wpcf7_enqueue_scripts();
			}
		}
		// Typekit 
		if ($typekit_id = ot_get_option('typekit_id')) {
			wp_enqueue_script('thb-typekit', 'https://use.typekit.net/'.$typekit_id.'.js', array(), NULL, FALSE );
			wp_add_inline_script( 'thb-typekit', 'try{Typekit.load({ async: true });}catch(e){}' );
		}
		
		wp_localize_script( 'thb-app', 'themeajax', array( 
			'url' => admin_url( 'admin-ajax.php' ),
			'l10n' => array (
				'loading' => esc_html__("Loading ...", 'werkstatt'),
				'nomore' => esc_html__("No More Posts", 'werkstatt'),
				'added' => esc_html__("Added To Cart", 'werkstatt'),
				'added_svg' => thb_load_template_part('assets/svg/arrows_check.svg')
			),
			'sounds' => array (
				'music_sound' => ot_get_option('music_sound', 'off'),
				'music_sound_toggle_home' => ot_get_option('music_sound_toggle_home', 'off'),
				'music_sound_file' => ot_get_option('music_sound_file', THB_THEME_ROOT .  '/assets/sounds/music_sound.mp3'),
				'menu_item_hover_sound' => ot_get_option('menu_item_hover_sound', 'off'),
				'menu_item_hover_sound_file' => ot_get_option('menu_item_hover_sound_file', THB_THEME_ROOT .  '/assets/sounds/hover.mp3'),
				'menu_open_sound' => ot_get_option('menu_open_sound', 'off'),
				'menu_open_sound_file' => ot_get_option('menu_open_file', THB_THEME_ROOT .  '/assets/sounds/open.mp3'),
				'menu_close_sound' => ot_get_option('menu_close_sound', 'off'),
				'menu_close_sound_file' => ot_get_option('menu_close_sound_file', THB_THEME_ROOT .  '/assets/sounds/close.mp3'),
				'click_sound' => ot_get_option('click_sound', 'off'),
				'click_sound_file' => ot_get_option('click_file', THB_THEME_ROOT .  '/assets/sounds/click.mp3'),
			)
		) );
	}
}
add_action('wp_enqueue_scripts', 'thb_register_js');

// Admin Scripts
function thb_admin_scripts() {
	wp_enqueue_script('thb-admin-meta', THB_THEME_ROOT .'/assets/js/admin-meta.min.js', array('jquery'));
	
	wp_enqueue_style("thb-admin-css", THB_THEME_ROOT . "/assets/css/admin.css");
 
	if (class_exists('WPBakeryVisualComposerAbstract')) {
		wp_enqueue_style( 'vc_extra_css', THB_THEME_ROOT . '/assets/css/vc_extra.css' );
	}
}
add_action('admin_enqueue_scripts', 'thb_admin_scripts');

/* WooCommerce */
add_filter( 'woocommerce_enqueue_styles', '__return_false' );
/* WooCommerce */
if(class_exists('woocommerce')) {
	function thb_woocommerce_scripts() {
		wp_dequeue_script( 'prettyPhoto' );
		wp_dequeue_script( 'prettyPhoto-init' );
	}
	add_action('wp_enqueue_scripts', 'thb_woocommerce_scripts');
}