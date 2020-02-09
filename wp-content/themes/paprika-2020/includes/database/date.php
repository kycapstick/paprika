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

  if (!function_exists('paprika_search_nested_array')):
    function paprika_search_nested_array($array, $value) {
      $index;
      foreach($array as $array_index=>$nested_array):
        if (is_array($nested_array)):
          $found = array_search($value, $nested_array);
          if ($found):
            return $array_index;
          endif;
        endif;
      endforeach;
    }
  endif;

  if (!function_exists('paprika_remove_timeslot_show')):
    function paprika_remove_timeslot_show($time_slot, $date_id, $post_id) {

      if (isset($time_slot['shows']) && is_array($time_slot['shows'])):

        $index = array_search($post_id, $time_slot['shows']);
        if (isset($index) && intval($index) > 0):
          unset($time_slot['shows'][$index]);
          $current_date_shows = get_post_meta($date_id, 'timeSlot', true);
          $time_slot_index = paprika_search_nested_array($current_date_shows, $time_slot['name']);
          if (isset($time_slot_index)):
            $current_date_shows[$time_slot_index] = $time_slot;
            update_post_meta($date_id, 'timeSlot', $current_date_shows);
          endif;
        endif;
      endif;
    }
  endif;

  if (!function_exists('paprika_save_date_categories')):
    function paprika_save_date_categories($post_id) {
      paprika_add_festival_category($post_id);
    }
  endif;
