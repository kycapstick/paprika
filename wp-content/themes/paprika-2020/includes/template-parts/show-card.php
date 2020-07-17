<?php $permalink = get_the_permalink($show->ID); ?>
<a href="<?php echo $permalink?>">
    <div 
        <?php 
            $class_list = array();

            if (!empty($show_details)) {
                foreach($show_details as $details) {
                    $class_list[] = 'schedule__date--' . $details['date'];
                    if ($details['date'] === $first_date) {
                        $class_list[] = 'schedule__active';
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
                    <span class="<?php echo $details['date'] === $first_date ? 'schedule__active' : null ?> <?php echo 'schedule__date--' . $details['date'] ?>"><?php echo $details['time'] ?></span>
                <?php
                    endforeach;
                endif;
            ?>
        </p>
        <div class="schedule__card__overlay">
            <div class="schedule__card__overlay__title">
                <p class="copy--medium"><?php echo $show->post_title ?></p>
                <?php
                    if (!empty($show_details)):
                        foreach($show_details as $details):
                ?>
                    <p><?php echo gmdate('F d', strtotime( get_the_title( $details['date'] ) ) ) . ' @ ' . $details['time'] ?></p>
                <?php
                        endforeach;
                    endif;
                ?>
            </div>
        </div>
    </div>
</a>
