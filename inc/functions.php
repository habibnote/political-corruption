<?php

/**
 * Display alert
 */
if( ! function_exists( 'pc_alert' ) ) {

    function pc_alert( $notice = '' ) {
        printf( "<script>alert('%s');</script>", $notice );
    }
}