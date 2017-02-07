<?php
$_recent_posts = get_sub_field('recent_posts');

if($_recent_posts): ?>
<div class="cat-wrap">
    <?php foreach($_recent_posts as $recent_post): ?>
    <div class="cat-block">
        <div class="cat-title">
            <?php $image = get_field('image', $recent_post);
            if($image): ?>
                <span class="icon" style="background: url(<?php echo wp_get_attachment_image_url($image, 'thumbnail_58x58'); ?>) no-repeat;"></span>
            <?php endif; ?>
            <?php echo $recent_post->name; ?>
        </div>
        <?php $args = array(
            'cat' => $recent_post->term_id,
            'posts_per_page' => 4
        );
        $posts = new WP_Query($args);
        if($posts->have_posts()): ?>
        <div class="cat-block-content">
            <?php while($posts->have_posts()): $posts->the_post(); ?>
            <div class="cat-block-left">
                <?php $image = wp_get_attachment_image( get_post_thumbnail_id($posts->post->ID), 'thumbnail_347x225', false, array( 'class' => 'cover' ) ); ?>
                <div class="cat-block-left-image">
                    <?php echo $image; ?>
                    <a href="<?php the_permalink(); ?>"></a>
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
                <?php while($posts->have_posts()): $posts->the_post(); ?>
                <div class="cat-block-item">
                    <a href="<?php the_permalink(); ?>" class="cat-block-item-wrap">
                        <?php $image = wp_get_attachment_image( get_post_thumbnail_id($posts->post->ID), 'thumbnail_74x74', false, array( 'class' => 'cover' ) ); ?>
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
        <?php endif; ?>
    </div>
    <?php endforeach; ?>
</div>
<?php endif; wp_reset_query(); ?>