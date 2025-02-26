jQuery(function($){
    $(".custom_form").on("submit", function(){
        let form_data = $(this).serialize();
         console.log(form_data);
    })
});