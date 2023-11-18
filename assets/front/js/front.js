jQuery(function($){
    $( document ).ready(function() {

        $(document).on('keyup', '#pc-email', function(){
            
            let pc_email = $(this).val();
            emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

            if( emailRegex.test(pc_email) ) {
                
                $.post(PC_ajax.url, {
                    action: 'pc_avaiable_email',
                    _nonce: PC_ajax.nonce,
                    email: pc_email,
                }, function(response) {
                    console.log(response);
                    if (response.success) {
                        $(this).append( "<span>Email is avaiable</span>" );
                    } else {
                        $(this).append( "<span>Sorry Email is not Avaiable</span>" );
                    }
                });
            }
        });
    });
});