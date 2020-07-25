<?php

    function paprika_compose_message($message_object) {
        $current_url = get_stylesheet_directory_uri();

        $message = '<table>
            <tr>
                <td><h1 style="color:#000">A new message from ' . $message_object['contact_name'] . '</h1></td>
            </tr>
            <tr>
                <td>
                    <p><span style="font-weight: bold">Email: </span>' . $message_object['contact_email'] . '</p> 
                </td>
            </tr>
            <tr>
                <td>
                    <p><span style="color:#000; font-weight: bold"> Subject: </span>' . $message_object['contact_subject'] . '</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p style="font-weight: bold">Message</p>
                    ' . wpautop($message_object['contact_message']) . '
                </td>
            </tr>
            <tr>
                <td>
                    <p style="font-weight: ligher; color: grey; border-top: 3px solid #000000; padding-top: 16px" >This email was automatically generated by someone filling out the Contact Us form on the Paprika Festival website.</p>
                </td>
            </tr>
        <table>';

        return $message;
    }

    function paprika_set_html_mail_content_type() {
        return 'text/html';
    }

    function paprika_send_contact_form() {
        if ( isset( $_SERVER['REQUEST_METHOD'] ) && 'POST' === $_SERVER['REQUEST_METHOD'] ) {
            // Verify nonce.
            if ( ! isset( $_POST['nonce'] ) || false === wp_verify_nonce( sanitize_key( $_POST['nonce'] ), 'contact_form' ) ) {
                print wp_json_encode(
                    array(
                        'status'  => 'ERROR',
                        'message' => 'This action is not permitted.',
                    )
                );
                die();
            }
            $contact_email = get_option('contact_email');
            if (!isset($contact_email) || !strlen($contact_email) > 0) {
                print wp_json_encode(
                    array(
                        'status'  => 'ERROR',
                        'message' => 'No email found.',
                    )
                );
                die();
            }

            if ( isset( $_POST['contact_name'] ) && strlen( trim( sanitize_text_field( $_POST['contact_name'] ) ) ) > 0 && isset( $_POST['contact_email'] ) && strlen( trim( sanitize_email( $_POST['contact_email'] ) ) ) > 0 && isset( $_POST['contact_subject'] ) && strlen( sanitize_text_field( $_POST['contact_subject'] ) ) > 0  && isset($_POST['contact_message']) && strlen( sanitize_text_field( $_POST['contact_message'] ) ) > 0) {
                    $fields = array( 'contact_name' => 'text', 'contact_email' => 'email', 'contact_subject' => 'text', 'contact_message' => 'textarea');
                    $email_object = array();
                    foreach ($fields as $field=> $type ) {
                        paprika_console_log($field);
                        $email_object = paprika_sanitize_field($field, $_POST[$field], $email_object, $type);
                    }
                    $message = paprika_compose_message($email_object);
                    $title = 'A new message from ' . $email_object['contact_name'];
                    add_filter( 'wp_mail_content_type', 'paprika_set_html_mail_content_type' );
                    $success = wp_mail($contact_email, $title, $message);
                    remove_filter('wp_mail_content_type', 'paprika_set_html_mail_content_type');
                    if ( $success ) {
                        print wp_json_encode( array( 'status' => 'OK' ) );
                    } else {
                        print wp_json_encode( array( 'status' => 'Error'));
                    }
                    die();

            }
        }
    }