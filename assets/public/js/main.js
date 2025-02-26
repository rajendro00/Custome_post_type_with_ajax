jQuery(function($){
    $(".custom_form").on("submit", function(e){
        e.preventDefault();
        let form_data = $(this).serialize();
         
        $.ajax({
            type: "POST",
            url:custom_post_obj.ajax_url,
            data:{
                action: 'custom_post_form_call',
                post_id: form_data,
            },
            beforeSend: function(){
                $(".preloader").show()
            },
            success: function(response){
                $(".preloader").hide()
                if(response.success){
                    $(".error-show").html("<p > Successfully </p>")
                }else{
                    $(".error-show").html("<p > Error creating post! </p>")
                }

            }
        });
    })
});