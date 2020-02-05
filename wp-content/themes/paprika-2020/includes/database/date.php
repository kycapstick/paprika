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

  if (!function_exists('paprika_save_date_categories')):
    function paprika_save_date_categories($post_id) {
      paprika_add_festival_category($post_id);
    }
  endif;
