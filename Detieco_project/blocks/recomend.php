<?php
$args = array(
    'post_type' => 'post',
    'posts_per_page' => 4,
    'orderby' => 'rand'
    );
if(is_single()) {
    $categories = get_the_category();
    foreach($categories as $categ) {
        $category_id[] = $categ->cat_ID;
    }
    $args['post__not_in'] = array($post->ID);
    $args['category__in'] = $category_id;
}

$posts1 = new WP_Query($args);

if($posts1->have_posts()): ?>
<div style="text-align:center;margin:10px 0px;">

<div class="rsya">
<!-- Yandex.RTB R-A-185002-1 -->
<div id="yandex_rtb_R-A-185002-1"></div>
<script type="text/javascript">
    (function(w, d, n, s, t) {
        w[n] = w[n] || [];
        w[n].push(function() {
            Ya.Context.AdvManager.render({
                blockId: "R-A-185002-1",
                renderTo: "yandex_rtb_R-A-185002-1",
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
</div>

    <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
    <!-- ADS-vnizu-articles-(detieco.ru) -->
    <ins class="adsbygoogle"
    style="display:inline-block;width:336px;height:280px"
    data-ad-client="ca-pub-7636537690094524"
    data-ad-slot="3861658715"></ins>
    <script>
        (adsbygoogle = window.adsbygoogle || []).push({});
    </script></div>



    <div class="cat-block">
        <div class="cat-title">
            <span class="icon cat5-icon"></span>
            <?php _e('Рекомендуем полезные статьи', 'base'); ?>
        </div>
        <div class="cat-block-content">
            <?php while($posts1->have_posts()): $posts1->the_post(); ?>
                <div class="cat-block-left">
                    <?php $image = wp_get_attachment_image( get_post_thumbnail_id($posts1->post->ID), 'thumbnail_347x225', false, array( 'class' => 'cover' ) ); ?>
                    <div class="cat-block-left-image">
                        <?php echo $image; ?>
                    </div>
                    <div class="cat-block-left-content">
                        <div class="cat-block-left-title">
                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                        </div>
                        <div class="cat-block-left-text">
                            <?php echo new_theme_excerpt('10', '...'); ?>
                        </div>
                    </div>
                </div>
                <?php break; endwhile; ?>
                <div class="cat-block-list">
                    <?php while($posts1->have_posts()): $posts1->the_post(); ?>
                        <div class="cat-block-item">
                            <a href="<?php the_permalink(); ?>" class="cat-block-item-wrap">
                                <?php $image = wp_get_attachment_image( get_post_thumbnail_id($posts1->post->ID), 'thumbnail_74x74', false, array( 'class' => 'cover' ) ); ?>
                                <div class="cat-block-item-image">
                                    <?php echo $image; ?>
                                </div>
                                <div class="cat-block-item-content">
                                    <?php the_title(); ?>
                                </div>
                            </a>
                        </div>

                    <?php endwhile; ?>
                </div>
            </div>
        </div>
    <?php endif; wp_reset_query(); ?>
