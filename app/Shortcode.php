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

        include_once( PC_DIR . "/view/form/user-ragistration.php" );
    }
}