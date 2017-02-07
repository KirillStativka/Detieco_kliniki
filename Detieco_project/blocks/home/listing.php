<div class="alphabet">
    <?php
    $args = array(
        'post_type' => 'cities_pansionat',
        'posts_per_page' => -1,
        'orderby' => 'title',
        'order' => 'ASC',
    );
    $query = new WP_Query($args);
    $posts = $query->get_posts();

    foreach($posts as $post) {
        $first_letter = mb_strtoupper( mb_substr($post->post_title, 0, 1) );
        $groups[$first_letter][$post->post_name]['name'] = $post->post_title;
        $groups[$first_letter][$post->post_name]['link'] = get_permalink($post->ID);
    }
    $count = ceil(count($groups) / 3);
    $columns = array_chunk($groups, $count, true);
    
    ?>
    <!-- <?php print_r($count); ?>-->
    <?php foreach($columns as $column): ?>
    <div class="alphabet-column">
        <?php foreach($column as $key => $group): ?>
        <div class="alphabet-item">
            <div class="alphabet-letter"><?php echo $key; ?></div>
            <ul class="alphabet-list">
                <?php foreach($group as $city): ?>
                <li><a href="<?php echo $city['link']; ?>"><?php echo $city['name']; ?></a></li>
                <?php endforeach; ?>
            </ul>
        </div>
        <?php endforeach; ?>
    </div>
    <?php endforeach; ?>
</div>
<?php wp_reset_query(); ?>