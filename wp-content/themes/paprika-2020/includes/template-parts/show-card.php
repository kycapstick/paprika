<?php $permalink = get_the_permalink($show->ID); ?>
<a href="<?php echo $permalink?>">
    <div 
        <?php 
            $class_list = array();
            if (!empty($show_details)) {
                foreach($show_details as $details) {
                    $class_list[] = 'schedule__date--' . $details['date'];
                ?>
                    data-<?php echo $details['date'] ?> = "<?php echo $details['time'] ?>"
                    <?php
                }
            }
        ?>
        class="schedule__card <?php echo implode(' ', $class_list); ?>"
    >
        <div class="schedule__card__image">
        <?php  
            $image = get_the_post_thumbnail($show_id, 'schedule-size'); 
            if (!empty($image)) {
                ?>
                    <?php echo $image; ?>
                    <?php
            }
            ?> 
        </div>
        <p class="schedule__time">
            <?php
                if (!empty($show_details)):
                    foreach($show_details as $details):
            ?>
                    <span class="<?php echo 'schedule__date--' . $details['date'] ?>"><?php echo $details['time'] ?></span>
                <?php
                    endforeach;
                endif;
            ?>
        </p>
        <div class="schedule__card__overlay">
            <div class="schedule__card__overlay__title">
                <p class="copy copy--bold"><?php echo $show->post_title ?></p>
                <?php
                    if (!empty($show_details)):
                        foreach($show_details as $details):
                        $title = html_entity_decode(get_the_title($details['date']),ENT_QUOTES,'UTF-8');
                ?>
                    <p><?php echo gmdate('F d', strtotime( $title ) ) . ' @ ' . $details['time'] ?></p>
                <?php
                        endforeach;
                    endif;
                ?>
            </div>
        </div>
    </div>
</a>
