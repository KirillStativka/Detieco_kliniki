<?php
//video preview
if ( ! function_exists( 'shortcode_video_preview' ) ) {
	function shortcode_video_preview( $atts, $content = null, $shortcodename = '' ) {
		extract( shortcode_atts(
			array(
				'title' => '',
				'post_url' => '',
				'date' => '',
				'author' => '',
				'custom_class' => '',
			), $atts ) );
		
		$output_title 	= '';
		$output_author	= '';
		$output_date 	= '';
		$post_ID 		= url_to_postid( $post_url );
		$get_post 		= get_post( $post_ID );
		$get_user 		= get_userdata( $get_post->post_author );
		$user_url 		= get_bloginfo( 'url' ) . '/author/' . $get_user->user_nicename;
		$video_url		= parser_video_url( get_post_meta( $post_ID, 'tz_video_embed', true ) );
		$get_image_url 	= video_image( $video_url );
		$img 			= '';

		if ( $title == "yes" ) {
			$output_title = '<h4><a href="' . esc_url( $post_url ) . '" title="' . esc_attr( $get_post->post_title ) . '">' . esc_attr( $get_post->post_title ) . '</a></h4>';
		}
		if( $author == "yes" ) {
			$output_author = '<span class="post_author">' . __( 'Posts by', 'base' ) . ' <a href="' . esc_url( $user_url ) . '" title="' . __( 'Posts by', 'base' ) . ' ' . esc_attr( $get_user->user_nicename ) . '"  rel="author">' . esc_attr( $get_user->user_nicename ) . '</a></span>';
		}
		if( $date == "yes" ) {
			$output_date = '<span class="post_date"><time datetime="' . esc_attr( $get_post->post_date ) . '"> ' . esc_attr( get_the_date() ) . '</time></span>';
		}
		if( $get_image_url != false && $get_image_url != '' ) {
			$img = '<a class="preview_image"  href="' . esc_url( $post_url ) . '" title="' . esc_attr( $get_image_url ) . '"><img src="' . esc_url( $get_image_url ) . '" alt=""><span class="icon-play-circle hover"></span></a>';
		}
		$output ='<figure class="featured-thumbnail thumbnail video_preview clearfix' . esc_attr( $custom_class ) . '"><div>' . $img . '<figcaption>' . $output_title . $output_author . $output_date . '</figcaption></div></figure>';

		$output = apply_filters( 'theme_shortcode_output', $output, $atts, $shortcodename );

		return $output;
	}
	add_shortcode( 'video_preview', 'shortcode_video_preview' );
}

if ( ! function_exists( 'parser_video_url' ) ) {
	function parser_video_url( $video_url ) {
		$video_url = explode( " ", $video_url );
		foreach ( $video_url as $item ) {
			if ( stripos( $item, 'src' ) !== false ) {
				$url_array = parse_url( $item );
				$video_url = $url_array["path"];
				$video_url = stripcslashes( $video_url );
				$video_url = strip_tags( $video_url );
				$video_url = str_replace( '&quot;', '', $video_url );
				break;
			}
		}
		return $video_url;
	}
}
if ( ! function_exists( 'video_image' ) ) {
	function video_image( $url ){
		if ( $url[0] !== '' ) {
			$image_id = basename( $url );
			if ( stripos( $url, "youtube" ) !== false ) {
				return "http://img.youtube.com/vi/" . $image_id . "/0.jpg";
			} elseif ( stripos( $url, "vimeo" ) !== false ) {
				$get_header = @get_headers( "http://vimeo.com/api/v2/video/" . $image_id . ".php" );
				if ( stripos( $get_header[0], '200 OK' ) ) {
					$hash = unserialize( file_get_contents( "http://vimeo.com/api/v2/video/" . $image_id . ".php" ) );
					return $hash[0]["thumbnail_large"];
				} else {
					return false;
				}
			}
		} else {
			return false;
		}
	}
}
?>