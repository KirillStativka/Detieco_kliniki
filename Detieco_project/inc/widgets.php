<?php

class Widget_Popular_Posts extends WP_Widget {

	function __construct() {
		$widget_ops = array(
			'classname' => 'widget_popular_entries',
			'description' => __( 'Популярные Клиники', 'base' ),
		);
		parent::__construct( 'widget_popular_entries', __( 'Популярные', 'base' ), $widget_ops );
		$this->alt_option_name = 'widget_popular_entries';

		add_action( 'save_post',    array( &$this, 'flush_widget_cache' ) );
		add_action( 'deleted_post', array( &$this, 'flush_widget_cache' ) );
		add_action( 'switch_theme', array( &$this, 'flush_widget_cache' ) );
	}

	function widget( $args, $instance ) {
		$cache = wp_cache_get( 'widget_popular_posts', 'widget' );
        global $post;

		if ( !is_array( $cache ) )
			$cache = array();

		if ( isset( $cache[$args['widget_id']] ) ) {
			echo $cache[$args['widget_id']];
			return;
		}

		ob_start();
		extract( $args );

		$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? __( 'Популярные', 'base' ) : $instance['title'], $instance, $this->id_base );
		if ( ! $number = absint( $instance['number'] ) )
			$number = 10;
        
        $args = array(
            'post_type'			  => 'kliniki',
            'posts_per_page'      => $number,
            //'no_found_rows'       => true,
            'post_status'         => 'publish',
            'ignore_sticky_posts' => true,
            'meta_key' => 'views',
            'orderby' => 'meta_value_num',
            'order' => 'DESC',
        );
        
        if(is_singular('cities_kliniki')) {
			$args['meta_query'] = array(
				'relation' => 'AND',
				array(
					'key' => 'city_field',
					'value' => $post->ID,
					'type' => 'NUMERIC'
				),
			);
		}

		if(is_singular('countries_kliniki')) {
			$args['meta_query'] = array(
				array(
					'key' => 'countries_field',
					'value' => $post->ID,
					'type' => 'NUMERIC'
				),
			);
		}

		if(is_singular('kliniki')) {
			$city_field = get_field('city_field');
			$args['meta_query'] = array(
				array(
					'key' => 'city_field',
					'value' => $city_field->ID,
					'type' => 'NUMERIC'
				),
			);
		}
        
		$r = new WP_Query($args);
		if ( $r->have_posts() ) :
			?>
            
			<?php echo $before_widget; ?>
			<?php if ( $title ) echo $before_title . $title . $after_title; ?>

			<?php  while ( $r->have_posts() ) : $r->the_post(); ?>
				<div class="popular-item">
					<a href="<?php the_permalink() ?>">
						<?php
							$image = wp_get_attachment_image( get_post_thumbnail_id($posts->post->ID), 'thumbnail_278x190', false, array( 'class' => 'cover' ) );
							$city = get_field('city_field');
						?>
						<div class="popular-item-image">
							<?php echo $image; ?>
						</div>
						<div class="popular-item-content">
							<div class="popular-item-text">
								<?php the_field('short_desc'); ?>
							</div>
							<div class="popular-item-info">
								<div class="popular-item-left">
									<?php //_e('Дом престарелых', 'base'); ?>
									<div class="popular-item-title"><?php _e('«' . get_the_title() .'»', 'base'); ?></div>
									<?php _e('г. ' . $city->post_title, 'base'); ?>
								</div>
								<div class="popular-item-rate">
									<?php
									$test = gdrts_render_rating(
										array(
											'echo' => false, 'entity' => 'posts', 'name' => 'post', 'id' => $r->post->ID
										)
									);
									$test1 = array('<span class="people-votes">', 'gdrts-state-active');
									$test2 = array('<span class="people-votes hidden">', 'gdrts-state-inactive');
									$test = str_replace($test1, $test2, $test);
									print_r($test);
									?>
								</div>
							</div>
						</div>
					</a>
				</div>
			<?php endwhile; ?>

			<?php echo $after_widget; ?>
			<?php
			wp_reset_postdata();

		endif;

		$cache[$args['widget_id']] = ob_get_flush();
		wp_cache_set( 'widget_popular_posts', $cache, 'widget' );
	}

	function update( $new_instance, $old_instance ) {
		$instance           = $old_instance;
		$instance['title']  = strip_tags( $new_instance['title'] );
		$instance['number'] = (int) $new_instance['number'];
		$this->flush_widget_cache();

		$alloptions = wp_cache_get( 'alloptions', 'options' );
		if ( isset( $alloptions['widget_popular_entries'] ) )
			delete_option( 'widget_popular_entries' );

		return $instance;
	}

	function flush_widget_cache() {
		wp_cache_delete( 'widget_popular_posts', 'widget' );
	}

	function form( $instance ) {
		$title	= isset( $instance['title'] )  ? esc_attr( $instance['title'] ) : '';
		$number	= isset( $instance['number'] ) ? absint( $instance['number'] ) : 5;
		?>
		<p><label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Заголовок:', 'base' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" /></p>

		<p><label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php _e( 'Количество постов:', 'base' ); ?></label>
			<input id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" type="text" value="<?php echo $number; ?>" size="3" /></p>
		<?php
	}
}
add_action( 'widgets_init', create_function( '', 'return register_widget( "Widget_Popular_Posts" );' ) );


class Custom_Widget_Recent_Posts extends WP_Widget {
	public function __construct() {
		$widget_ops = array('classname' => 'widget_recent_entries', 'description' => __( "Your site&#8217;s most recent Posts.") );
		parent::__construct('recent-posts', __('Recent Posts'), $widget_ops);
		$this->alt_option_name = 'widget_recent_entries';
	}

