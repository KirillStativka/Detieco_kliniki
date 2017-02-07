<?php
// Recent Comments
if ( ! function_exists('shortcode_recent_comments' ) ) {

	function shortcode_recent_comments( $atts, $content = null, $shortcodename = '' ) {
		extract( shortcode_atts( array(
			'num'          => '5',
			'custom_class' => ''
		), $atts ) );

		global $wpdb;
		$itemcounter = 0;

		if ( function_exists( 'wpml_get_language_information' ) ) {
			global $sitepress;
			$sql = $wpdb->prepare( "
				SELECT * FROM {$wpdb->comments}
				JOIN {$wpdb->prefix}icl_translations
				ON {$wpdb->comments}.comment_post_id = {$wpdb->prefix}icl_translations.element_id
				AND {$wpdb->prefix}icl_translations.element_type='post_post'
				WHERE comment_approved = '1'
				AND language_code = '%s'
				ORDER BY comment_date_gmt DESC LIMIT %d", $sitepress->get_current_language(), $num );
		} else {
			$sql = $wpdb->prepare( "
				SELECT * FROM $wpdb->comments
				LEFT OUTER JOIN $wpdb->posts
				ON ($wpdb->comments.comment_post_ID = $wpdb->posts.ID)
				WHERE comment_approved = '1'
				AND comment_type = ''
				AND post_password = ''
				ORDER BY comment_date_gmt DESC LIMIT %d", $num );
		}
		
		$comment_len = 100;
		$comments = $wpdb->get_results( $sql );

		$output = '<ul class="recent-comments unstyled">';

		foreach ($comments as $comment) {
			$output .= '<li class="list-item-' . esc_attr( $itemcounter ) . '">';
				$output .= '<a href="' . get_comment_link( $comment->comment_ID ) . '" title="on ' . get_the_title( $comment->comment_post_ID ) . '">';
					$output .= strip_tags( $comment->comment_author ) . ' : ' . strip_tags( substr( apply_filters( 'get_comment_text', $comment->comment_content ), 0, $comment_len ) );
					if ( strlen( $comment->comment_content ) > $comment_len ) $output .= '...';
				$output .= '</a>';
			$output .= '</li>';
			$itemcounter++;
		}

		$output .= '</ul>';

		$output = apply_filters( 'theme_shortcode_output', $output, $atts, $shortcodename );

		return $output;
	}
	add_shortcode( 'recent_comments', 'shortcode_recent_comments' );
}