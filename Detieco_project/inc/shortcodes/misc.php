<?php
// Template URL
if ( ! function_exists( 'template_url_shortcode' ) ) {
	function template_url_shortcode( $atts, $content = null ) {
		return TEMPLATE_DIRECTORY_URI;
	}
	add_shortcode( 'template-url', 'template_url_shortcode' );
}

// Site URL
if ( ! function_exists( 'site_url_shortcode' ) ) {
	function site_url_shortcode( $atts, $content = null ) {
		return home_url();
	}
	add_shortcode( 'site-url', 'site_url_shortcode' );
}

// Add [email]...[/email] shortcode
if ( ! function_exists( 'email_shortcode' ) ) {
	function email_shortcode( $atts, $content ) {
		return antispambot( $content );
	}
	add_shortcode( 'email', 'email_shortcode' );
}