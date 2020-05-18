<?php 

if (!function_exists('paprika_update_count')):
  function paprika_update_count() {
    if ( !wp_verify_nonce( $_REQUEST['nonce'], "update_count_nonce")) {
      exit("No naughty business please");
    }
    if (
      paprika_is_valid('number', $_REQUEST['post_id']) 
      && paprika_is_valid('number', $_REQUEST['count']) 
      && paprika_is_valid('string', $_REQUEST['selector'])
    ):
      update_post_meta($_REQUEST['post_id'], $_REQUEST['selector'], $_REQUEST['count']);
      wp_send_json(array('status' => 'success'));
    endif;
  }
endif;

add_action("wp_ajax_update_count", "paprika_update_count");


if (!function_exists('paprika_update_value')):
  function paprika_update_value() {
    if ( !wp_verify_nonce( $_REQUEST['nonce'], "update_value_nonce")) {
      exit("No naughty business please");
    }
    if (
      paprika_is_valid('number', $_REQUEST['post_id']) 
      && paprika_is_valid('string', $_REQUEST['value']) 
      && paprika_is_valid('string', $_REQUEST['selector'])
    ):
      update_post_meta($_REQUEST['post_id'], $_REQUEST['selector'], $_REQUEST['value']);
      wp_send_json(array('status' => 'success'));
    endif;
  }
endif;

add_action("wp_ajax_update_value", "paprika_update_value");

if (!function_exists('paprika_update_array')):
  function paprika_update_array() {
    if ( !wp_verify_nonce( $_REQUEST['nonce'], "update_array_nonce")) {
      exit("No naughty business please");
    }
    if (
      isset($_REQUEST['post_id']) 
      && isset($_REQUEST['value']) 
      && isset($_REQUEST['selector'])
    ):
      if ($_REQUEST['type'] === 'program'):
        if ($_REQUEST['selector'] === 'artists'):
          $artists = paprika_update_artists_with_count($_REQUEST['value'], $_REQUEST['count']);
          $artists = array_unique($artists);
          paprika_update_artist_program($artists, $_REQUEST['post_id']);
          wp_send_json(array('status' => 'success'));
        endif;
        if ($_REQUEST['selector'] === 'mentors'):
          $mentors = paprika_update_mentors_with_count($_REQUEST['value'], $_REQUEST['count']);
          $mentors = array_unique($mentors);
          paprika_update_mentor_program($mentors, $_REQUEST['post_id']);
          update_post_meta($_REQUEST['post_id'], 'mentors', $mentors);
          wp_send_json(array('status' => 'success'));
        endif;
      endif;
      if ($_REQUEST['type'] === 'show'):
        if ($_REQUEST['selector'] === 'artists'):
          $artists = paprika_update_artists_with_count($_REQUEST['value'], $_REQUEST['count']);
          $artists = array_unique($artists);
          paprika_update_artist_show($artists, $_REQUEST['post_id']);
          wp_send_json(array('status' => 'success'));
        endif;
      endif;
    endif;
    if ($_REQUEST['type'] === 'date'):
      $sanitized_time_slots = array();
        foreach($_REQUEST['value'] as $index => $time_slot):
          $sanitized_time_slots[$index]['name'] = sanitize_text_field($time_slot['name']);
          $sanitized_time_slots[$index]['showCount'] = sanitize_text_field($time_slot['showCount']);
          $sanitized_time_slots[$index]['shows'] = $time_slot['shows'];
        endforeach;
        paprika_save_show_timeslots($_REQUEST['post_id'], $sanitized_time_slots);
        update_post_meta($_REQUEST['post_id'], 'timeSlot', $sanitized_time_slots);
        wp_send_json(array('status' => 'success'));
    endif;
    if ($_REQUEST['type'] === 'festival'):
      $dates = paprika_update_dates_with_count($_REQUEST['value'], $_REQUEST['count']);
      $dates = array_unique($dates);
      update_post_meta($_REQUEST['post_id'], 'dates', $dates);
      wp_send_json(array('status' => 'success'));
    endif;
  }
endif;

add_action("wp_ajax_update_array", "paprika_update_array");