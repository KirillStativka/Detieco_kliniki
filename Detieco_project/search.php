<?php get_header(); ?>
	<section id="content">
		<div class="wrapper">
			<div class="content">
				<div class="content-wrap">
					<div class="content-main content-inner">
						<?php if ( have_posts() ) : ?>
							<h1 class="page-title"><?php printf( __( 'Результаты поиска для: %s', 'base' ), '<span>' . get_search_query() . '</span>'); ?></h1>
							<?php while ( have_posts() ) : the_post(); ?>
								<?php get_template_part( 'blocks/content' ); ?>
							<?php endwhile; ?>
							<?php get_template_part( 'blocks/pager' ); ?>
						<?php else : ?>
							<?php get_template_part( 'blocks/not_found' ); ?>
						<?php endif; ?>
					</div>
					<?php get_sidebar(); ?>
				</div>
			</div>
		</div>
	</section>
<?php get_footer(); ?>