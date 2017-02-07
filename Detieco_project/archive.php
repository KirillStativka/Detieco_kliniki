<?php get_header(); ?>
	<section id="content">
		<div class="wrapper">
			<div class="content">
				<div class="content-wrap">
					<div class="content-main content-inner">
					<?php if ( have_posts() ) : ?>
						<?php get_template_part('blocks/breadcrumbs'); ?>
						<?php get_template_part('blocks/categories'); ?>
						<div class="info-list">
							<?php while ( have_posts() ) : the_post(); ?>
								<?php get_template_part( 'blocks/content', get_post_type() ); ?>
							<?php endwhile; ?>
						</div>
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