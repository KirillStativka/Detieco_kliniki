<?php
/**
 * Post Grid
 *
 */
if ( ! function_exists( 'team_shortcode' ) ) {

	function team_shortcode( $atts, $content = null, $shortcodename = '' ) {
		extract( shortcode_atts( array(
			'number'		  => 5,
			'order_by'        => 'date',
			'order'           => 'DESC',
			'thumb_width'     => '370',
			'thumb_height'    => '250',
			'custom_class'    => ''
		), $atts ) );

		// check what order by method user selected
		switch ( $order_by ) {
			case 'date':
				$order_by = 'post_date';
				break;
			case 'title':
				$order_by = 'title';
				break;
			case 'popular':
				$order_by = 'comment_count';
				break;
			case 'random':
				$order_by = 'rand';
				break;
		}

		// check what order method user selected (DESC or ASC)
		switch ( $order ) {
			case 'DESC':
				$order = 'DESC';
				break;
			case 'ASC':
				$order = 'ASC';
				break;
		}

		global $post;

		// WPML filter
		$suppress_filters = get_option( 'suppress_filters' );

		$args = array(
			'post_type'         => 'team',
			'numberposts'       => $number,
			'orderby'           => $order_by,
			'order'             => $order,
			'suppress_filters'  => $suppress_filters
		);

		$posts      = get_posts( $args );
		
		$output = '<div class="team ' . esc_attr( $custom_class ) . '">';
		$output .= '<ul class="figure-list">';
		foreach ( $posts as $j => $post ) {
			$post_id = $posts[$j]->ID;
			
			//Check if WPML is activated
			if ( defined( 'ICL_SITEPRESS_VERSION' ) ) {
				global $sitepress;

				$post_lang = $sitepress->get_language_for_element( $post_id, 'post_' . $type );
				$curr_lang = $sitepress->get_current_language();
				// Unset not translated posts
				if ( $post_lang != $curr_lang ) {
					unset( $posts[$j] );
				}
				// Post ID is different in a second language Solution
				if ( function_exists( 'icl_object_id' ) ) {
					$posts[$j] = get_post( icl_object_id( $posts[$j]->ID, $type, true ) );
				}
			}

			setup_postdata( $posts[ $j ] );
			$content = get_the_content();
			$attachment_url = wp_get_attachment_image_src( get_post_thumbnail_id( $post_id ), 'full' );
			$url            = $attachment_url['0'];
			$image          = base_image_resize( $url, $thumb_width, $thumb_height, true );
			$position		= ( get_field( 'position', $post_id ) )?  ' <span>' . get_field( 'position', $post_id ) . '</span>' : '';

			$output .= '<li>';
				$output .= '<figure>';
					if( has_post_thumbnail( $post_id ) ){
						$output .= '<div class="image"><img src="' . $image . '" alt="' . esc_attr( get_the_title( $post_id ) ) . '"></div>';
					}
					$output .= '<figcaption>' . get_the_title( $post_id ) . $position . '</figcaption>';
				$output .= '</figure>';
			$output .= '</li>';
		} // end for
		wp_reset_postdata(); // restore the global $post variable
		
		$output .= '</ul>';
		$output .= '</div>';

		$output = apply_filters( 'theme_shortcode_output', $output, $atts, $shortcodename );

		return $output;
	}
	add_shortcode('team', 'team_shortcode');
}?>