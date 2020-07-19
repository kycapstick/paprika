<?php 
    if (!function_exists('paprika_add_email_to_list')) {
        function paprika_add_email_to_list( $id, $email, $name = false ) {

            $options = wp_load_alloptions();

            if ( isset( $options['mailchimp'] ) ) {
                $api_key = trim( $options['mailchimp'] );

                if ( ! empty( $api_key ) ) {
                    $dc = end( explode( '-', $api_key ) );
                }

                if ( ! empty( $dc ) ) {
                    $curl    = curl_init();
                    $api_url = "https://{$dc}.api.mailchimp.com/3.0/lists/{$id}/members";

                    curl_setopt( $curl, CURLOPT_URL, $api_url );
                    curl_setopt( $curl, CURLOPT_HTTPHEADER, array( 'Content-Type: application/json' ) );
                    curl_setopt( $curl, CURLOPT_USERPWD, 'user:' . $api_key );
                    curl_setopt( $curl, CURLOPT_POST, true );
                    curl_setopt( $curl, CURLOPT_RETURNTRANSFER, true );

                    $data                  = array();
                    $data['email_address'] = $email;
                    $data['status']        = 'subscribed';
                    if ( $name ) {
                        $data['merge_fields'] = $name;
                    }

                    $json = wp_json_encode( $data );

                    curl_setopt( $curl, CURLOPT_POSTFIELDS, $json );
                    $result = curl_exec( $curl );
                    curl_close( $curl );
                    $json_result = json_decode( $result );
                    return $json_result;
                }
            }

            return false;
        }
    }

    if (!function_exists('paprika_add_email_to_list')) {
        function mozilla_add_email_to_list( $id, $email, $name = false ) {

            $options = wp_load_alloptions();

            if ( isset( $options['mailchimp'] ) ) {
                $api_key = trim( $options['mailchimp'] );

                if ( ! empty( $api_key ) ) {
                    $dc = end( explode( '-', $api_key ) );
                }

                if ( ! empty( $dc ) ) {
                    $curl    = curl_init();
                    $api_url = "https://{$dc}.api.mailchimp.com/3.0/lists/{$id}/members";

                    curl_setopt( $curl, CURLOPT_URL, $api_url );
                    curl_setopt( $curl, CURLOPT_HTTPHEADER, array( 'Content-Type: application/json' ) );
                    curl_setopt( $curl, CURLOPT_USERPWD, 'user:' . $api_key );
                    curl_setopt( $curl, CURLOPT_POST, true );
                    curl_setopt( $curl, CURLOPT_RETURNTRANSFER, true );

                    $data                  = array();
                    $data['email_address'] = $email;
                    $data['status']        = 'subscribed';
                    if ( $name ) {
                        $data['merge_fields'] = $name;
                    }

                    $json = wp_json_encode( $data );

                    curl_setopt( $curl, CURLOPT_POSTFIELDS, $json );
                    $result = curl_exec( $curl );
                    curl_close( $curl );
                    $json_result = json_decode( $result );
                    return $json_result;
                }
            }

            return false;
        }
    }
        

    if (!function_exists('paprika_mailchimp_subscribe')) {
        function paprika_mailchimp_subscribe() {
                if ( isset( $_SERVER['REQUEST_METHOD'] ) && 'POST' === $_SERVER['REQUEST_METHOD'] ) {
                    // Verify nonce.
                    if ( ! isset( $_POST['nonce'] ) || false === wp_verify_nonce( sanitize_key( $_POST['nonce'] ), 'mailing-list' ) ) {
                        print wp_json_encode(
                            array(
                                'status'  => 'ERROR',
                                'message' => 'This action is not permitted.',
                            )
                        );
                        die();
                    }
                    if ( isset( $_POST['first_name'] ) && strlen( trim( sanitize_key( $_POST['first_name'] ) ) ) > 0 && isset( $_POST['last_name'] ) && strlen( trim( sanitize_key( $_POST['last_name'] ) ) ) > 0 && isset( $_POST['email'] ) && strlen( sanitize_key( $_POST['email'] ) ) > 0 ) {

                        $first_name        = trim( sanitize_key( $_POST['first_name'] ) );
                        $last_name        = trim( sanitize_key( $_POST['last_name'] ) );
                        $email =    intval( sanitize_key( $_POST['email'] ) );
                        $name          = array();
                        $name['FNAME'] = trim( sanitize_text_field( wp_unslash( $_POST['first_name'] ) ) );
                        $name['LNAME'] = trim( sanitize_text_field( wp_unslash( $_POST['last_name'] ) ) );
                        $email         = trim( sanitize_email( wp_unslash( $_POST['email'] ) ) );

                        $result = mozilla_add_email_to_list( $email, $name );
                        if ( $result ) {
                            print wp_json_encode( array( 'status' => 'OK' ) );
                        }
                    }  else {
                        print wp_json_encode(
                            array(
                                'status'  => 'ERROR',
                                'message' => 'Invalid request',
                        )
                    );
                }
            } else {
                print wp_json_encode(
                    array(
                        'status'  => 'ERROR',
                        'message' => 'Invalid request',
                    )
                );
            }
            die();
        } 
    }