<?php
if(get_query_var('type_organisation') == 'chastnie') {
    echo '<h1 class="page-title">' . get_field('chastnie_title'). '</h1>';
} elseif(get_query_var('type_organisation') == 'gos') {
    echo '<h1 class="page-title">' . get_field('gos_title'). '</h1>';
} else {
    the_title('<h1 class="page-title">', '</h1>');
}
?>

<div class="ads_1">
<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<!-- ADS-pod-H1-content-kliniki-(detieco.ru) -->
<ins class="adsbygoogle"
     style="display:block"
     data-ad-client="ca-pub-7636537690094524"
     data-ad-slot="1109255914"
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
<?php get_template_part('blocks/kliniki/filter-city'); ?>

<?php get_template_part('blocks/kliniki/loop-catalog'); ?>

<div class="ads_1">
<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<!-- ADS-pod-H1-content-kliniki-(detieco.ru) -->
<ins class="adsbygoogle"
     style="display:block"
     data-ad-client="ca-pub-7636537690094524"
     data-ad-slot="1109255914"
     data-ad-format="auto"></ins>
<script>
(adsbygoogle = window.adsbygoogle || []).push({});
</script>
</div>

<div class="home-text text">
    <?php
    if(get_query_var('type_organisation') == 'chastnie') {
        the_field('chastnie_content');
    } elseif(get_query_var('type_organisation') == 'gos') {
        the_field('gos_content');
    } else {
        the_field('main_content');
    }
    ?>
</div>