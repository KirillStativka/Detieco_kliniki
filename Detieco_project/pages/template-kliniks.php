<?php
/*
Template Name: Шаблон Клиник
*/
get_header(); ?>
    <section id="content">
        <div class="wrapper">
            <div class="content">
                <div class="content-wrap">
                    <div class="content-main content-inner">
                        <?php while(have_posts()): the_post(); ?>

                        <?php get_template_part('blocks/kliniki/filter-form'); ?>
<!-- Yandex.RTB R-A-185002-2 -->
<!--<div id="yandex_rtb_R-A-185002-2"></div>
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
</script>-->
                        <?php get_template_part('blocks/kliniki/loop-catalog'); ?>

                        <div class="home-text text">
                            <?php the_content(); ?>
                        </div>
                        <?php get_template_part('blocks/social'); ?>

                        <div class="comments">
                            <?php comments_template('', true); ?>
                        </div>

                        <?php endwhile ;?>
                    </div>
                    <?php get_sidebar(); ?>
                </div>
            </div>
        </div>
    </section>
<?php get_footer(); ?>