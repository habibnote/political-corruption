<?php 
/*
 * Plugin Name:       Political Corruption
 * Plugin URI:        https://
 * Description:       
 * Version:           0.0.1
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            Md. Habib
 * Author URI:        https://me.habibnote.com
 * Text Domain:       political-co
*/

if( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

class Political_Corruption {
    static $instance = false;

    /**
     * Class Constructor
     */
    private function __construct() {
        
        $this->include();
        $this->define();
        $this->hooks();
    }

    /**
     * Include all files
     */
    private function include() {
        require_once( dirname( __FILE__ ) . '/inc/functions.php' );
        require_once( dirname( __FILE__ ) . '/vendor/autoload.php' );
    }

    /**
     * Define all constant
    */
    private function define() {
        define( 'PC', __FILE__ );
        define( 'PC_DIR', dirname( PC ) );
        define( 'PC_ASSET', plugins_url( 'assets', PC ) );
    }

    /**
     * All Hooks
    */
    private function hooks() {
        
    }

    /**
     * Singleton Instance
    */
    static function get_rpv() {
        
        if( ! self::$instance ) {
            self::$instance = new self();
        }

        return self::$instance;
    }
}

/**
 * Cick off the plugin
 */
Political_Corruption::get_rpv();