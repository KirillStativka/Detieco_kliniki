<div class="text wide">
    <?php $images = get_field('gallery');
    if( $images ): ?>
    <div class="house-slider-wrap">
        <div class="house-slider-images">
            <ul class="house-slider">
                <?php $i = 1; foreach( array_chunk($images, 6, true) as $image ): ?>
                <li class="house-slider-item">
                    <?php $a = 1; foreach($image as $kicks) : ?>
                        <div class="house-slider-image<?php echo ($i == 1 && $a == 1) ? ' active' : ''; ?>">
                            <a href="<?php echo $kicks['sizes']['thumbnail_403x297']; ?>">
                                <img src="<?php echo $kicks['sizes']['thumbnail_85x85']; ?>" alt="<?php echo $kicks['alt']; ?>" class="cover" />
                            </a>
                        </div>
                    <?php $a++; endforeach; ?>
                </li>
                <?php $i++; endforeach; ?>
            </ul>
        </div>
        <div class="house-slider-big">
            <img src="<?php echo $images[0]['sizes']['thumbnail_403x297']; ?>" alt="<?php echo $images[0]['alt']; ?>" class="cover" />
        </div>
    </div>
    <?php endif; ?>
    <h2><?php _e('Описание учреждения «' . get_the_title() . '»', 'base'); ?></h2>
    <ul class="links no-bullet">

    </ul>
</div>