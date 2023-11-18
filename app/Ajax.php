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
        //check email
        add_action( 'wp_ajax_pc_avaiable_email', [$this, 'pc_is_email_avaiable'] );
        add_action( 'wp_ajax_nopriv_pc_avaiable_email', [$this, 'pc_is_email_avaiable'] );

        //Check username
        add_action( 'wp_ajax_pc_avaiable_username', [$this, 'pc_is_username_avaiable'] );
        add_action( 'wp_ajax_nopriv_pc_avaiable_username', [$this, 'pc_is_username_avaiable'] );
    }

    /**
     * Check Username is avaiable or not
     */
    function pc_is_username_avaiable() {
        $pc_username       = $_POST['username'];
        $pc_nonce       = $_POST['_nonce'];

        //varify nonce
        if( wp_verify_nonce( $pc_nonce, 'pc_nonce' ) ) {
            if( username_exists( $pc_username ) == false) {
                wp_send_json_success();
            }
        }
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