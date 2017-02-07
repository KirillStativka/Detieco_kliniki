<?php if ( is_active_sidebar( 'default-sidebar' ) ) : ?>
	<!-- sidebar -->
	<aside class="sidebar">
		<div class="sidebar-wrap">
			<?php dynamic_sidebar( 'default-sidebar' ); ?>
		</div>
	</aside>
<?php endif; ?>