<form method="POST" enctype="multipart/form-data">
    <p>
        <label for="cp_profile">Profile</label>
        <input type="file" name="pc_profile" id="pc_profile" accept="image/*">
    </p>
    <p>
        <label for="cp_name">Corrupt politician's Name</label>
        <input type="text" name="cp_name" id="cp_name">
    </p>
    <p>
        <label for="pc_title">Title</label>
        <input type="text" name="pc_title" id="pc_title">
    </p>
    <p>
        <label for="pc_date">Date</label>
        <input type="date" name="pc_date" id="pc_date">
    </p>
    <p>
        <label for="pc_state">State</label>
        <input type="text" name="pc_state" id="pc_state">
    </p>
    <p>
        <label for="pc_city">City</label>
        <input type="text" name="pc_city" id="pc_city">
    </p>
    <p>
        <label for="pc_country">Country</label>
        <input type="text" name="pc_country" id="pc_country">
    </p>
    <p>
        <label for="pc_description">Description</label>
        <textarea name="pc_description" id="pc_description"></textarea>
    </p>
    <p>
        <label for="pc_audio">Upload a Audio</label>
        <input type="file" name="pc_audio" id="pc_audio" accept="audio/*">
    </p>
    <p>
        <label for="pc_video">Upload a Video</label>
        <input type="file" name="pc_video" id="pc_video" accept="video/*">
    </p>
    <p>
        <label for="pc_doc">Upload a Document (pdf/doc/docx)</label>
        <input type="file" id="pc_doc" name="pc_doc" accept=".pdf,.doc,.docx">
    </p>
    <p>
        <button type="submit" name="pc_submittion">Submit</button>
    </p>
    <p class="pc_notice"></p>
</form>

<?php
    if( ($_SERVER['REQUEST_METHOD'] == 'POST') ) {
        if( isset( $_POST['pc_submittion'] ) ) {

            //all text filed
            $cp_name    = sanitize_text_field( $_POST['cp_name'] ) ?? '';
            $pc_title   = sanitize_text_field( $_POST['pc_title'] ) ?? '';
            $pc_date    = sanitize_text_field( $_POST['pc_date'] ) ?? '';
            $pc_state   = sanitize_text_field( $_POST['pc_state'] ) ?? '';
            $pc_city    = sanitize_text_field( $_POST['pc_city'] ) ?? '';
            $pc_country = sanitize_text_field( $_POST['pc_country'] ) ?? '';
            $pc_description = sanitize_text_field( $_POST['pc_description'] ) ?? '';
            
            //all files
            $pc_profile = $_FILES['pc_profile'] ?? '';
            $pc_audio   = $_FILES['pc_audio'] ?? '';
            $pc_video   = $_FILES['pc_video'] ?? '';
            $pc_doc     = $_FILES['pc_doc'] ?? '';

            /**
             * Create post
            */
            if( $cp_name ) {

                $post_data = array(
                    'post_title'    => $cp_name,
                    'post_type'     => 'political-corruption',
                    'post_status'   => 'draft',
                    'post_author'   => get_current_user_id(),
                    'post_content'  => $pc_description,
                );
                
                // Insert the post into the database
                $post_id = wp_insert_post( $post_data );

                //update all post meta
                if( $pc_state ) {
                    update_field( 'state', $pc_state, $post_id );
                }
                if( $pc_city ) {
                    update_field( 'city', $pc_city, $post_id );
                }
                if( $pc_country ) {
                    update_field( 'country', $pc_country, $post_id );
                }
                if( $pc_title ) {
                    update_field( 'title', $pc_title, $post_id );
                }
                if( $pc_date ) {
                    update_field( 'date', $pc_date, $post_id );
                }

                //update all files into meta
                if( $pc_audio ) {
                    update_field( 'audio',  pc_upload_files( $pc_audio ), $post_id );
                }
                if( $pc_video ) {
                    update_field( 'video', pc_upload_files( $pc_video ), $post_id );
                }
                if( $pc_doc ) {
                    update_field( 'document', pc_upload_files( $pc_doc ), $post_id );
                }

                //Insert post thumbail 
                $pc_thumbnail_id = pc_upload_files( $pc_profile );

                // Set the featured image
                set_post_thumbnail( $post_id, $pc_thumbnail_id );

                // Update the post to save the changes
                wp_update_post( array( 'ID' => $post_id ) );

                //give a message
                printf( "<p style='color:#008000;'>Information has been received, it will be published after review</p>" );

                // wp_redirect( 'http://localhost:10044/pc-register/' );
                exit; 
            }else{

                //give a message
                pc_alert( "Atleast Corrupt politician's Name is required" );
            }
        }
    }
?>