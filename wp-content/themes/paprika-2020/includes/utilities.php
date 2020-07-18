<?php 

if (!function_exists('pg_get_attributes')) {
    function pg_get_attributes($block, $fields) {
        $attributes = new stdClass();
        foreach ($fields as $field):
            if (isset($block['attrs'][$field])):
                $attributes->$field = $block['attrs'][$field];
            else: 
                $attributes->$field = '';
            endif;
        endforeach;
        return $attributes;
    }
}

if (!function_exists('pg_is_valid')) {
    function pg_is_valid($type, $variable) {
        $isValid = false;
        switch($type) {
            case ('string'):
                if (isset($variable) && strlen($variable) > 0) {
                    $isValid = true;
                }
            break;
            case ('array'):
                if (isset($variable) && is_array($variable) && count($variable) > 0) {
                    $isValid = true;
                }
            break;
            case ('object'):
                if (isset($variable) && is_object($variable)) {
                    $isValid = true;
                }
            break;
            case ('url'):
                if (isset($variable) && filter_var($variable, FILTER_VALIDATE_URL)) {
                    $isValid = true;
                }
            break;
            default: 
                error_log(print_r('Need to provide valid type to test', 1));
            break;
        }
        return $isValid;
    }
}

if (!function_exists('paprika_parse_content')) {
    function paprika_parse_content($content) {
        if (has_blocks($content)):
            $blocks = parse_blocks($content);
            $content = '';
            foreach($blocks as $block) {
                if ($block['blockName'] === 'core/paragraph') {
                    $content = $block['innerHTML'];
                    break;
                }
            }
        endif;
        return $content;
    }

}

if (!function_exists('paprika_custom_colors')) {
    function paprika_custom_colors() {
        $parent_page = paprika_get_page_parent();
        $slugs = array(
            'press',
            'support',
            'festivals',
        );
        $singles = array(
            'festival',
            'show',
            'program',
        );
        foreach ($slugs as $slug) {
            $page = get_page_by_path($slug);
            if (is_page($slug) || (isset($page) && intval($parent_page) === intval($page->ID))) {
                return 'page-' . $slug;
            }
        }
        foreach($singles as $single) {
            if (is_singular($single)) {
                // return 'page-support';
                return 'page-festivals';
            }
        }
        if (is_post_type_archive('festival')) {
            return 'page-festivals';
        }
        return 'unset';
    }
}

if (!function_exists('paprika_get_page_parent')) {
    function paprika_get_page_parent() { 
        global $post; 
        if (empty($post)) {
            return;
        }
        $ancestors = get_post_ancestors($post);
        if (!empty($ancestors)) { 
            $index = intval(count($ancestors)) - 1;
            return $ancestors[$index]; 
        } else { 
            return $post->ID; 
        } 
    }
}

if (!function_exists('paprika_get_shows_with_dates')) {
    function paprika_get_shows_with_dates($time_slots, $shows, $date) {
        if (!empty($time_slots)) {
            foreach ($time_slots as $time_slot) {
                if (isset($time_slot['shows']) && !empty($time_slot['shows'])) {
                    foreach ($time_slot['shows'] as $show) {
                        if (!isset($shows[$show])) {
                            $shows[$show] = array();
                        }
                        $show_details = array(
                            'date' => $date,
                            'time' => $time_slot['name'],
                        );
                        if (!in_array($date, $shows[$show])) {
                            array_push($shows[$show], $show_details);
                        }
                    }
                }
            }
        }
        return $shows;
    }
}

if (!function_exists('paprika_get_shows_by_dates')) {
    function paprika_get_shows_by_dates($dates) {
        if (empty($dates)) {
            return;
        }
        $shows = array();
        foreach ($dates as $date_id) {
            $time_slots = get_post_meta($date_id, 'timeSlot', true);
            $shows = paprika_get_shows_with_dates($time_slots, $shows, $date_id);
        }           
        return $shows;
    }
}

function paprika_add_menu_item() {
	add_menu_page( 'Paprika Settings', 'Paprika Settings', 'manage_options', 'theme-panel', 'paprika_theme_settings', null, 99 );
}

