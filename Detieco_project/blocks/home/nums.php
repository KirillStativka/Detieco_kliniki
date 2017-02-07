<?php
$count1 = new WP_Query( array('post_type' => 'cities_pansionat', 'post_status' => 'publish') );
$count2 = new WP_Query( array('post_type' => 'pansionat', 'post_status' => 'publish') );
$count3 = new WP_Query( array('post_type' => 'patronaj', 'post_status' => 'publish') );
?>
<div class="nums-wrap">
    <ul class="nums">
        <li class="nums-item item1">
            <span class="nums-item-icon num-item1"></span>
            <div class="nums-item-text">
                <div class="nums-item-title"><?php _e('Регионов и городов', 'base'); ?></div>
                <span class="nums-item-val">
                    <div class="wripper-counter">
                        <div class="counter" data-count="<?php echo $count1->found_posts; ?>">0</div>
                    </div>
                </span>
            </div>
        </li>
        <li class="nums-item">
            <span class="nums-item-icon num-item2"></span>
            <div class="nums-item-text">
                <div class="nums-item-title"><?php _e('Домов Престарелых', 'base'); ?></div>
                <span class="nums-item-val">
                     <div class="wripper-counter">
                        <div class="counter" data-count="<?php echo $count2->found_posts; ?>">0</div>
                    </div>
                </span>
            </div>
        </li>
        <li class="nums-item">
            <span class="nums-item-icon num-item3"></span>
            <div class="nums-item-text">
                <div class="nums-item-title"><?php _e('Патронажных Служб', 'base'); ?></div>
                <span class="nums-item-val">
                     <div class="wripper-counter">
                        <div class="counter" data-count="<?php echo $count3->found_posts; ?>">0</div>
                    </div>
                </span>
            </div>
        </li>
    </ul>
</div>