<?php 

  require_once( __DIR__ . '/render/artist-select.php');
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

  if (!function_exists('paprika_remove_mentor_program')):
    function paprika_remove_mentor_program($mentor_id, $program_id) {
      $programs = get_post_meta($mentor_id, 'mentor', true);
      if (is_array($programs)):
        $index = array_search($program_id, $programs);
        unset($programs[$index]);
        update_post_meta($mentor_id, 'mentor', $programs);
      endif;
    }
  endif;

  if (!function_exists('paprika_update_mentor_program')):
    function paprika_update_mentor_program($mentor_id, $program_id) {
      $currentProgramMentor = get_post_meta($program_id, 'mentor', true);
      if (intval($currentProgramMentor) !== intval($mentor_id)):
        paprika_remove_mentor_program($currentProgramMentor, $program_id);
        $currentMentorPrograms = get_post_meta($mentor_id, 'mentor', true);
        if (!in_array($program_id, $currentMentorPrograms)):
          array_push($currentMentorPrograms, $program_id);  
          update_post_meta($mentor_id, 'mentor', $currentMentorPrograms);
        endif;
      endif;  
    }
  endif;

  if (!function_exists('paprika_remove_artist_program')):
    function paprika_remove_artist_program($artist_id, $program_id) {
      $programs = get_post_meta($artist_id, 'artist', true);
      $index = array_search($program_id, $programs);
      unset($programs[$index]);
      update_post_meta($artist_id, 'artist', $programs);
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
