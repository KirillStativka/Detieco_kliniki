<?php
if( ! function_exists( 'remove_invalid_tags' ) ) {
	function remove_invalid_tags( $str, $tags ) {
		foreach ( $tags as $tag ) {
			$str = preg_replace( '#^<\/' . $tag . '>|<' . $tag . '>$#', '', trim( $str ) );
		}
		return $str;
	}
}

// Row
if ( ! function_exists( 'row_shortcode' ) ) {
	function row_shortcode( $atts, $content = null, $shortcodename = '' ) {
		$content = remove_invalid_tags( $content, array( 'p' ) );
		
		extract( shortcode_atts( array(
			'custom_class'  => ''
		), $atts) );
		
		// add divs to the content
		$output = '<div class="row ' . esc_attr( $custom_class ) . '">';
		$output .= do_shortcode( $content );
		$output .= '</div><!-- .row (end) -->';

		$output = apply_filters( 'theme_shortcode_output', $output, $atts, $shortcodename );

		return $output;
	}
	add_shortcode( 'row', 'row_shortcode' );
}

// Row Inner
if ( ! function_exists( 'row_inner_shortcode' ) ) {
	function row_inner_shortcode( $atts, $content = null, $shortcodename = '' ) {
		$content = remove_invalid_tags( $content, array( 'p' ) );
		
		extract( shortcode_atts( array(
			'custom_class'  => ''
		), $atts ) );
		
		// add divs to the content
		$output = '<div class="row ' . esc_attr( $custom_class ) . '">';
		$output .= do_shortcode( $content );
		$output .= '</div> <!-- .row (end) -->';

		$output = apply_filters( 'theme_shortcode_output', $output, $atts, $shortcodename );

		return $output;
	}
	add_shortcode( 'row_in', 'row_inner_shortcode' );
}

// Row Fluid
if ( ! function_exists( 'row_fluid_shortcode' ) ) {
	function row_fluid_shortcode( $atts, $content = null, $shortcodename = '' ) {
		$content = remove_invalid_tags( $content, array( 'p' ) );
		
		extract( shortcode_atts( array(
			'custom_class'  => ''
		), $atts ) );
		
		// add divs to the content
		$output = '<div class="row-fluid ' . esc_attr( $custom_class ) . '">';
		$output .= do_shortcode( $content );
		$output .= '</div> <!-- .row-fluid (end) -->';

		$output = apply_filters( 'theme_shortcode_output', $output, $atts, $shortcodename );

		return $output;
	}
	add_shortcode( 'row_fluid', 'row_fluid_shortcode' );
}

// Columns
function theme_grid_column( $atts, $content = null, $shortcodename = '' ) {
	//remove wrong nested <p>
	$content = remove_invalid_tags( $content, array( 'p' ) );

	extract( shortcode_atts( array(
		'custom_class'  => ''
	), $atts ) );
	
	$col = preg_replace( '/\D+/', '', $shortcodename );
	// add divs to the content

	$return = '<div class="col-sm-10 col-md-' . $col . ' col-sm-offset-1 col-md-offset-0 ' . esc_attr( $custom_class ) . '">';
	$return .= do_shortcode( $content );
	$return .= '</div>';
	return $return;
}

add_shortcode( 'span1', 'theme_grid_column' );
add_shortcode( 'span2', 'theme_grid_column' );
add_shortcode( 'span3', 'theme_grid_column' );
add_shortcode( 'span4', 'theme_grid_column' );
add_shortcode( 'span5', 'theme_grid_column' );
add_shortcode( 'span6', 'theme_grid_column' );
add_shortcode( 'span7', 'theme_grid_column' );
add_shortcode( 'span8', 'theme_grid_column' );
add_shortcode( 'span9', 'theme_grid_column' );
add_shortcode( 'span10', 'theme_grid_column' );
add_shortcode( 'span11', 'theme_grid_column' );
add_shortcode( 'span12', 'theme_grid_column' );


// Fluid Columns
// one_half
function one_half_column( $atts, $content = null ) {
	//remove wrong nested <p>
	$content = remove_invalid_tags( $content, array( 'p' ) );

	// add divs to the content
	$return = '<div class="col-xs-12 col-sm-6 col-md-6">';
	$return .= do_shortcode( $content );
	$return .= '</div>';

	return $return;
}
add_shortcode( 'one_half', 'one_half_column' );

// one_third
function one_third_column( $atts, $content = null ) {
	//remove wrong nested <p>
	$content = remove_invalid_tags( $content, array( 'p' ) );

	// add divs to the content
	$return = '<div class="col-sm-4 col-md-4">';
	$return .= do_shortcode( $content );
	$return .= '</div>';

	return $return;
}
add_shortcode( 'one_third', 'one_third_column' );

// two_third
function two_third_column( $atts, $content = null ) {
	//remove wrong nested <p>
	$content = remove_invalid_tags( $content, array( 'p' ) );

	// add divs to the content
	$return = '<div class="col-sm-8 col-md-8">';
	$return .= do_shortcode( $content );
	$return .= '</div>';

	return $return;
}
add_shortcode( 'two_third', 'two_third_column' );

// one_fourth
function one_fourth_column( $atts, $content = null ) {
	//remove wrong nested <p>
	$content = remove_invalid_tags( $content, array( 'p' ) );

	// add divs to the content
	$return = '<div class="col-sm-3 col-md-3">';
	$return .= do_shortcode( $content );
	$return .= '</div>';

	return $return;
}
add_shortcode( 'one_fourth', 'one_fourth_column' );

// three_fourth
function three_fourth_column( $atts, $content = null) {
	//remove wrong nested <p>
	$content = remove_invalid_tags( $content, array( 'p' ) );

	// add divs to the content
	$return = '<div class="col-sm-9 col-md-9">';
	$return .= do_shortcode( $content );
	$return .= '</div>';

	return $return;
}
add_shortcode( 'three_fourth', 'three_fourth_column' );

// one_sixth
function one_sixth_column( $atts, $content = null ) {
	//remove wrong nested <p>
	$content = remove_invalid_tags( $content, array( 'p' ) );

	// add divs to the content
	$return = '<div class="col-sm-2 col-md-2">';
	$return .= do_shortcode( $content );
	$return .= '</div>';

	return $return;
}
add_shortcode( 'one_sixth', 'one_sixth_column' );

// five_sixth
function five_sixth_column( $atts, $content = null ) {
	//remove wrong nested <p>
	$content = remove_invalid_tags( $content, array( 'p' ) );

	// add divs to the content
	$return = '<div class="col-sm-10 col-md-10">';
	$return .= do_shortcode( $content );
	$return .= '</div>';

	return $return;
}
add_shortcode( 'five_sixth', 'five_sixth_column' );
?>