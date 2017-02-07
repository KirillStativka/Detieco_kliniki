<?php
// Blockquote
if ( ! function_exists( 'blockquote_shortcode' ) ) {
	function blockquote_shortcode( $atts, $content = null, $shortcodename = '' ) {
		$output = '<blockquote>';
		$output .= do_shortcode( $content );
		$output .= '</blockquote><!-- blockquote (end) -->';

		$output = apply_filters( 'theme_shortcode_output', $output, $atts, $shortcodename );

		return $output;
	}
	add_shortcode( 'blockquote', 'blockquote_shortcode' );
}