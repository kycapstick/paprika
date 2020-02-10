<?php 
get_header();
?>
<main class="container">
<?php
if ( have_posts() ) : 
    while ( have_posts() ) : the_post(); 
        $festival_id = get_post_meta($post->ID, 'festival', true);
        $festival = get_post($festival_id);
        $time_slots = get_post_meta($post->ID, 'timeSlot', true);
        ?>
        <h1><?php the_title(); ?> </h1>
        <?php 
          if (isset($festival)):
        ?>
        <p>Part of 
          <a href="<?php echo get_post_permalink($festival_id) ?>">
            Festival <?php echo $festival->post_title ?>
          </a>
        </p>
        <?php 
          if (isset($time_slots) && is_array($time_slots)):
        ?>
          <h2>Schedule</h2>
          <?php 
            foreach($time_slots as $time_slot):
          ?>
          <ul>
            <?php if (isset($time_slot['name'])): ?>
            <li class="flex">
              <p class="no-margin"><?php echo $time_slot['name'] ?></p>
              <ul class="grow">
            <?php 
              endif;
              ?>
              <li>
              <ul class="flex no-margin ">

              <?php
              if (isset($time_slot['shows']) && is_array($time_slot['shows'])):
                foreach($time_slot['shows'] as $show_id):
                  $program_id = get_post_meta($show_id, 'program', true);
                  $program_title = str_replace($festival->post_title, '', get_the_title($program_id));
                  $show = get_post($show_id);
                  if (isset($show) && !empty($show)):
            ?>
                      <li class="col-6">
                        <a href="<?php echo get_post_permalink($show_id); ?>">
                          <?php echo $show->post_title ?>
                        </a>
                        
                      </li>
            <?php  
                  endif;
                endforeach;
                ?>
                </ul>
                </li>
                <li>
                  <a href="<?php echo get_post_permalink($program_id) ?>"> 
                    <?php echo $program_title ?>
                  </a>
                </li>
                <?php
              endif;
            ?>
            </ul>
            </li>
          </ul>
          <?php
              endforeach;
          ?>
        <?php 
          endif;
          endif;
        ?>
        <p>
            <?php 
                echo wpautop(the_content());
            ?>
        </p>
        <?php 
    endwhile; 
endif; 
?>
</main>
<?php
get_footer();
?>