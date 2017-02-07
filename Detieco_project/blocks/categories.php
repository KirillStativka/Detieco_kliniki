<?php
$args = array(
    'orderby'    => 'count',
    'hide_empty' => 0
);
$categories = get_terms( 'category', $args );
?>
<?php if($categories):  //print_r($categories);?>
    <ul class="categories">
        <?php foreach($categories as $cat): ?>
            <li class="categories-item<?php echo (get_query_var('category_name') == $cat->slug && !is_404()) ? ' active"' : ''; ?>">
                <a href="<?php echo get_term_link($cat->term_id, $cat->taxonomy); ?>" class="categories-item-wrap">
                    <span class="categories-item-icon">
                        <?php $image = get_field('image', $cat);
                        if($image): ?>
                            <span class="icon" style="background: url(<?php echo wp_get_attachment_image_url($image, 'thumbnail_58x58'); ?>) no-repeat;"></span>
                        <?php endif; ?>
                    </span>
                    <span class="categories-item-title">
                        <?php echo $cat->name; ?>
                    </span>
                </a>
            </li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>