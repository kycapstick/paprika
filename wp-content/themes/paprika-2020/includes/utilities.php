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
            'festivals'
        );
        foreach ($slugs as $slug) {
            $page = get_page_by_path($slug);
            if (is_page($slug) || (isset($page) && intval($parent_page) === intval($page->ID))) {
                return 'page-' . $slug;
            }
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

?>