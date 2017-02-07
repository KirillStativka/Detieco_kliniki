<?php
$_address = get_field('address');
$_city = get_field('city_field');
$_index = get_field('index');
$_phone = get_field('phone');
$_email = get_field('e-mail');
$_site = get_field('site');
$_map = get_field('map');
$_type = get_field('type_organisation');
$_physical = get_field('physical_sostoyanie');
$_psiho = get_field('psiho_sostoyanie');
?>
<div class="house-item house-inner-item">
    <div class="house-item-image">
        <div class="house-item-map">
            <?php the_yandex_map('map') ?>
        </div>
    </div>
    <div class="house-item-content">
        <div class="house-info">
            <div class="house-info-row">
                <div class="house-info-title">
                    <span class="icon adress-icon"></span>
                    <?php _e('Адрес:', 'base'); ?>
                </div>
                <div class="house-info-val" itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">
                    <?php if($_index): ?><span itemprop="postalCode"> <?php echo $_index; ?>, </span><?php endif; ?>
                    <span itemprop="addressLocality"><?php echo 'г. ' . $_city->post_title; ?></span>
                    <?php if($_address): ?><span itemprop="streetAddress">, <?php echo $_address; ?> </span> <?php endif; ?>
                </div>
            </div>
            <?php if($_phone): ?>
            <div class="house-info-row">
                <div class="house-info-title">
                    <span class="icon phone-icon"></span>
                    <?php _e('Тел.:', 'base'); ?>
                </div>
                <div class="house-info-val" itemprop="telephone">
                    <?php echo $_phone; ?>
                </div>
            </div>
            <?php endif; ?>
            <?php if($_email): ?>
            <div class="house-info-row">
                <div class="house-info-title">
                    <span class="icon mail-icon"></span>
                    <?php _e('E-mail:', 'base'); ?>
                </div>
                <div class="house-info-val" itemprop="email">
                    <?php echo $_email; ?>
                </div>
            </div>
            <?php endif; ?>
            <?php if($_site): ?>
            <div class="house-info-row">
                <div class="house-info-title">
                    <span class="icon site-icon"></span>
                    <?php _e('Сайт:', 'base'); ?>
                </div>
                <div class="house-info-val link" onclick="window.open('<?php echo addhttp($_site); ?>','new_window');" >
                    <?php echo $_site; ?>
                </div>
            </div>
            <?php endif; ?>
        </div>
        <div class="house-info-text clearfix">
            <div class="house-info-marks">
                <div class="house-info-mark">
                    <?php if($_type == 'chastnie'): ?>
                    <?php $img = wp_get_attachment_image_url(get_field('chastnie_kliniki', 'options'), 'thumbnail_60x60'); ?>
                        <span class="icon" style="background: url(<?php echo $img; ?>) no-repeat;"></span>
                        <div><?php _e('Частное<br />Учреждение', 'base'); ?></div>
                    <?php elseif($_type == 'gos'): ?>
                    <?php $img = wp_get_attachment_image_url(get_field('gos_kliniki', 'options'), 'thumbnail_60x60'); ?>
                        <span class="icon" style="background: url(<?php echo $img; ?>) no-repeat;"></span>
                        <div><?php _e('Гос.<br>Учреждение', 'base'); ?></div>
                    <?php endif; ?>
                </div>
                <?php if($_physical): ?>
                    <div class="house-info-mark">
                        <?php if($_physical == 'all'): ?>
                            <?php $img = wp_get_attachment_image_url(get_field('physical_all', 'options'), 'thumbnail_60x60'); ?>
                            <span class="icon" style="background: url(<?php echo $img; ?>) no-repeat;"></span>
                            <div><?php _e('Любое физ.<br>состояние', 'base'); ?></div>
                        <?php elseif($_physical == 'lezhachiy'): ?>
                            <?php $img = wp_get_attachment_image_url(get_field('physical_lezhachiy', 'options'), 'thumbnail_60x60'); ?>
                            <span class="icon" style="background: url(<?php echo $img; ?>) no-repeat;"></span>
                            <div><?php _e('Лежачее физ.<br>состояние', 'base'); ?></div>
                        <?php elseif($_physical == 'hodyachiy'): ?>
                            <?php $img = wp_get_attachment_image_url(get_field('physical_hodyachiy', 'options'), 'thumbnail_60x60'); ?>
                            <span class="icon" style="background: url(<?php echo $img; ?>) no-repeat;"></span>
                            <div><?php _e('Ходячее физ.<br>состояние', 'base'); ?></div>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
                <?php if($_psiho): ?>
                    <div class="house-info-mark">
                        <?php if($_psiho == 'all'): ?>
                            <?php $img = wp_get_attachment_image_url(get_field('psyho_all', 'options'), 'thumbnail_60x60'); ?>
                            <span class="icon" style="background: url(<?php echo $img; ?>) no-repeat;"></span>
                            <div><?php _e('Любое псих.<br>состояние', 'base'); ?></div>
                        <?php elseif($_psiho == 'adekvatnoe'): ?>
                            <?php $img = wp_get_attachment_image_url(get_field('psyho_adekvatnoe', 'options'), 'thumbnail_60x60'); ?>
                            <span class="icon" style="background: url(<?php echo $img; ?>) no-repeat;"></span>
                            <div><?php _e('Адекватное псих.<br>состояние', 'base'); ?></div>
                        <?php elseif($_psiho == 'neadekvatnoe'): ?>
                            <?php $img = wp_get_attachment_image_url(get_field('psyho_neadekvatnoe', 'options'), 'thumbnail_60x60'); ?>
                            <span class="icon" style="background: url(<?php echo $img; ?>) no-repeat;"></span>
                            <div><?php _e('Неадекватное псих.<br>состояние', 'base'); ?></div>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
            </div>
            <div class="house-info-rate">
                <?php
                $rating = gdrts_render_rating(
                    array(
                        'echo' => false, 'entity' => 'posts', 'name' => 'post', 'id' => $post->ID
                    )
                );
                $arr1 = array(
                    '<div class="gdrts-rating-text">', 
                    '<div class="popular-item-rate-val">', 
                    '<span class="ratingcounting">'
                );
                $arr2 = array(
                    '<div class="gdrts-rating-text" itemprop="aggregateRating" itemscope itemtype="http://schema.org/AggregateRating"><span itemprop="itemReviewed" style="display:none;">' . get_the_title() . '</span>', 
                    '<div class="popular-item-rate-val" itemprop="ratingValue">', 
                    '<span class="ratingcounting" itemprop="reviewCount">'
                );
                $rating = str_replace($arr1, $arr2, $rating);
                print_r($rating);
                ?>
            </div>
        </div>
    </div>
</div>