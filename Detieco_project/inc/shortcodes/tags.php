<?php
//Tag Cloud
if ( ! function_exists( 'shortcode_tags' ) ) {

	function shortcode_tags( $atts, $content = null, $shortcodename = '' ) {
		$output = '<div class="tags-cloud clearfix">';
		$tags = wp_tag_cloud( 'smallest=8&largest=8&format=array' );

		foreach( $tags as $tag ){
			$output .= $tag . ' ';
		}

		$output .= '</div><!-- .tags-cloud (end) -->';

		$output = apply_filters( 'theme_shortcode_output', $output, $atts, $shortcodename );

		return $output;
	}
	add_shortcode('tags', 'shortcode_tags');

}