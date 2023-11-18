<?php

namespace PoliticalCorrption\App;

class Tgm {

    /**
     * Class constructor
     */
    function __construct() {
        add_action( 'tgmpa_register', [$this, 'co_register_required_plugins'] );
    }

    /**
     * Register all required plugins
     * 
     * Depiendices
     */
    function co_register_required_plugins() {

        $plugins = array(

            /**
             * Acf installed
             */
            array(
                'name'      => 'Advanced Custom Fields (ACF)',
                'slug'      => 'advanced-custom-fields',
                'required'  => true,
            ),
        );
    
        $config = array(
            'id'           => 'political-co',                 // Unique ID for hashing notices for multiple instances of TGMPA.
            'default_path' => '',                      // Default absolute path to bundled plugins.
            'menu'         => 'tgmpa-install-plugins', // Menu slug.
            'parent_slug'  => 'plugins.php',            // Parent menu slug.
            'capability'   => 'manage_options',    // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
            'has_notices'  => true,                    // Show admin notices or not.
            'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
            'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
            'is_automatic' => false,                   // Automatically activate plugins after installation or not.
            'message'      => '',                      // Message to output right before the plugins table.
        );
    
        tgmpa( $plugins, $config );
    }
}
