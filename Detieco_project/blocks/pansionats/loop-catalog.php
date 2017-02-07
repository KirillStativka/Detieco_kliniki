<?php
$permalink = get_permalink();
$post_type = $post->post_type;

$paged = get_query_var('the_page') ? get_query_var('the_page') : 1;
$args = array(
    'post_type' => 'kliniki',
    'posts_per_page' => 6,
    'paged' => $paged,
);
if(is_singular('cities_kliniki')) {
    $args['meta_query'] = array(
        'relation' => 'AND',
        array(
            'key' => 'city_field',
            'value' => $post->ID,
            'type' => 'NUMERIC'
        ),
    );
    $types = array('chastnie', 'gos');
    $type = get_query_var('type_organisation');
    if($type && in_array($type, $types)) {
        $args['meta_query'][] = array(
                'key' => 'type_organisation',
                'value' => $type,
            );
    }
    $physical = $_GET['physical'];
    $psyho = $_GET['psyho'];
    if($physical == 'lezhachiy') {
        $params_url['physical'] = 'lezhachiy';
        $args['meta_query'][] = array(
            'key' => 'physical_sostoyanie',
            'value' => 'lezhachiy',
        );
    } elseif($physical == 'hodyachiy') {
        $args['meta_query'][] = array(
            'key' => 'physical_sostoyanie',
            'value' => 'hodyachiy',
        );
    }

    if($psyho == 'adekvatnoe') {
        $args['meta_query'][] = array(
            'key' => 'psiho_sostoyanie',
            'value' => 'adekvatnoe',
        );
    } elseif($psyho == 'neadekvatnoe') {
        $args['meta_query'][] = array(
            'key' => 'psiho_sostoyanie',
            'value' => 'neadekvatnoe',
        );
    }
}
if(is_singular('countries_kliniki')) {
    $args['meta_query'] = array(
        array(
            'key' => 'countries_field',
            'value' => $post->ID,
            'type' => 'NUMERIC'
        ),
    );
}

$wp_query = new WP_Query($args);
$counts = $wp_query->max_num_pages;

if($wp_query->have_posts()): ?>
<?php if ($post_type == 'cities_kliniki'): ?>
    <div class="map" id="map"></div>
<?php endif; ?>
<div class="houses">
    <div class="houses-wrap">
        <div class="houses-content">
            <?php $i = 0; while($wp_query->have_posts()): $wp_query->the_post(); ?>
            <?php
            $_image = wp_get_attachment_image( get_post_thumbnail_id($post->ID), 'thumbnail_389x347', false, array( 'class' => 'cover' ) );
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
            <div class="house-item<?php echo ($i == 5 && $counts != get_query_var('paged')) ? ' houses-last' : ''; ?>">
                <div class="house-item-image">
                    <?php echo $_image; ?>
                    <a href="<?php the_permalink(); ?>">
                        <div class="house-item-image-text">
                            <div class="house-item-image-title"><?php the_title(); ?></div>
                            <div class="house-item-image-content">
                                <div class="house-item-image-content-wrap">
                                    <?php the_field('short_desc'); ?>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="house-item-content">
                    <div class="house-info">
                            <div class="house-info-row">
                                <div class="house-info-title">
                                    <span class="icon adress-icon"></span>
                                    <?php _e('Адрес:', 'base'); ?>
                                </div>
                                <div class="house-info-val">
                                    <?php if($_index): ?><?php echo $_index; ?>, <?php endif; ?>
                                    <?php echo 'г. ' . $_city->post_title; ?>
                                    <?php if($_address): ?>, <?php echo $_address; ?><?php endif; ?>
                                </div>
                            </div>
                        <?php if($_phone): ?>
                            <div class="house-info-row">
                                <div class="house-info-title">
                                    <span class="icon phone-icon"></span>
                                    <?php _e('Тел.:', 'base'); ?>
                                </div>
                                <div class="house-info-val">
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
                                <div class="house-info-val">
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
                                <div class="house-info-val">
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
                            $rating = str_replace('gdrts-state-active', 'gdrts-state-inactive', $rating);
                            print_r($rating);
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php $i++; endwhile; //wp_reset_query(); ?>
        </div>
    </div>
    <?php if($counts > get_query_var('paged')) :
        $page = get_query_var('paged') + 1;
        ?>
    <div class="text-center">

        <a href="<?php echo $permalink . '?the_page=' . $page; ?>" data-nextpage="<?php echo $page; ?>" class="button show-more"><?php _e('ПОКАЗАТЬ ЕЩЕ', 'base'); ?></a>
    </div>
    <?php endif; ?>
</div>
<?php else: ?>
    <h3><?php _e('Не найдено', 'base'); ?></h3>
<?php endif; wp_reset_query(); ?>