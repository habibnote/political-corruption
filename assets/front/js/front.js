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
    });
});