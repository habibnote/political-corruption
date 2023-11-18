jQuery(function($){
    $( document ).ready(function() {

        //check email with ajax
        $(document).on('keyup', '#pc-email', function(){

            let pc_email = $(this).val();
            emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

            if( emailRegex.test(pc_email) ) {
                
                $.post(PC_ajax.url, {
                    action: 'pc_avaiable_email',
                    _nonce: PC_ajax.nonce,
                    email: pc_email,
                }, function(response) {
                    if (response.success) {
                        $('.pc-email-unaviable').hide();
                        $('.pc-email-avaiable').show();
                    } else {
                        $('.pc-email-avaiable').hide();
                        $('.pc-email-unaviable').show();
                    }
                });
            }
        });

        //check username with ajax
        $(document).on('keyup', '#pc-username', function(){

            let pc_username = $(this).val();
 
            $.post(PC_ajax.url, {
                action: 'pc_avaiable_username',
                _nonce: PC_ajax.nonce,
                username: pc_username,
            }, function(response) {
                if (response.success) {
                    $('.pc-username-unaviable').hide();
                    $('.pc-username-avaiable').show();
                } else {
                    $('.pc-username-avaiable').hide();
                    $('.pc-username-unaviable').show();
                }
            });
        });

        //password checked
        $(document).on('keyup', '#pc-password', function(){

            let pc_password = $(this).val();

            if( pc_password.length < 6 ) {
                $('.pc-password-invalid').show();
            }else{
                $('.pc-password-invalid').hide();
            }

        });
    });
});