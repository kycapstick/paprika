<?php $permalink = get_the_permalink($show->ID); ?>
<a href="<?php echo $permalink?>">
    <div 
        <?php 
            $class_list = array();

            if (!empty($show_details)) {
                foreach($show_details as $details) {
                    $class_list[] = 'schedule__date--' . $details['date'];
                    if ($details['date'] === $first_date) {
                        $class_list[] = 'active';
                    }
                ?>
                    data-<?php echo $details['date'] ?> = "<?php echo $details['time'] ?>"
                    <?php
                }
            }
        ?>
        class="schedule__card <?php echo implode(' ', $class_list); ?>"
        <?php  
            $image = get_the_post_thumbnail_url($show_id); 
            if (!empty($image)) {
                ?>
                style="background-image: url(<?php echo $image; ?>)"
                <?php
            }
        ?> 
    >
        <p class="schedule__time">
            <?php
                if (!empty($show_details)):
                    foreach($show_details as $details):
            ?>
                    <span class="<?php echo $details['date'] === $first_date ? 'active' : null ?>"><?php echo $details['time'] ?></span>
                <?php
                    endforeach;
                endif;
            ?>
        </p>
        <div class="schedule__card__overlay">
            <p class="schedule__card__overlay__title"><?php echo $show->post_title ?></p>
        </div>
    </div>
</a>
