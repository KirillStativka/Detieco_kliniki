<?php
/**
 * Service Box
 *
 */
if ( ! function_exists( 'service_box_shortcode' ) ) {

	function service_box_shortcode( $atts, $content = null, $shortcodename = '' ) {
		extract( shortcode_atts(
			array(
				'title'        => '',
				'subtitle'     => '',
				'icon'         => '',
				'text'         => '',
				'btn_text'     => __('Read more', 'base'),
				'btn_link'     => '',
				'btn_size'     => '',
				'target'       => '',
				'custom_class' => ''
		), $atts ) );

		$output =  '<div class="service-box ' . esc_attr( $custom_class ) . '">';

		if($icon != 'no'){
			$output .= '<div class="icon"><img src="' . esc_url( $icon_url ) . '" alt="" /></div>';
		}

		$output .= '<div class="service-box_body">';

		if ( $title != "" ) {
			$output .= '<h2 class="title">';
			$output .= $title;
			$output .= '</h2>';
		}
		if ( $subtitle != "" ) {
			$output .= '<h5 class="sub-title">';
			$output .= $subtitle;
			$output .= '</h5>';
		}
		if ( $text != "" ) {
			$output .= '<div class="service-box_txt">';
			$output .= $text;
			$output .= '</div>';
		}
		if ( $btn_link != "" ) {
			$output .=  '<div class="btn-align"><a href="' . esc_url( $btn_link ) . '" title="' . esc_attr( $btn_text ) . '" class="btn btn-inverse btn-' . esc_attr( $btn_size ) . ' btn-primary " target="' . esc_attr( $target ) . '">';
			$output .= $btn_text;
			$output .= '</a></div>';
		}
		$output .= '</div>';
		$output .= '</div><!-- /Service Box -->';

		$output = apply_filters( 'theme_shortcode_output', $output, $atts, $shortcodename );

		return $output;
	}
	add_shortcode('service_box', 'service_box_shortcode');

}?>