	public function widget( $args, $instance ) {
		if ( ! isset( $args['widget_id'] ) ) {
			$args['widget_id'] = $this->id;
		}

		$title = ( ! empty( $instance['title'] ) ) ? $instance['title'] : __( 'Recent Posts' );

		/** This filter is documented in wp-includes/widgets/class-wp-widget-pages.php */
		$title = apply_filters( 'widget_title', $title, $instance, $this->id_base );

		$number = ( ! empty( $instance['number'] ) ) ? absint( $instance['number'] ) : 5;
		if ( ! $number )
			$number = 5;
		$show_date = isset( $instance['show_date'] ) ? $instance['show_date'] : false;

		/**
		 * Filter the arguments for the Recent Posts widget.
		 *
		 * @since 3.4.0
		 *
		 * @see WP_Query::get_posts()
		 *
		 * @param array $args An array of arguments used to retrieve the recent posts.
		 */
		$r = new WP_Query( apply_filters( 'widget_posts_args', array(
			'posts_per_page'      => $number,
			'no_found_rows'       => true,
			'post_status'         => 'publish',
			'ignore_sticky_posts' => true
		) ) );

		if ($r->have_posts()) :
			?>
			<?php echo $args['before_widget']; ?>
			<?php if ( $title ) {
			echo $args['before_title'] . $title . $args['after_title'];
		} ?>
			<ul class="sidebar-articles">
				<?php while ( $r->have_posts() ) : $r->the_post(); ?>
					<li>
						<?php if ( $show_date ) : ?>
							<span class="post-date"><?php echo get_the_date(); ?></span>
						<?php endif; ?>
						<a href="<?php the_permalink(); ?>"><?php get_the_title() ? the_title() : the_ID(); ?></a>
					</li>
				<?php endwhile; ?>
			</ul>
			<?php echo $args['after_widget']; ?>
			<?php
			// Reset the global $the_post as this query will have stomped on it
			wp_reset_postdata();

		endif;
	}

	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = sanitize_text_field( $new_instance['title'] );
		$instance['number'] = (int) $new_instance['number'];
		$instance['show_date'] = isset( $new_instance['show_date'] ) ? (bool) $new_instance['show_date'] : false;
		return $instance;
	}

	public function form( $instance ) {
		$title     = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
		$number    = isset( $instance['number'] ) ? absint( $instance['number'] ) : 5;
		$show_date = isset( $instance['show_date'] ) ? (bool) $instance['show_date'] : false;
		?>
		<p><label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" /></p>

		<p><label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php _e( 'Number of posts to show:' ); ?></label>
			<input class="tiny-text" id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" type="number" step="1" min="1" value="<?php echo $number; ?>" size="3" /></p>

		<p><input class="checkbox" type="checkbox"<?php checked( $show_date ); ?> id="<?php echo $this->get_field_id( 'show_date' ); ?>" name="<?php echo $this->get_field_name( 'show_date' ); ?>" />
			<label for="<?php echo $this->get_field_id( 'show_date' ); ?>"><?php _e( 'Display post date?' ); ?></label></p>
		<?php
	}
}
add_action( 'widgets_init', create_function( '', 'unregister_widget( "WP_Widget_Recent_Posts" ); return register_widget( "Custom_Widget_Recent_Posts" );' ) );

class Widget_Filter_Kliniks extends WP_Widget {

	function __construct() {
		$widget_ops = array(
			'classname' => 'wdget_filter_kliniks',
			'description' => __( 'Блок фильтра клиник', 'base' ),
		);
		parent::__construct( 'wdget_filter_kliniks', __( 'Фильтр клиник', 'base' ), $widget_ops );
		$this->alt_option_name = 'wdget_filter_kliniks';

		add_action( 'save_post',    array( &$this, 'flush_widget_cache' ) );
		add_action( 'deleted_post', array( &$this, 'flush_widget_cache' ) );
		add_action( 'switch_theme', array( &$this, 'flush_widget_cache' ) );
	}

	function widget( $args, $instance ) {
		$cache = wp_cache_get( 'wdget_filter_kliniks', 'widget' );

		if ( !is_array( $cache ) )
			$cache = array();

		if ( isset( $cache[$args['widget_id']] ) ) {
			echo $cache[$args['widget_id']];
			return;
		}

		ob_start();
		extract( $args );

		$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? __( 'НАЙТИ КЛИНИКУ', 'base' ) : $instance['title'], $instance, $this->id_base );
?>
			<?php echo $before_widget; ?>
			<?php if ( $title ) echo $before_title . $title . $after_title; ?>

			<?php get_template_part('blocks/kliniki/widget-form'); ?>

			<?php echo $after_widget; ?>
		<?php
		$cache[$args['widget_id']] = ob_get_flush();
		wp_cache_set( 'wdget_filter_kliniks', $cache, 'widget' );
	}

	function update( $new_instance, $old_instance ) {
		$instance           = $old_instance;
		$instance['title']  = strip_tags( $new_instance['title'] );
		$this->flush_widget_cache();

		$alloptions = wp_cache_get( 'alloptions', 'options' );
		if ( isset( $alloptions['wdget_filter_kliniks'] ) )
			delete_option( 'wdget_filter_kliniks' );

		return $instance;
	}

	function flush_widget_cache() {
		wp_cache_delete( 'wdget_filter_kliniks', 'widget' );
	}

	function form( $instance ) {
		$title	= isset( $instance['title'] )  ? esc_attr( $instance['title'] ) : '';
?>
		<p><label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Заголовок:', 'base' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" /></p>
		<?php
	}
}
add_action( 'widgets_init', create_function( '', 'return register_widget( "Widget_Filter_Kliniks" );' ) );
