<?php
// Shortcode site map
if ( ! function_exists( 'shortcode_site_map' ) ) {
	function shortcode_site_map( $atts, $content = null, $shortcodename = '' ) {
		extract( shortcode_atts( array(
			'title' => '',
			'type' => 'Lines',
			'custom_class' => ''
		), $atts ) );

		$title = ( $title != '' ) ? '<h2 class="site_map_title"><span class="icon-sitemap"></span>' . esc_html( $title ) . '</h2>' : '' ;
		$args = array(
			'public'   => true,
			'_builtin' => false
		);
		$post_types = get_post_types( $args, 'names', 'or' );

		$sort_array = array(
			'page' 		=> '',
			'post' 		=> '',
			'services' 	=> '',
			'portfolio'	=> '',
			'slider' 	=> '',
			'team' 		=> '',
			'testi' 	=> '',
			'faq' 		=> ''
		);
		$post_types = array_merge( $sort_array, $post_types );
		unset( $post_types['attachment'], $post_types['wpcf7_contact_form'] );
		$span_counter = 0;
		$wrapp_class = ( $type != 'Lines' ) ? 'group' : '';
		$item_class = ( $type != 'Lines' ) ? 'grid  clearfix' : 'line clearfix';
		$output = '<div class="site_map ' . esc_attr( $custom_class ) . ' clearfix">' . $title;

		foreach ( $post_types as $post_type ) {
			if ( ! empty( $post_type ) ) {
				$output .= ( $span_counter == 0 && $type != 'line' ) ? '<div class="' . sanitize_html_class( $wrapp_class ) . '">' : '' ;

				$pt = get_post_type_object( $post_type );
				$output .= '<div class="' . esc_attr( $item_class ) . '"><h2>' . esc_html( $pt->labels->name ) . '</h2><ul>';

				$r = new WP_Query(
					array(
						'post_type'		 => $post_type,
						'posts_per_page' => -1,
						'orderby' 		 => 'title',
						'order' 		 => 'ASC'
					)
				);
				
				if ( $r->have_posts() ){
					while ( $r->have_posts() ) {
						$r->the_post();
						$output .= '<li><a href="' . get_permalink() . '">' . get_the_title() . '</a></li>';
					}
				}
				wp_reset_query();
				if ( $span_counter > 2 && $type != 'line' ) {
					$span_counter = 0;
					$output .= '</div>';
				} else {
					$span_counter ++;
				}
				$output .= '</ul></div>';
			}
		}
		$output .= '</div>';

		$output = apply_filters( 'theme_shortcode_output', $output, $atts, $shortcodename );

		return $output;
	}
	add_shortcode( 'site_map', 'shortcode_site_map' );
}