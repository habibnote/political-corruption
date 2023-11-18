<?php 

namespace PoliticalCorrption\App;

/**
 * Shortcode Class
 */
class Ajax {

    /**
     * Class constructor
     */
    function __construct() {
        add_action( 'wp_ajax_nopriv_pc_avaiable_email', 'pc_is_email_avaiable' );
    }

    /**
     * Check email is avaiable or not
     */
    function pc_is_email_avaiable() {
        $pc_email       = $_POST['email'];
        $pc_nonce       = $_POST['_nonce'];

        //varify nonce
        if( wp_verify_nonce( $pc_nonce, 'pc_nonce' ) ) {
            if( email_exists( $pc_email ) == false) {
                wp_send_json_success();
            }
        }
    }
}