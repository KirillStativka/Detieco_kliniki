<?php
// Button
if ( ! function_exists( 'button_shortcode' ) ) {
	function button_shortcode( $atts, $content = null, $shortcodename = '' ) {
		extract( shortcode_atts(
			array(
				'link'    => 'http://www.google.com',
				'text'    => __( 'Read more', 'base' ),
				'target'  => '_self',
				'class'   => '',
		), $atts) );

        $output =  '<a href="' . $link . '" title="' . esc_attr( $text ) . '" class="btn ' . sanitize_html_class( $class ) . '" target="' . esc_attr( $target ) . '">';
        $output .= esc_attr( $text );
        $output .= '</a><!-- .btn -->';

		$output = apply_filters( 'theme_shortcode_output', $output, $atts, $shortcodename );

		return $output;
	}
	add_shortcode( 'button', 'button_shortcode' );
}