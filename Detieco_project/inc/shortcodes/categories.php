<?php
/**
 * Categories
 *
 */
if ( ! function_exists( 'categories_shortcode' ) ) {

	function categories_shortcode( $atts, $content = null, $shortcodename = '' ) {
		extract( shortcode_atts(
			array(
				'type'  => '',
				'class' => 'check'
			), $atts ) );

		$taxonomy_value = 'category';

		if ( ! empty( $type ) ){
			$taxonomy_value = $type;
		}

		if ( empty( $class ) ) {
			$class = 'categories';
		}

		$args = array(
			'type'     => 'post',
			'taxonomy' => $taxonomy_value,
		);

		$categories = get_categories( $args );
		$output = '<div class="list styled ' . sanitize_html_class( $class ) . '-list">';
		$output .= '<ul>';
		foreach ( $categories as $category ) {
			$output .= '<li>';
			$output .= '<a href="' . get_category_link( $category ) . '" title="' . esc_attr( $category->slug ) . '" ' . '>' . $category->name . '</a>';
			$output .= '</li>';
		}
		$output .= '</ul>';
		$output .= '</div>';

		$output = apply_filters( 'theme_shortcode_output', $output, $atts, $shortcodename );

		return $output;
	}
	add_shortcode('categories', 'categories_shortcode');

}?>