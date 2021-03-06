<?php 
  if (!function_exists('paprika_new_show')):
    function paprika_new_show($updated_artists, $current_show_artists, $show_id) {
      foreach($updated_artists as $new_artist):
        if (is_array($current_show_artists) && !in_array($new_artist, $current_show_artists)):
          $current_artist_shows = get_post_meta($new_artist, 'show', true);
          if (!is_array($current_artist_shows)):
            update_post_meta($new_artist, 'show', [$show_id]);
          elseif (!in_array($show_id, $current_artist_shows)):
            array_push($current_artist_shows, $show_id);  
            update_post_meta($new_artist, 'show', $current_artist_shows);
          endif;
        endif;
      endforeach;
    }
  endif;

  if (!function_exists('paprika_previous_show')):
    function paprika_previous_show($updated_artists, $current_show_artists, $show_id) {
      if (is_array($current_show_artists)):
        foreach($current_show_artists as $previous_artist):
          $current_artist_shows = get_post_meta($previous_artist, 'show', true);
          if (!in_array($previous_artist, $updated_artists)):
            paprika_remove_artist_show($previous_artist, $show_id);
          elseif (!is_array($current_artist_shows)):
            update_post_meta($previous_artist, 'show', [$show_id]);
          elseif (!in_array($show_id, $current_artist_shows)):
            $current_artist_shows[] = $show_id;
            update_post_meta($previous_artist, 'show', $current_artist_shows);
          endif;
        endforeach;
      endif;
    }
  endif;

  if (!function_exists('paprika_remove_artist_show')):
    function paprika_remove_artist_show($artist_id, $show_id) {
      $shows = get_post_meta($artist_id, 'show', true);
      if (is_array($shows)):
        $index = array_search($show_id, $shows);
        if (isset($shows[$index])):
          unset($shows[$index]);
          update_post_meta($artist_id, 'show', $shows);
        endif;
      endif;
    }
  endif;

  if (!function_exists('paprika_update_artist_show')):
    function paprika_update_artist_show($updated_artists, $show_id) {
      $current_show_artists = get_post_meta($show_id, 'artists', true);
      paprika_new_show($updated_artists, $current_show_artists, $show_id);
      paprika_previous_show($updated_artists, $current_show_artists, $show_id);
      update_post_meta($show_id, 'artists', $updated_artists);
    }
  endif;

  if (!function_exists('paprika_remove_show_relations')):
    function paprika_remove_show_relations($post_id) {
      $current_show_artists = get_post_meta($post_id, 'artists', true);
      if (isset($current_show_artists) && is_array($current_show_artists)):
        // paprika_console_log('runnning');
        foreach ($current_show_artists as $current_artist):
          paprika_remove_artist_show($current_artist, $post_id);
        endforeach;
      endif;
      $current_show_timeslots = get_post_meta($post_id, 'timeSlots', true);
      if (isset($current_show_timeslots) && is_array($current_show_timeslots)):
        foreach($current_show_timeslots as $date_id => $time_slot):
          paprika_remove_timeslot_show($time_slot, $date_id, $post_id);
        endforeach;
      endif;


    }
  endif;

  if (!function_exists('paprika_save_show_categories')):
    function paprika_save_show_categories($post_id) {
      paprika_add_festival_category($post_id);
      paprika_add_program_category($post_id);
    }
  endif;

  