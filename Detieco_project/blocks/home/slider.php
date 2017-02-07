<?php if(have_rows('slider')): ?>
<div class="home-slider-wrap">
    <ul class="home-slider">
        <?php while(have_rows('slider')): the_row(); ?>
        <?php $url = wp_get_attachment_image_url( get_sub_field('image'), 'thumbnail_960x9999'); ?>
        <li class="home-slide" style="background-image: url(<?php echo $url; ?>)">
            <div class="home-slide-content">
                <div class="home-slide-title"><?php the_sub_field('title'); ?></div>
                <div class="home-slide-text">
                    <?php the_sub_field('content'); ?>
                </div>
            </div>
        </li>
        <?php endwhile; ?>
    </ul>
</div>
<?php endif; ?>