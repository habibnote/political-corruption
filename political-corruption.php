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