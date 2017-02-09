<?php get_header(); ?>
	<section id="content">
		<div class="wrapper">
			<div class="content">
				<div class="content-wrap">
					<div class="content-main content-inner">
						<?php get_template_part('blocks/breadcrumbs'); ?>
							<?php get_template_part( 'blocks/content', get_post_type() ); ?>
							<?php get_template_part( 'blocks/social' ); ?>
							<?php comments_template('', true); ?>
								<!-- Put this script tag to the <head> of your page -->
								<script type="text/javascript" src="//vk.com/js/api/openapi.js?122"></script>

								<script type="text/javascript">
								VK.init({apiId: 5510424, onlyWidgets: true});
								</script>

								<!-- Put this div tag to the place, where the Comments block will be -->
								<div id="vk_comments"></div>
								<script type="text/javascript">
								VK.Widgets.Comments("vk_comments", {limit: 5, attach: "photo,video,audio,link"});
								</script>
								<?php //get_template_part( 'blocks/pager-single', get_post_type() ); ?>
					</div>
					<?php get_sidebar(); ?>
				</div>
			</div>
		</div>
	</section>
<?php get_footer(); ?>

