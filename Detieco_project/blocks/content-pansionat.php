<?php if(is_single()): ?>
    <div itemscope itemtype="http://schema.org/Organization">

    <?php the_title('<h1 class="page-title"><span itemprop="name">', '</span></h1>'); ?>
<div class="ads_1">
<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<!-- ADS-pod-H1-(detieco.ru) -->
<ins class="adsbygoogle"
     style="display:block"
     data-ad-client="ca-pub-7636537690094524"
     data-ad-slot="1109255914"
     data-ad-format="auto"></ins>
<script>
(adsbygoogle = window.adsbygoogle || []).push({});
</script>
</div>
<div class="rsya">
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
</div>

        <?php get_template_part('blocks/kliniki/head-info'); ?>
    
    </div>

    <?php get_template_part('blocks/kliniki/gallery'); ?>

<div class="rsya2">
<!-- Yandex.RTB R-A-185002-2 -->
    <!--
<div id="yandex_rtb_R-A-185002-2"></div>
<script type="text/javascript">
    (function(w, d, n, s, t) {
        w[n] = w[n] || [];
        w[n].push(function() {
            Ya.Context.AdvManager.render({
                blockId: "R-A-185002-2",
                renderTo: "yandex_rtb_R-A-185002-2",
                async: true
            });
        });
        t = d.getElementsByTagName("script")[0];
        s = d.createElement("script");
        s.type = "text/javascript";
        s.src = "//an.yandex.ru/system/context.js";
        s.async = true;
        t.parentNode.insertBefore(s, t);
    })(this, this.document, "yandexContextAsyncCallbacks");
</script>
            -->
</div>


    <div class="text anc">
        <?php the_field('content'); ?>
    </div>
<?php else: ?>
    <div class="info-item" id="post-<?php the_ID(); ?>">
        <a href="<?php the_permalink(); ?>" class="info-item-link" style="background-image: url(<?php echo wp_get_attachment_image_url(get_post_thumbnail_id($post->ID), 'thumbnail_347x225'); ?>)">
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

<div class="ads_2">
<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<!-- Рекомендуем detieco.ru -->
<ins class="adsbygoogle"
     style="display:block"
     data-ad-client="ca-pub-7636537690094524"
     data-ad-slot="7583395112"
     data-ad-format="autorelaxed"></ins>
<script>
(adsbygoogle = window.adsbygoogle || []).push({});
</script>
<!-- Яндекс.Директ -->
    <!--
<script type="text/javascript">
yandex_partner_id = 185002;
yandex_site_bg_color = 'F7F7F7';
yandex_stat_id = 7;
yandex_ad_format = 'direct';
yandex_font_size = 1;
yandex_direct_type = 'grid';
yandex_direct_border_type = 'ad';
yandex_direct_limit = 4;
yandex_direct_title_font_size = 3;
yandex_direct_links_underline = false;
yandex_direct_border_color = 'B5D675';
yandex_direct_title_color = '0000CC';
yandex_direct_url_color = '006600';
yandex_direct_text_color = '505050';
yandex_direct_hover_color = '0066FF';
yandex_direct_favicon = false;
yandex_no_sitelinks = true;
document.write('<scr'+'ipt type="text/javascript" src="//an.yandex.ru/system/context.js"></scr'+'ipt>');
</script>
    -->
</div>