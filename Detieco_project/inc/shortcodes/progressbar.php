<?php
/**
 * Progressbar
 *
 */
if ( ! function_exists( 'shortcode_progressbar' ) ) {

	function shortcode_progressbar( $atts, $content = null, $shortcodename = '' ) {
		extract( shortcode_atts(
			array(
				'value'        => '50',
				'type'         => '',
				'grad_type'    => '',
				'animated'     => '',
				'custom_class' => ''
		), $atts ) );

		// check what type user selected
		switch ( $type ) {
			case 'info':
				$bar_type = 'progress-info';
				break;
			case 'success':
				$bar_type = 'progress-success';
				break;
			case 'warning':
				$bar_type = 'progress-warning';
				break;
			case 'danger':
				$bar_type = 'progress-danger';
				break;
		}

		// check what gradient type user selected
		switch ( $grad_type ) {
			case 'vertical':
				$g_type = '';
				break;
			case 'striped':
				$g_type = 'progress-striped';
				break;
		}

		// animated: yes or no
		switch ( $animated ) {
			case 'no':
				$bar_animated = '';
				break;
			case 'yes':
				$bar_animated = 'active';
				break;
		}

		$output = '<div class="progress ' . sanitize_html_class( $bar_type ) . ' ' . sanitize_html_class( $bar_animated ) . ' ' . sanitize_html_class( $g_type ) . ' ' . esc_attr( $custom_class ) . '">';
		$output .= '<div class="bar" style="width: ' . esc_attr( $value ) . '%;"></div>';
		$output .= '</div><!-- .progressbar (end) -->';

		$output = apply_filters( 'theme_shortcode_output', $output, $atts, $shortcodename );

		return $output;

	}
	add_shortcode( 'progressbar', 'shortcode_progressbar' );

}?>