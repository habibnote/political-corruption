<?php

/**
 * Display alert
 */
if( ! function_exists( 'pc_alert' ) ) {

    function pc_alert( $notice = '' ) {
        printf( "<script>alert('%s');</script>", $notice );
    }
}

/**
 * Audio Video Uploader
 */
if( ! function_exists( 'pc_upload_files' ) ) {

    function pc_upload_files( $file = '' ) {

        $file = $file;

        $fileName = $file['name'];
        $fileTemp = $file['tmp_name'];
        $fileSize = $file['size'];
        $fileError = $file['error'];
        $fileType = $file['type'];

        $allowedExtensions = array( 'mp3', 'wav', 'ogg', 'wma', 'aac', 'flac', 'mid', 'mp4', 'wmv', 'avi', 'flv', 'mpeg', 'ogv', 'webm', 'mkv', 'doc', 'docx', 'pdf' );

        $fileExtension = strtolower( pathinfo( $fileName, PATHINFO_EXTENSION ) );

        // Check if file is uploaded successfully
        if ( $fileError === 0 ) {

            if ( $fileSize <= 50000000 ) { // 50MB limit

                // Check if file extension is allowed
                if ( in_array( $fileExtension, $allowedExtensions ) ) {
                    // Generate a unique filename
                    $newFileName = uniqid('', true) . '.' . $fileExtension;

                    $uploadDir = wp_upload_dir();
                    $targetFile = $uploadDir['path'] . '/' . $newFileName;

                    if ( move_uploaded_file( $fileTemp, $targetFile ) ) {
                    
                    $attachment = array(
                        'post_mime_type' => $fileType,
                        'post_title' => $fileName,
                        'post_content' => '',
                        'post_status' => 'inherit'
                    );

                    $attach_id = wp_insert_attachment( $attachment, $targetFile );

                    return $attach_id;

                    // wp_set_object_terms($attach_id, 'audio', 'attachment_tag');
                    }
                }
            }
        }
    }
}

/**
 * Update report Numner
 */
if( ! function_exists( 'pc_update_report' ) ) {

    function pc_update_report() {

        $args = array(
            'post_type'      => 'political-corruption',
            'post_status'    => 'publish',
            'orderby'        => 'date',
            'order'          => 'ASC',
            'posts_per_page' => -1,
        );

        $pc_report_query = new WP_Query( $args );

        $report_number = 1;

        //Check post is exit or not
        if( $pc_report_query->have_posts() ) { 
            while( $pc_report_query->have_posts() ) {
                $pc_report_query->the_post();

                //update post meta 
                update_post_meta( get_the_ID(), 'pc_report_number', $report_number );

                //increase 
                $report_number++;
            }
        }
         
        wp_reset_postdata();
    }
}