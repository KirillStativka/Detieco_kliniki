<?php
// Address
if ( ! function_exists( 'address_shortcode' ) ) {
	function address_shortcode( $atts, $content = null, $shortcodename = '' ) {
		$output = '<address>';
		$output .= do_shortcode( $content );
		$output .= '</address><!-- address (end) -->';

		$output = apply_filters( 'theme_shortcode_output', $output, $atts, $shortcodename );

		return $output;
	}
	add_shortcode( 'address', 'address_shortcode' );
}