<?php 
if (!function_exists('paprika_new_program')):
    function paprika_new_program($program_id, $current_festival_programs, $festival_id) {
		if (!is_array($current_festival_programs)):
			$current_festival_programs = array($program_id);
			update_post_meta($festival_id, 'programs', $current_festival_programs);
		elseif (!in_array($program_id, $current_festival_programs)):
			array_push($current_festival_programs, $program_id);
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
		if (isset($previous_festival) && intval($festival_id) !== intval($previous_festival)) {
			paprika_previous_program($program_id, $previous_festival);
		}
		paprika_new_program($program_id, $current_festival_programs, $festival_id);
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

if (!function_exists('paprika_get_program_artists')):
    function paprika_get_program_artists($program_id) {
		$artists = get_post_meta($program_id, 'artists', true);
		return $artists;
	}
endif;

if (!function_exists('paprika_get_program_mentors')):
    function paprika_get_program_mentors($program_id) {
		$mentors = get_post_meta($program_id, 'mentors', true);
		return $mentors;
	}
endif;

if (!function_exists('paprika_add_festival_category')):
    function paprika_add_festival_category($post_id) {
		$taxonomy = 'category';
		$parent_id = get_cat_id('Festival');
		if ($parent_id === 0):
			$parent_id = wp_insert_term('Festival', $taxonomy);
			$parent_id = $parent_id['term_id'];
		endif;
		wp_set_post_categories($post_id, $parent_id, $taxonomy, true);
		$festival_id = get_post_meta($post_id, 'festival', true);
		$festival = get_post($festival_id);
		$category_id = get_cat_id($festival->post_title);
		if ($category_id === 0):
			$category_id = wp_insert_term($festival->post_title, $taxonomy, array('parent' => $parent_id));
		endif;
		wp_set_post_categories($post_id, $category_id, $taxonomy, true);
    }
endif;