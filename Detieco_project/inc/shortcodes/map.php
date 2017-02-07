<?php
// Map
if ( ! function_exists( 'map_shortcode' ) ) {
	function map_shortcode( $atts, $content = null, $shortcodename = '' ) {
		extract( shortcode_atts(
			array(
				'src'    => '',
				'width'  => '',
				'height' => ''
			), $atts ) );

		$output =  '<div class="google-map">';
			$output .= '<iframe src="' . esc_url( $src ) . '" frameborder="0" width="' . esc_attr( $width ) . '" height="' . esc_attr( $height ) . '" marginwidth="0" marginheight="0" scrolling="no">';
			$output .= '</iframe>';
		$output .= '</div>';

		$output = apply_filters( 'theme_shortcode_output', $output, $atts, $shortcodename );

		return $output;
	}
	add_shortcode( 'map', 'map_shortcode' );
}