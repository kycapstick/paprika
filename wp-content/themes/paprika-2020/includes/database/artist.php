<?php
  if (!function_exists('paprika_update_artists_with_count')):
    function paprika_update_artists_with_count($artists, $count) {
      $countedArtists = array();
      for ($i = 0; $i < intval($count); $i = $i + 1):
        if (isset($artists[$i])):
          array_push($countedArtists, sanitize_text_field($artists[$i]));
        endif;
      endfor;
      return $countedArtists;
    }
  endif;

  if (!function_exists('paprika_new_artist')):
    function paprika_new_artist($updated_artists, $current_program_artists, $program_id) {
      foreach($updated_artists as $new_artist):
        if (!in_array($new_artist, $current_program_artists)):
          $current_artist_programs = get_post_meta($new_artist, 'artist', true);
          if (is_array($current_artist_programs) && !in_array($program_id, $current_artist_programs)):
            array_push($current_artist_programs, $program_id);  
            update_post_meta($new_artist, 'artist', $current_artist_programs);
          endif;
        endif;
      endforeach;
    }
  endif;

    if (!function_exists('paprika_previous_artist')):
    function paprika_previous_artist($updated_artists, $current_program_artists, $program_id) {
      if (is_array($current_program_artists)):
        foreach($current_program_artists as $previous_artist):
          $current_artist_programs = get_post_meta($previous_artist, 'artist', true);
          if (!in_array($previous_artist, $updated_artists)):
            paprika_remove_artist_program($previous_artist, $program_id);
          elseif (!is_array($current_artist_programs)):
            update_post_meta($previous_artist, 'artist', [$program_id]);
          elseif (!in_array($program_id, $current_artist_programs)):
            $current_artist_programs[] = $program_id;
            update_post_meta($previous_artist, 'artist', $current_artist_programs);
          endif;
        endforeach;
      endif;
    }
  endif;

  if (!function_exists('paprika_remove_artist_program')):
    function paprika_remove_artist_program($artist_id, $program_id) {
      $programs = get_post_meta($artist_id, 'artist', true);
      if (is_array($programs)):
        $index = array_search($program_id, $programs);
        if (isset($programs[$index])):
          unset($programs[$index]);
          update_post_meta($artist_id, 'artist', $programs);
        endif;
      endif;
    }
  endif;

  if (!function_exists('paprika_update_artist_program')):
    function paprika_update_artist_program($updated_artists, $program_id) {
      $current_program_artists = get_post_meta($program_id, 'artists', true);
      paprika_new_artist($updated_artists, $current_program_artists, $program_id);
      paprika_previous_artist($updated_artists, $current_program_artists, $program_id);
      update_post_meta($program_id, 'artists', $updated_artists);
    }
  endif;
