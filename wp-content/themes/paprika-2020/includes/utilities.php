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
        return 'page-about';
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
                
                if ( isset( $_POST['donations'] ) ) {
                    
					if (filter_var($_POST['donations'], FILTER_VALIDATE_URL)) {
                        update_option( 'donations', $_POST['donations'] );
                    };
                }

				if ( isset( $_POST['mailchimp'] ) ) {
					$mailchimp = sanitize_text_field( wp_unslash( $_POST['mailchimp'] ) );
					update_option( 'mailchimp', $mailchimp );
                }
                if ( isset( $_POST['mailchimp_list'] ) ) {
					$mailchimp = sanitize_text_field( wp_unslash( $_POST['mailchimp_list'] ) );
					update_option( 'mailchimp_list', $mailchimp );
                }
                if ( isset( $_POST['contact_email'] ) ) {
					$contact_email = sanitize_email( $_POST['contact_email'] );
					update_option( 'contact_email', $contact_email );
                }
    
                $custom_colors = get_option('custom_colors');
    
                if (!isset($custom_colors) || !is_array($custom_colors)) {
                    $custom_colors = array();
                    update_option('custom_colors', $custom_colors);
                }

                if ( isset( $_POST['about-color'] ) ) {
                    $about_color = sanitize_text_field( wp_unslash( $_POST['about-color'] ) );
                    $custom_colors['about'] = $about_color;
                } else {
                    $custom_colors['about'] = '#a74482';
                }
                if ( isset( $_POST['festivals-color'] ) ) {
					$festivals_color = sanitize_text_field( wp_unslash( $_POST['festivals-color'] ) );
					$custom_colors['festivals'] = $festivals_color;
                } else {
                    $custom_colors['festivals'] = '#e6007a';
                }
                if ( isset( $_POST['support-color'] ) ) {
					$support_color = sanitize_text_field( wp_unslash( $_POST['support-color'] ) );
					$custom_colors['support'] = $support_color;
                } else {
                    $custom_colors['support'] = '#177e72';
                }
                if ( isset( $_POST['press-color'] ) ) {
					$press_color = sanitize_text_field( wp_unslash( $_POST['press-color'] ) );
					$custom_colors['press'] = $press_color;
                } else {
					$custom_colors['press'] = '#0c628b';
                }
                update_option( 'custom_colors', $custom_colors );

                if ( isset( $_POST['land_acknowledgement'] ) ) {
					$land_acknowledgement = sanitize_textarea_field( trim( $_POST['land_acknowledgement'] )  );
					update_option( 'land_acknowledgement', $land_acknowledgement );
                }
			}
		}
	}


	$options = wp_load_alloptions();
	include "{$theme_dir}/templates/settings.php";
}

if (!function_exists('paprika_custom_css')) {
    function paprika_custom_css() {
        include( get_template_directory()  . '/includes/styles/style.php'); 
    }
}

if (!function_exists('paprika_hex_to_rgb')) {
    function paprika_hex_to_rgb($opacities, $color) {
        $opaque_values = array();
            list($r, $g, $b) = sscanf($color, "#%02x%02x%02x");
            foreach($opacities as $opacity) {
                $opaque_values[$opacity] = 'rgba('. $r . ',' . $g . ',' . $b . ', 0.' . $opacity . ')';
        }
        return $opaque_values;
    }
    
}

if (!function_exists('paprika_sanitize_field')) {
    function paprika_sanitize_field($field, $value, $object, $type = '') {
        if ($type === 'email') {
            $sanitized_field = trim(sanitize_email($value));
            $object[$field] = $sanitized_field;
            return $object;
        }
        if ($type === 'textarea') {
            $sanitized_field = sanitize_textarea_field($value);
            $object[$field] = $sanitized_field;
            return $object;
        }
        $sanitized_field = sanitize_text_field($value);
        $object[$field] = $sanitized_field;
        return $object;

    }
}

?>