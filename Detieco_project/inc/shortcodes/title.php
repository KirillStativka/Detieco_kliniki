<?php
// Title Box
if ( ! function_exists( 'title_shortcode' ) ) {
	function title_shortcode( $atts, $content = null, $shortcodename = '' ) {
		extract( shortcode_atts(
			array(
				'title'        => '',
				'subtitle'     => '',
				'custom_class' => ''
			), $atts ) );
  
		// get site URL
		$home_url = home_url();
  
		$output =  '<div class="title-box clearfix ' . esc_attr( $custom_class ) . '">';
  
		$output .= '<h2 class="title-box_primary">';
		$output .= esc_html( $title );
		$output .= '</h2>';
  
		if ( $subtitle != "" ) {
			$output .= '<h3 class="title-box_secondary">';
			$output .= esc_html( $subtitle );
			$output .= '</h3>';
		}
  
		$output .= '</div><!-- //.title-box -->';
  
		$output = apply_filters( 'theme_shortcode_output', $output, $atts, $shortcodename );
  
		return $output;
	}
	add_shortcode( 'title_box', 'title_shortcode' );
}