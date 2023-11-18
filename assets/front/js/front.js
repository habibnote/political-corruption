jQuery(function($){
    $( document ).ready(function() {


        alert("Hello");

        $(document).on('keyup', '#pc-email', function(){
            console.log( $(this).val() );
        });
    });
});