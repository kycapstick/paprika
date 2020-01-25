<?php 
  if (!function_exists('paprika_new_program')):
    function paprika_new_program($program_id, $current_festival_programs, $festival_id) {
      if (!is_array($current_festival_programs)):
        update_post_meta($festival_id, 'programs', [$program_id]);
      elseif (!in_array($festival_id, $current_festival_programs)):
        $current_festival_programs[] = $festival_id;
        update_post_meta($festival_id, 'programs', $current_festival_programs);
      endif;
    }
  endif;

  if (!function_exists('paprika_previous_program')):
    function paprika_previous_program($program_id, $previous_festival) {
      $previous_festival_programs = get_post_meta($previous_festival, 'programs', true);
      if (is_array($previous_festival_programs) && in_array($program_id, $previous_festival_programs)):
        $index = array_search($program_id, $previous_festival_programs);
        unset($previous_festival_programs[$index]);
        update_post_meta($previous_festival, 'programs', $previous_festival_programs);
      endif;
    }
  endif;

  if (!function_exists('paprika_remove_program_festival')):
    function paprika_remove_program_festival($program_id, $festival_id) {
      $current_program_festival = get_post_meta($program_id, 'festival', true);
      if (intval($current_program_festival) === intval($festival_id)):
        update_post_meta($program_id, 'festival', '');
      endif;
    }
  endif;

  if (!function_exists('paprika_update_festival_program')):
    function paprika_update_festival_program($program_id, $festival_id, $previous_festival) {
      $current_festival_programs = get_post_meta($festival_id, 'programs', true);
      paprika_new_program($program_id, $current_festival_programs, $festival_id);
      paprika_previous_program($program_id, $previous_festival);
      update_post_meta($program_id, 'festival', $festival_id);
    }
  endif;

  if (!function_exists('paprika_remove_festival_relations')):
    function paprika_remove_festival_relations($post_id) {
      $current_festival_programs = get_post_meta($post_id, 'programs', true);
      if (is_array($current_festival_programs)):
        foreach ($current_festival_programs as $current_program):
          paprika_remove_program_festival($current_program, $post_id);
        endforeach;
      endif;
    }
  endif;