function paprika_theme_settings() {
	$theme_dir = get_template_directory();

	if ( current_user_can( 'manage_options' ) && ! empty( $_SERVER['REQUEST_METHOD'] ) && 'POST' === $_SERVER['REQUEST_METHOD'] ) {
		if ( isset( $_POST['admin_nonce_field'] ) ) {
			$nonce = trim( sanitize_text_field( wp_unslash( $_POST['admin_nonce_field'] ) ) );

			if ( wp_verify_nonce( $nonce, 'admin_nonce' ) ) {

				if ( isset( $_POST['github_link'] ) ) {
					$github_link = sanitize_text_field( wp_unslash( $_POST['github_link'] ) );
					update_option( 'github_link', $github_link );
				}

				if ( isset( $_POST['community_discourse'] ) ) {
					$community_discourse = sanitize_text_field( wp_unslash( $_POST['community_discourse'] ) );
					update_option( 'community_discourse', $community_discourse );
				}

				if ( isset( $_POST['google_analytics_id'] ) ) {
					$google_analytics_id = sanitize_text_field( wp_unslash( $_POST['google_analytics_id'] ) );
					update_option( 'google_analytics_id', $google_analytics_id );
				}

				if ( isset( $_POST['google_analytics_sri'] ) ) {
					$google_analytics_sri = sanitize_text_field( wp_unslash( $_POST['google_analytics_sri'] ) );
					update_option( 'google_analytics_sri', $google_analytics_sri );
				}

				if ( isset( $_POST['default_open_graph_title'] ) ) {
					$default_open_graph_title = sanitize_text_field( wp_unslash( $_POST['default_open_graph_title'] ) );
					update_option( 'default_open_graph_title', $default_open_graph_title );
				}

				if ( isset( $_POST['default_open_graph_desc'] ) ) {
					$default_open_graph_desc = sanitize_text_field( wp_unslash( $_POST['default_open_graph_desc'] ) );
					update_option( 'default_open_graph_desc', $default_open_graph_desc );
				}

				if ( isset( $_POST['image_max_filesize'] ) ) {
					$image_max_filesize = sanitize_text_field( wp_unslash( $_POST['image_max_filesize'] ) );
					update_option( 'image_max_filesize', intval( $image_max_filesize ) );
				}

				if ( isset( $_POST['error_404_title'] ) ) {
					$error_404_title = sanitize_text_field( wp_unslash( $_POST['error_404_title'] ) );
					update_option( 'error_404_title', $error_404_title );
				}

				if ( isset( $_POST['error_404_copy'] ) ) {
					$error_404_copy = sanitize_text_field( wp_unslash( $_POST['error_404_copy'] ) );
					update_option( 'error_404_copy', $error_404_copy );
				}

				if ( isset( $_POST['discourse_api_key'] ) ) {
					$discourse_api_key = sanitize_text_field( wp_unslash( $_POST['discourse_api_key'] ) );
					update_option( 'discourse_api_key', $discourse_api_key );
				}

				if ( isset( $_POST['discourse_api_url'] ) ) {
					$discourse_api_url = sanitize_text_field( wp_unslash( $_POST['discourse_api_url'] ) );
					update_option( 'discourse_api_url', $discourse_api_url );
				}

				if ( isset( $_POST['discourse_url'] ) ) {
					$discourse_url = sanitize_text_field( wp_unslash( $_POST['discourse_url'] ) );
					update_option( 'discourse_url', $discourse_url );
				}

				if ( isset( $_POST['mapbox'] ) ) {
					$mapbox = sanitize_text_field( wp_unslash( $_POST['mapbox'] ) );
					update_option( 'mapbox', $mapbox );
				}

				if ( isset( $_POST['report_email'] ) ) {
					$report_email = sanitize_email( wp_unslash( $_POST['report_email'] ) );
					update_option( 'report_email', $report_email );
				}

				if ( isset( $_POST['mailchimp'] ) ) {
					$mailchimp = sanitize_text_field( wp_unslash( $_POST['mailchimp'] ) );
					update_option( 'mailchimp', $mailchimp );
				}

				if ( isset( $_POST['company'] ) ) {
					$company = sanitize_text_field( wp_unslash( $_POST['company'] ) );
					update_option( 'company', $company );
				}

				if ( isset( $_POST['address'] ) ) {
					$address = sanitize_text_field( wp_unslash( $_POST['address'] ) );
					update_option( 'address', $address );
				}

				if ( isset( $_POST['city'] ) ) {
					$city = sanitize_text_field( wp_unslash( $_POST['city'] ) );
					update_option( 'city', $city );
				}

				if ( isset( $_POST['state'] ) ) {
					$state = sanitize_text_field( wp_unslash( $_POST['state'] ) );
					update_option( 'state', $state );
				}

				if ( isset( $_POST['zip'] ) ) {
					$zip = sanitize_text_field( wp_unslash( $_POST['zip'] ) );
					update_option( 'zip', $zip );
				}

				if ( isset( $_POST['country'] ) ) {
					$country = sanitize_text_field( wp_unslash( $_POST['country'] ) );
					update_option( 'country', $country );
				}

				if ( isset( $_POST['phone'] ) ) {
					$phone = sanitize_text_field( wp_unslash( $_POST['phone'] ) );
					update_option( 'phone', $phone );
				}
			}
		}
	}


	$options = wp_load_alloptions();
	include "{$theme_dir}/templates/settings.php";
}

?>