<?php 
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