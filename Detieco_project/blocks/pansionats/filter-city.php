<?php
$types = get_field_object('field_56a553b6a9c8a')['choices'];
$physical = get_field_object('field_56a55458a2f6d')['choices'];
$psyho = get_field_object('field_56a5549ba2f6e')['choices'];

array_shift($physical);
array_shift($psyho);
?>
<div class="filters">
    <form action="<?php the_permalink(); ?>" method="get" class="city_filters">
        <div class="filters-column">
            <div class="filters-title"><?php _e('Тип организации', 'base'); ?></div>
            <div class="filters-item">
                <div class="check">
                    <input type="radio" id="r1" name="type" value="all" <?php echo (!array_key_exists(get_query_var('type_organisation'), $types)) ? ' checked="checked"' : ''; ?>>
                    <label for="r1"><?php _e('Все', 'base'); ?></label>
                </div>
            </div>
            <?php foreach($types as $k => $type): ?>
            <div class="filters-item">
                <div class="check">
                    <input type="radio" id="r2" name="type" value="<?php echo $k; ?>" <?php echo (get_query_var('type_organisation') == $k) ? ' checked="checked"': ''; ?>>
                    <label for="r2"><?php echo $type; ?></label>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <div class="filters-column">
            <div class="filters-title"><?php _e('Физ. состояние', 'base'); ?></div>
                <div class="filters-item">
                    <div class="check">
                        <input type="radio" id="r2" name="physical" value="all" <?php echo (!array_key_exists($_GET['physical'], $physical)) ? ' checked="checked"': ''; ?>>
                        <label for="r2"><?php _e('Любое', 'base'); ?></label>
                    </div>
                </div>
            <?php foreach($physical as $k => $type): ?>
                <div class="filters-item">
                    <div class="check">
                        <input type="radio" id="r2" name="physical" value="<?php echo $k; ?>" <?php echo ($_GET['physical'] == $k) ? ' checked="checked"': ''; ?>>
                        <label for="r2"><?php echo $type; ?></label>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <div class="filters-column">
            <div class="filters-title"><?php _e('Псих. состояние', 'base'); ?></div>
                <div class="filters-item">
                    <div class="check">
                        <input type="radio" id="r2" name="psyho" value="all" <?php echo (!array_key_exists($_GET['psyho'], $physical)) ? ' checked="checked"': ''; ?>>
                        <label for="r2"><?php _e('Любое', 'base'); ?></label>
                    </div>
                </div>
            <?php foreach($psyho as $k => $type): ?>
                <div class="filters-item">
                    <div class="check">
                        <input type="radio" id="r2" name="psyho" value="<?php echo $k; ?>" <?php echo ($_GET['psyho'] == $k) ? ' checked="checked"': ''; ?>>
                        <label for="r2"><?php echo $type; ?></label>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </form>
</div>