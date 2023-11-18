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
    }

    /**
     * Load all assets
     */
    function pc_assets() {
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
        ob_start();
        include_once( PC_DIR . "/view/form/user-ragistration.php" );
        return ob_get_clean();
    }
}