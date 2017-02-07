<?php
/**
 * Post Grid
 *
 */
if ( ! function_exists( 'posts_grid_shortcode' ) ) {

	function posts_grid_shortcode( $atts, $content = null, $shortcodename = '' ) {
		extract( shortcode_atts( array(
			'type'            => 'post',
			'category'        => '',
			'custom_category' => '',
			'tag'             => '',
			'columns'         => '3',
			'rows'            => '3',
			'order_by'        => 'date',
			'order'           => 'DESC',
			'thumb_width'     => '370',
			'thumb_height'    => '250',
			'meta'            => '',
			'link'            => 'yes',
			'link_text'       => __( 'Read More', 'base' ),
			'custom_class'    => ''
		), $atts ) );

		$block_classes = $columns;
		$rand  = rand();

		// columns
		switch ( $block_classes ) {
			case '3':
				$block_classes = 'col-3';
				break;
			case '4':
				$block_classes = 'col-4';
				break;
			default :
				$block_classes = 'col-4';
				break;
		}

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

		// show link after posts?
		switch ( $link ) {
			case 'yes':
				$link = true;
				break;
			case 'no':
				$link = false;
				break;
		}

		global $post;

		$numb = $columns * $rows;

		// WPML filter
		$suppress_filters = get_option( 'suppress_filters' );

		$args = array(
			'post_type'         => $type,
			'category_name'     => $category,
			$type . '_category' => $custom_category,
			'tag'               => $tag,
			'numberposts'       => $numb,
			'orderby'           => $order_by,
			'order'             => $order,
			'suppress_filters'  => $suppress_filters
		);

		$posts      = get_posts( $args );
		$i          = 0;
		$count      = 1;
		$output_end = '';
		$countul 	= 0;

		if ( $numb > count( $posts ) ) {
			$output_end = '</div>';
		}

		$output = '<div class="posts-grid ' . esc_attr( $custom_class ) . '">';


		foreach ( $posts as $j => $post ) {
			$post_id = $posts[ $j ]->ID;
			//Check if WPML is activated
			if ( defined( 'ICL_SITEPRESS_VERSION' ) ) {
				global $sitepress;

				$post_lang = $sitepress->get_language_for_element( $post_id, 'post_' . $type );
				$curr_lang = $sitepress->get_current_language();
				// Unset not translated posts
				if ( $post_lang != $curr_lang ) {
					unset( $posts[ $j ] );
				}
				// Post ID is different in a second language Solution
				if ( function_exists( 'icl_object_id' ) ) {
					$posts[ $j ] = get_post( icl_object_id( $posts[ $j ]->ID, $type, true ) );
				}
			}

			setup_postdata( $posts[ $j ] );
			$excerpt        = get_the_excerpt();
			
			$attachment_url = wp_get_attachment_image_src( get_post_thumbnail_id( $post_id ), 'full' );
			
			$url            = $attachment_url['0'];
			$image          = base_image_resize( $url, $thumb_width, $thumb_height, true );
			$mediaType      = get_post_meta( $post_id, 'tz_portfolio_type', true );
			$prettyType     = 0;

			if ( $count > $columns ) {
				$count = 1;
				$countul ++;
				$output .= '<div class="posts-grid ' . esc_attr( $custom_class ) . '">';
			}
			
			$output .= '<div class="col ' . esc_attr( $block_classes ) . '">';
			$output .= '<div class="post-block">';
				if( has_post_thumbnail( $post_id ) ){
					$output .= '<img src="' . $image . '" alt="' . esc_attr( get_the_title( $post_id ) ) . '">';
				}
				
				if ($meta == 'yes') {
					// post date
					$output .= '<time datetime="' . get_the_time( 'Y-m-d\TH:i:s', $post_id ) . '">' . get_the_date() . '</time>';
				}
				
				$output .= '<h2><a href="' . get_permalink( $post_id ) . '" title="' . get_the_title( $post_id ) . '">';
					$output .= get_the_title( $post_id );
				$output .= '</a></h2>';
				
				$output .= apply_filters( 'the_excerpt', $excerpt );
				
				if($link){
					$output .= '<a href="' . get_permalink( $post_id ) . '" class="read-more" title="' . get_the_title( $post_id ) . '">';
					$output .= $link_text;
					$output .= '</a>';
				}
				$output .= '</div>';
				$output .= '</div>';
				if ( $j == count( $posts ) - 1 ) {
					$output .= $output_end;
				}
			if ( $count % $columns == 0 ) {
				$output .= '</div><!-- .posts-grid (end) -->';
			}
			$count++;
			$i++;

		} // end for
		wp_reset_postdata(); // restore the global $post variable

		$output = apply_filters( 'theme_shortcode_output', $output, $atts, $shortcodename );

		return $output;
	}
	add_shortcode('posts_grid', 'posts_grid_shortcode');
}?>