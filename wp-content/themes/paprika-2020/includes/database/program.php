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

  if (!function_exists('paprika_add_program_category')):
    function paprika_add_program_category($post_id) {
      $taxonomy = 'category';
      $parent_id = get_cat_id('Program');
      if ($parent_id === 0):
        $parent_id = wp_insert_term('Program', $taxonomy);
        $parent_id = $parent_id['term_id'];
      endif;
      wp_set_post_categories($post_id, $parent_id, $taxonomy, true);
      $program_id = get_post_meta($post_id, 'program', true);
      $program = get_post($program_id);
      $category_id = get_cat_id($program->post_title);
      if ($category_id === 0):
        $category_id = wp_insert_term($program->post_title, $taxonomy, array('parent' => $parent_id));
      endif;
      wp_set_post_categories($post_id, $category_id, $taxonomy, true);
    }
  endif;

  if (!function_exists('paprika_save_program_categories')):
    function paprika_save_program_categories($post_id) {
      paprika_add_festival_category($post_id);
    }
  endif;