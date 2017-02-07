<?php
/**
 * Pricing Tables
 *
 */
if ( ! function_exists( ' chp_pricing_table_shortcode ' ) ) {
	function chp_pricing_table_shortcode( $atts, $content = null, $shortcodename = '' ) {
		extract( shortcode_atts( array(
			'columns'      => '',
			'labelled'     => '',
			'custom_class' => ''
		), $atts ) );

		$output = '<div class="price-plans price-plans-' . esc_attr( $columns ) . ' ' . esc_attr( $custom_class ) . '">' . do_shortcode( $content ) . '</div>';

		$output = apply_filters( 'theme_shortcode_output', $output, $atts, $shortcodename );

		return $output;

	}
	add_shortcode( 'chp_pricing_table', 'chp_pricing_table_shortcode' );
}

if ( ! function_exists( 'chp_pricing_column_shortcode' ) ) {
	function chp_pricing_column_shortcode( $atts, $content = null, $shortcodename = '' ) {
		extract( shortcode_atts( array(
			'title'            => __( 'Column title', 'base' ),
			'highlight'        => 'false',
			'highlight_reason' => '',
			'price'            => "99",
			'currency_symbol'  => '$',
			'interval'         => __( 'Sign Up', 'base' )
		), $atts ) );

		$highlight_class        = null;
		$hightlight_reason_html = null;

		if ( $highlight == 'true' ) {
			$highlight_class        = 'highlight';
			$hightlight_reason_html = '<span class="highlight-reason">' . esc_attr( $highlight_reason ) . '</span>';
		}

		$output = '<div class="plan ' . sanitize_html_class( $highlight_class ) . '">';
		$output .= '<h3>' . esc_html( $title ) . $hightlight_reason_html . '</h3>';
		$output .= '<h4><span class="currency_symbol">' . esc_attr( $currency_symbol ) . '</span>' . esc_attr( $price ) . '<span class="interval">' . esc_html( $interval ) . '</span></h4>';
		$output .= '<div class="plan-container">' . do_shortcode($content) . '</div>';
		$output .= '</div>';

		$output = apply_filters( 'theme_shortcode_output', $output, $atts, $shortcodename );

		return $output;
	}
	add_shortcode( 'chp_pricing_column', 'chp_pricing_column_shortcode' );
}

if ( ! function_exists( 'chp_pricing_row_shortcode' ) ) {
	function chp_pricing_row_shortcode( $atts, $content = null, $shortcodename = '' ) {
		extract( shortcode_atts( array(
			'odd' => ''
		), $atts ) );

		if ( $odd == 'true' ) {
			$odd = ' odd';
		} else {
			$odd = '';
		}

		$output = '<div class="plan-features-row' . $odd . '">' . do_shortcode($content) . '</div>';

		$output = apply_filters( 'theme_shortcode_output', $output, $atts, $shortcodename );

		return $output;
	}
	add_shortcode( 'chp_pricing_row', 'chp_pricing_row_shortcode' );
}

if ( ! function_exists( 'chp_pricing_column_label_shortcode' ) ) {
	function chp_pricing_column_label_shortcode( $atts, $content = null, $shortcodename = '' ) {
		extract( shortcode_atts( array(
			'title' => __( 'Features', 'base' )
		), $atts ) );

		$output = '<div class="plan plan-labelled"><h4>' . esc_html( $title ) . '</h4>' . do_shortcode($content) . '</div>';

		$output = apply_filters( 'theme_shortcode_output', $output, $atts, $shortcodename );

		return $output;
	}
	add_shortcode( 'chp_pricing_column_label', 'chp_pricing_column_label_shortcode' );
}

if ( ! function_exists( 'chp_pricing_row_label_shortcode' ) ) {
	function chp_pricing_row_label_shortcode( $atts, $content = null, $shortcodename = '' ) {
		extract( shortcode_atts( array(
			'odd' => ''
		), $atts ) );

		if ( $odd == 'true' ) {
			$odd = ' odd';
		} else {
			$odd = '';
		}

		$output = '<div class="plan-labelled-row ' . $odd . '">' . do_shortcode($content) . '</div>';

		$output = apply_filters( 'theme_shortcode_output', $output, $atts, $shortcodename );

		return $output;
	}
	add_shortcode( 'chp_pricing_row_label', 'chp_pricing_row_label_shortcode' );
}