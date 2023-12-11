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
        add_shortcode( 'pc_list', [$this, 'pc_main_shortcode'] );
        add_shortcode( 'pc_form', [$this, 'pc_main_form'] );

        //save post and delete post hook
        add_action( 'save_post', [$this, 'pc_track_political_corruption_create'], 10, 2 );
        add_action( 'before_delete_post', [$this, 'pc_track_political_corruption_delete'] );

        add_action( 'wp_enqueue_scripts', [$this, 'pc_assets'] );
        add_action( 'init', [$this, 'pc_process_registration_form'] );
        add_action( 'init', [$this, 'pc_process_main_submittion'] );
        add_action( 'init', [$this, 'pc_process_login_form'] );

        add_filter( 'single_template', [$this, 'pc_single_template'] );
    }

    /**
     * add Report number when post has been created
     */
    function pc_track_political_corruption_create( $post_id, $post ) {

        if ( $post->post_type == 'political-corruption' ) {
            
            //adjust report number
            pc_update_report();
        }
    }

    /**
     * adjust post number when post has been delete
     */
    function pc_track_political_corruption_delete( $post_id ) {

        // Get the post object
        $post = get_post($post_id);

        if ( $post->post_type == 'political-corruption' ) {

            //adjust report number
            pc_update_report();
        }
    }

    /**
     * Define PC single template
     */
    function pc_single_template( $file ) {
        global $post;

        if( 'political-corruption' == $post->post_type ) {
            $file_path  = PC_DIR . '/pc-templates/single-political-corruption.php';
            $file       = $file_path;
        }
        return $file;
    }

    /**
     * Process Login Form
     */
    function pc_process_login_form() {
        function custom_login_form_action() {

            if ( isset( $_POST['wp-submit'] ) ) {

              $user = get_user_by( 'email', sanitize_email( $_POST['user_login'] ) );
          
              if ( $user && wp_check_password( $_POST['user_pass'], $user->data->ID ) ) {
                wp_set_auth_cookie( $user->ID );
                wp_safe_redirect( home_url() );
                exit;
              } else {
                pc_alert( "InValid usrname/email or password." );
              }
            }
          }
    }
    
    /**
     * Process PC main submittion
     */
    function pc_process_main_submittion() {

        
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

                                wp_safe_redirect( site_url() . "/login" );
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

        //login form
        ob_start();
        include_once( PC_DIR . "/view/form/user-login.php" );
        return ob_get_clean();
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

        //Display all list
        include_once( PC_DIR . "/view/pc-list/pc-list.php" );
    }

    /**
     * Main PC form
     * */
    function pc_main_form() {
        
        if( is_user_logged_in() ) {
    
            //PC submittion form
            ob_start();
            include_once( PC_DIR . "/view/form/pc-submittion.php" );
            return ob_get_clean();
        }else{
            $login_url = site_url("/login");
            echo "To Submit New Submittion You need to login first <a href='{$login_url}'>login</a> ";
        }
    }
}