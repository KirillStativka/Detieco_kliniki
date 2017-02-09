<?php get_template_part('blocks/kliniki/filter-form'); ?>
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
<?php get_template_part('blocks/kliniki/loop-catalog'); ?>

<div class="home-text text">
    <?php the_content(); ?>
</div>