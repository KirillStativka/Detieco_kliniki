<div class="form">
    <div class="form-title"><?php _e('НАЙТИ КЛИНИКУ', 'base'); ?></div>
    <div class="form-content">
        <form action="<?php the_permalink(); ?>" method="get" class="main-filter">
            <?php
            $post_id = $post->ID;

            $args = array(
                'post_type' => 'countries_kliniki',
                'posts_per_page' => -1,
                'orderby' => 'title',
                'order' => 'ASC'
            );
            $countries = new WP_Query($args);
            if($countries->have_posts()): ?>
            <div class="input-wrap form-input">
                <div class="input-border country">
                    <select name="country">
                        <option value="choose"><?php _e('Страна', 'base'); ?></option>
                        <?php while($countries->have_posts()): $countries->the_post(); ?>
                        <option value="<?php echo $countries->post->ID; ?>" <?php echo ($post_id == $countries->post->ID) ? ' selected="selected"' : ''; ?>><?php the_title(); ?></option>
                        <?php endwhile; ?>
                    </select>
                </div>
            </div>
            <?php endif; wp_reset_query(); ?>

            <?php $args = array(
                'post_type' => 'cities_kliniki',
                'posts_per_page' => -1,
                'orderby' => 'title',
                'order' => 'ASC'
            );
                  if(is_singular('countries_kliniki')) {
                $args['meta_query'] = array(
                    //'relation' => 'OR',
                    array(
                        'key' => 'country',
                        'value' => $post_id,
                        'type' => 'NUMERIC'
                    ),
                );
                $disabled = false;
            } else {
                $disabled = true;
            }
            $cities = new WP_Query($args);
            if($cities->have_posts()): ?>
            <div class="input-wrap form-input">
                <div class="input-border city">
                    <select name="city"<?php echo ($disabled) ? ' disabled="disabled"': '';?>>
                        <option value="choose"><?php _e('Город', 'base'); ?></option>
                        <?php while($cities->have_posts()): $cities->the_post(); ?>
                        <option value="<?php echo $cities->post->ID; ?>"><?php the_title(); ?></option>
                        <?php endwhile; ?>
                    </select>
                </div>
            </div>
            <?php endif; wp_reset_query(); ?>

            <div class="input-wrap form-input">
                <div class="input-border type">
                    <select name="type" disabled="disabled">
                        <option value="choose"><?php _e('Тип', 'base'); ?></option>
                        <option value="all"><?php _e('Любое', 'base'); ?></option>
                        <option value="chastnie"><?php _e('Частные', 'base'); ?></option>
                        <option value="gos"><?php _e('Государственные', 'base'); ?></option>
                    </select>
                </div>
            </div>
            <div class="input-wrap form-input">
                <div class="input-border physical">
                    <select name="physical" disabled="disabled">
                        <option value="choose">Физическое сост.</option>
                        <option value="1"><?php _e('Любое', 'base'); ?></option>
                        <option value="2"><?php _e('Лежачий', 'base'); ?></option>
                        <option value="3"><?php _e('Ходячий', 'base'); ?></option>
                    </select>
                </div>
            </div>
            <div class="input-wrap form-input">
                <div class="input-border psyho">
                    <select name="psyho" disabled="disabled">
                        <option value="choose">Психическое сост.</option>
                        <option value="1"><?php _e('Любое', 'base'); ?></option>
                        <option value="2"><?php _e('Адекватный', 'base'); ?></option>
                        <option value="3"><?php _e('Не адекватный', 'base'); ?></option>
                    </select>
                </div>
            </div>
            <div class="input-wrap form-input">
                <div class="input-border">
                    <button class="search-button" disabled="disabled"><?php _e('ПОИСК', 'base'); ?></button>
                </div>
            </div>
        </form>
    </div>
</div>