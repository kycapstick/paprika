<?php 

  require_once( __DIR__ . '/render/artist-select.php');
  require_once( __DIR__ . '/render/festival-select.php');
  require_once( __DIR__ . '/render/mentor-select.php');

  require_once( __DIR__ . '/index.php');
  require_once( __DIR__ . '/program.php');
  require_once( __DIR__ . '/staff.php');
  require_once( __DIR__ . '/artist.php');
  require_once( __DIR__ . '/festival.php');

  if (!function_exists('paprika_save_post_class_meta')):
    function paprika_save_post_class_meta($post_id, $post) {
      if ($post['post_type'] === 'program') {
        paprika_save_program_meta($post_id, $post);
      } elseif ($post['post_type'] === 'staff') {
        paprika_save_staff_meta($post_id, $_POST);
      } elseif ($post['post_type'] === 'artist') {
        paprika_save_artist_meta($post_id, $_POST);
      } elseif ($post['post_type'] === 'festival') {
        paprika_save_festival_meta($post_id, $_POST);
      }
    }
  endif;

  if (!function_exists('paprika_update_meta_fields')):
    function paprika_update_meta_fields($meta_key, $new_meta_value, $post_id) {
      $meta_value = get_post_meta($post_id, $meta_key, true);
      if ($meta_value === $new_meta_value) {
        return $post_id;
      }
      if (strlen($meta_value) > 0) {
        update_post_meta($post_id, $meta_key, $new_meta_value);
      } else {
        add_post_meta($post_id, $meta_key, $new_meta_value, true);
      }
    }
  endif;

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

  if (!function_exists('paprika_update_mentors_with_count')):
    function paprika_update_mentors_with_count($mentors, $count) {
      $countedMentors = array();
      for ($i = 0; $i < intval($count); $i = $i + 1):
        if (isset($mentors[$i])):
          array_push($countedMentors, sanitize_text_field($mentors[$i]));
        endif;
      endfor;
      return $countedMentors;
    }
  endif;

  if (!function_exists('paprika_remove_mentor_program')):
    function paprika_remove_mentor_program($mentor_id, $program_id) {
      $programs = get_post_meta($mentor_id, 'mentor', true);
      $index = array_search($program_id, $programs);
      unset($programs[$index]);
      update_post_meta($mentor_id, 'mentor', $programs);
      paprika_console_log(get_post_meta($mentor_id, 'mentor', true));
    }
  endif;

  if (!function_exists('paprika_new_mentor')):
    function paprika_new_mentor($updated_mentors, $current_program_mentors, $program_id) {
      foreach($updated_mentors as $new_mentor):
        if (!in_array($new_mentor, $current_program_mentors)):
          $current_mentor_programs = get_post_meta($new_mentor, 'mentor', true);
          if (!in_array($program_id, $current_mentor_programs)):
            array_push($current_mentor_programs, $program_id);  
            update_post_meta($new_mentor, 'mentor', $current_mentor_programs);
          endif;
        endif;
      endforeach;
    }
  endif;

  if (!function_exists('paprika_previous_mentor')):
    function paprika_previous_mentor($updated_mentors, $current_program_mentors, $program_id) {
      if (is_array($current_program_mentors)):
        foreach($current_program_mentors as $previous_mentor):
          if (!in_array($previous_mentor, $updated_mentors)):
            paprika_remove_mentor_program($previous_mentor, $program_id);
          endif;
        endforeach;
      endif;
    }
  endif;

  if (!function_exists('paprika_update_mentor_program')):
    function paprika_update_mentor_program($updated_mentors, $program_id) {
      $current_program_mentors = get_post_meta($program_id, 'mentors', true);
      paprika_new_mentor($updated_mentors, $current_program_mentors, $program_id);
      paprika_previous_mentor($updated_mentors, $current_program_mentors, $program_id);
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
    function paprika_update_artist_program($updatedArtists, $program_id) {
      $currentProgramArtists = get_post_meta($program_id, 'artists', true);
      if (is_array($currentProgramArtists)):
        foreach($updatedArtists as $newArtist):
          if (!in_array($newArtist, $currentProgramArtists)):
            $currentArtistPrograms = get_post_meta($newArtist, 'artist', true);
            if (!in_array($program_id, $currentArtistPrograms)):
              array_push($currentArtistPrograms, $program_id);  
              update_post_meta($newArtist, 'artist', $currentArtistPrograms);
            endif;
          endif;
        endforeach;
        foreach($currentProgramArtists as $previousArtist):
          if (!in_array($previousArtist, $updatedArtists)):
              paprika_remove_artist_program($previousArtist, $program_id);
          endif;
        endforeach;
      endif;
    }
  endif;

  add_action( 'pre_post_update', 'paprika_save_post_class_meta', 10, 2 );
