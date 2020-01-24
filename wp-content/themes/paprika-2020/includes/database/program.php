<?php 

  if (!function_exists('paprika_remove_program_mentor')):
    function paprika_remove_program_mentor($program_id, $mentor_id) {
      $mentors = get_post_meta($program_id, 'mentors', true);
      if (is_array($mentors)):
        $index = array_search($mentor_id, $mentors);
        if (isset($mentors[$index])):
          unset($mentors[$index]);
          update_post_meta($program_id, 'mentors', $mentors);
        endif;
      endif;
    }
  endif;

  if (!function_exists('paprika_remove_program_artist')):
    function paprika_remove_program_artist($program_id, $artist_id) {
      $artists = get_post_meta($program_id, 'artists', true);
      if (is_array($artists)):
        $index = array_search($artist_id, $artists);
        if (isset($artists[$index])):
          unset($artists[$index]);
          update_post_meta($program_id, 'artists', $artists);
        endif;
      endif;
    }
  endif;

  if (!function_exists('paprika_remove_program_relations')):
    function paprika_remove_program_relations($post_id) {
      $current_program_artists = get_post_meta($post_id, 'artists', true);
      $current_program_mentors = get_post_meta($post_id, 'mentors', true);
      if (is_array($current_program_artists)):
        foreach ($current_program_artists as $current_artist):
          paprika_remove_artist_program($current_artist, $post_id);
        endforeach;
      endif;
      if (is_array($current_program_mentors)):
        foreach ($current_program_mentors as $current_mentor):
          paprika_remove_mentor_program($current_mentor, $post_id);
        endforeach;
      endif;
    }
  endif;