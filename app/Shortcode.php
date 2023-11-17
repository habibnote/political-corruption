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
    }

    /**
     * User ragistration
     */
    function pc_user_registration() {

        include_once( PC_DIR . "/view/form/user-ragistration-form.php" );
    }
}