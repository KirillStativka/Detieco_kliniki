<?php get_header(); ?>
	<section id="content">
		<div class="wrapper">
			<div class="content">
				<div class="content-wrap">
					<div class="content-main content-inner">
						<?php get_template_part('blocks/breadcrumbs'); ?>
						<?php while ( have_posts() ) : the_post(); ?>
						<?php the_title('<h1 class="page-title">', '</h1>'); ?>
						<div class="text">
							<?php the_content(); ?>
						</div>
						<?php endwhile; ?>
					</div>
					<?php get_sidebar(); ?>
				</div>
			</div>
		</div>
	</section>
<?php get_footer(); ?>