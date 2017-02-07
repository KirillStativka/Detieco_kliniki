<?php if(is_single()): ?>
	<?php the_title('<h1 class="page-title">', '</h1>'); ?>
	<div class="text anc">
		<ul class="links">
			<li class="links-title"><span class="menu-icon"><img src="<?php bloginfo('template_url'); ?>/images/menu.png" alt=""></span> Содержание</li>
		</ul>
		<div class="atr_7">
			<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
			<!-- ADS-vverhu-articles-(detieco.ru) -->
			<ins class="adsbygoogle"
			style="display:block"
			data-ad-client="ca-pub-7636537690094524"
			data-ad-slot="2524526319"
			data-ad-format="auto"></ins>
			<script>
				(adsbygoogle = window.adsbygoogle || []).push({});
			</script>
		</div>
<!-- Яндекс.Директ -->
        <!--
<script type="text/javascript">
yandex_partner_id = 185002;
yandex_site_bg_color = 'F7F7F7';
yandex_stat_id = 8;
yandex_ad_format = 'direct';
yandex_font_size = 1.2;
yandex_direct_type = 'horizontal';
yandex_direct_limit = 1;
yandex_direct_title_font_size = 3;
yandex_direct_links_underline = false;
yandex_direct_title_color = '0000CC';
yandex_direct_url_color = '505050';
yandex_direct_text_color = '505050';
yandex_direct_hover_color = '0066FF';
yandex_direct_favicon = false;
yandex_no_sitelinks = true;
document.write('<scr'+'ipt type="text/javascript" src="//an.yandex.ru/system/context.js"></scr'+'ipt>');
</script>
            -->
		<div class="text-center">
			<div class="image text-center block-image">
				<?php if(has_post_thumbnail()) {
					the_post_thumbnail('thumbnail_700x9999');
					the_title('<div class="image-title">', '</div>');
				} ?>
			</div>
		</div>
		<?php the_content(); ?>
	</div>
	<?php get_template_part( 'blocks/recomend' ); ?>
<?php else: ?>
	<div class="info-item" id="post-<?php the_ID(); ?>">
		<a href="<?php the_permalink(); ?>" class="info-item-link">
			<?php echo wp_get_attachment_image(get_post_thumbnail_id($post->ID), 'thumbnail_347x225', false, array( 'class' => 'cover' )); ?>
			<div class="info-item-content">
				<div class="info-item-content-wrap">
					<div class="info-item-title">
						<?php the_title(); ?>
					</div>
					<?php echo new_theme_excerpt('27', '<br><br>ПОДРОБНЕЕ'); ?>
				</div>
			</div>
		</a>
	</div>
<?php endif; ?>

