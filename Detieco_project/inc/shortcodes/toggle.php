<?php
/**
 * Toggle
 *
 */
global $my_accordion_shortcode_count, $my_global_var;

$my_accordion_shortcode_count = 0;
$my_global_var = rand();

if ( ! function_exists( 'shortcode_accordion' ) ) {
	function shortcode_accordion( $atts, $content = null, $shortcodename = '' ) {
		global $my_global_var, $post, $my_accordion_shortcode_count;
		
		extract( shortcode_atts( array(
			'title' => null,
			'class' => null,
			'visible' => null
		), $atts ) );

		$toggleid = rand();

		if ( $visible != '' ) {
			$inClass 	 = 'in';
			$activeClass = 'active';
		} else {
			$inClass 	 = '';
			$activeClass = '';
		}

		$output = '<div class="accordion-group">';
		$output .= '<div class="accordion-heading">';
		$output .= '<a class="accordion-toggle ' . esc_attr( $activeClass ) . '" data-toggle="collapse" data-parent="#id-' . esc_attr( $my_global_var ) . '" href="#' . esc_attr( $toggleid ) . '">' . esc_html( $title ) . '</a>';
		$output .= '</div>';
		$output .= '<div class="accordion-body collapse ' . esc_attr( $inClass ) . '" id="' . esc_attr( $toggleid ) . '">';
		$output .= '<div class="accordion-inner">';
		$output .= do_shortcode( $content );
		$output .= '</div>';
		$output .= '</div>';
		$output .= '</div>';

		$my_accordion_shortcode_count++;

		$output = apply_filters( 'theme_shortcode_output', $output, $atts, $shortcodename );

		return $output;
	}
	add_shortcode( 'accordion', 'shortcode_accordion' ); // Single accordion
}

if ( ! function_exists( 'shortcode_accordions' ) ) {
	function shortcode_accordions( $atts, $content = null, $shortcodename = '' ){
		// wordpress function
		global $my_accordion_shortcode_count, $post, $my_global_var;

		$output = '<div id="id-' . esc_attr( $my_global_var ) . '" class="accordion">';
		$output .= do_shortcode( $content );
		$output .= '</div>';

		$my_global_var ++;
		$output = str_replace( "\r\n", '', $output );

		$output = apply_filters( 'theme_shortcode_output', $output, $atts, $shortcodename );

		return $output;
	}
	add_shortcode( 'accordions', 'shortcode_accordions' ); // Accordion Wrapper
}
?>