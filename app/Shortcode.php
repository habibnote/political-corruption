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
        add_action( 'wp_enqueue_scripts', [$this, 'pc_assets'] );
        add_action( 'init', [$this, 'pc_process_form'] );
    }

    /**
     * Proccessing all form 
     */
    function pc_process_form() {

        if( ($_SERVER['REQUEST_METHOD'] == 'POST') ) {

            //Process User ragistration form
            if( isset( $_POST['pc-register'] ) ) {
                
                $pc_email       = sanitize_email( $_POST['pc-email'] ) ?? '';
                $pc_phone       = sanitize_text_field( $_POST['pc-phone'] ) ?? '';
                $pc_username    = sanitize_text_field( $_POST['pc-username'] ) ?? '';
                $pc_password    = sanitize_text_field( $_POST['pc-password'] ) ?? '';

                $nonce = $_POST[ '_wpnonce' ] ?? '';

                if( $pc_email != '' && $pc_phone != '' && $pc_username != '' && $pc_password != '' ) {

                    if( wp_verify_nonce( $nonce, 'pc_nonce' ) ) {

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
}