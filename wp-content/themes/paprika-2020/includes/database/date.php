<?php
  if (!function_exists('paprika_update_dates_with_count')):
    function paprika_update_dates_with_count($dates, $count) {
      $countedDates = array();
      for ($i = 0; $i < intval($count); $i = $i + 1):
        if (isset($dates[$i])):
          array_push($countedDates, sanitize_text_field($dates[$i]));
        endif;
      endfor;
      return $countedDates;
    }
  endif;

  if (!function_exists('paprika_new_show_timeslot')):
    function paprika_new_show_timeslot($time_slot, $show_id, $date_id) {
      $time_slots = get_post_meta($show_id, 'timeSlots', true);
      if (!isset($time_slots) || !is_array($time_slots)):
        update_post_meta($show_id, 'timeSlots', array($date_id => $time_slot));
      elseif (is_array($time_slots) && !in_array($show_id, $time_slots)):
        $time_slots[$date_id] = $time_slot;
        update_post_meta($show_id, 'timeSlots', $time_slots);
      endif;
    }
  endif;

  if (!function_exists('handle_new_timeslot')):
    function handle_new_timeslot($time_slots, $post_id) {
        foreach($time_slots as $time_slot):
        if (isset($time_slot['shows']) && is_array($time_slot['shows'])):
          foreach($time_slot['shows'] as $show_id):
            paprika_new_show_timeslot($time_slot, $show_id, $post_id);
            $show_ids[] = $show_id;
          endforeach;
        endif;
      endforeach;
    }
  endif;

  if (!function_exists('paprika_previous_show_timeslot')):
    function paprika_previous_show_timeslot($date_id, $old_time_slots, $time_slots) {
      foreach($old_time_slots as $time_slot):
        foreach($time_slot['shows'] as $show_id):
          $show_dates = get_post_meta($show_id, 'timeSlots', true);
          if (isset($show_dates) && is_array($show_dates) && isset($show_dates[$date_id])):
            unset($show_dates[$date_id]);
            update_post_meta($show_id, 'timeSlots', $show_dates);
          endif;
        endforeach;
      endforeach;
      handle_new_timeslot($time_slots, $date_id);
    }
  endif;

  if (!function_exists('paprika_save_show_timeslots')):
    function paprika_save_show_timeslots($post_id, $time_slots) {
      $old_time_slots = get_post_meta($post_id, 'timeSlot', true);
      paprika_previous_show_timeslot($post_id, $old_time_slots, $time_slots);
    }
  endif;

  if (!function_exists('paprika_save_date_categories')):
    function paprika_save_date_categories($post_id) {
      paprika_add_festival_category($post_id);
    }
  endif;
