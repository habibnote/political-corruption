<?php 

namespace PoliticalCorrption\App;

/**
 * Shortcode Class
 */
class Shortcode {

    /**
     * Class constructor
     */
    function __construct() {

        add_shortcode( 'pc_register', [$this, 'pc_user_registration'] );
        add_shortcode( 'pc_login', [$this, 'pc_user_login'] );
        add_shortcode( 'pc_main', [$this, 'pc_main_shortcode'] );

        add_action( 'wp_enqueue_scripts', [$this, 'pc_assets'] );
        add_action( 'init', [$this, 'pc_process_registration_form'] );
        add_action( 'init', [$this, 'pc_process_main_submittion'] );
    }
    
    /**
     * Process PC main submittion
     */
    function pc_process_main_submittion() {

        if( ($_SERVER['REQUEST_METHOD'] == 'POST') ) {
            if( isset( $_POST['pc_submittion'] ) ) {
                
                $pc_audio   = $_FILES['pc_audio'] ?? '';
                $pc_video   = $_FILES['pc_video'] ?? '';
                $pc_doc     = $_FILES['pc_doc'] ?? '';

                if( $pc_audio ) {
                    pc_upload_files( $pc_audio );
                }
                if( $pc_video ) {
                    pc_upload_files( $pc_video );
                } 
                if( $pc_doc ) {
                    pc_upload_files( $pc_doc );
                }

                // update_field( 'video', $pc_video, 20 );
                // update_field( 'document', $pc_doc, 20 );

            }
        }
    }

    /**
     * Proccessing all form 
     */
    function pc_process_registration_form() {

        if( ($_SERVER['REQUEST_METHOD'] == 'POST') ) {
            if( isset( $_POST['pc-register'] ) ) {
                
                $pc_email       = sanitize_email( $_POST['pc-email'] ) ?? '';
                $pc_phone       = sanitize_text_field( $_POST['pc-phone'] ) ?? '';
                $pc_username    = sanitize_text_field( $_POST['pc-username'] ) ?? '';
                $pc_password    = sanitize_text_field( $_POST['pc-password'] ) ?? '';

                $nonce = $_POST[ '_wpnonce' ] ?? '';

                if( $pc_email != '' && $pc_phone != '' && $pc_username != '' && $pc_password != '' ) {

                    if( wp_verify_nonce( $nonce, 'pc_nonce' ) ) {

                        $is_username    = username_exists( $pc_username );
                        $is_email       = email_exists( $pc_email );

                        if( ! $is_username && ! $is_email ) {
                            // Create the user
                            $user_id = wp_create_user( $pc_username, $pc_password, $pc_email );

                            if ( ! is_wp_error( $user_id ) ) {
                                $user = get_user_by( 'id', $user_id );
                                $user->set_role( 'subscriber' );
                        
                                // Add phone number as user meta data
                                update_user_meta( $user_id, 'phone', $pc_phone );

                                pc_alert( "Registration successfull" );

                                wp_redirect( "http://localhost:10033/" );
                                exit;
                            }
                        }else{
                            pc_alert( "Invalid Username or Email" );
                        }
                    }
                }else{
                    pc_alert( "All Field Are Required" );
                }
            }
        }
    }

    /**
     * Load all assets
     */
    function pc_assets() {
        wp_enqueue_style( 'pc-front', PC_ASSET . "/front/css/front.css", [], time() );

        wp_enqueue_script( 'pc-front', PC_ASSET . "/front/js/front.js", ['jquery'], time(), true );

        $admin_url =  admin_url( 'admin-ajax.php' );
        wp_localize_script( 'pc-front', 'PC_ajax', array( 
            'url'   => $admin_url,
            'nonce' => wp_create_nonce( 'pc_nonce' )
        ));
    }

    /**
     * User Login
    */
    function pc_user_login() {

        include_once( PC_DIR . "/view/form/user-login.php" );
    }

    /**
     * User Ragistration
     */
    function pc_user_registration() {

        //registration form
        ob_start();
        include_once( PC_DIR . "/view/form/user-ragistration.php" );
        return ob_get_clean();
    }

    /**
     * PC main shortcode
     */
    function pc_main_shortcode() {
        //PC submittion form
        ob_start();
        include_once( PC_DIR . "/view/form/pc-submittion.php" );
        return ob_get_clean();
    }
}