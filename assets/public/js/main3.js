jQuery(function($){
    $(".btn").on("click", function(){
       
        let page_number = $(this).data("page");
        
        $.ajax({
            type: "post",
            url: page_obj.ajax_url,
            data:{
                action: 'pagination',
                id:page_number
            },
            success: function(data){
                $(".post-container").html(data)
            }
        });
    });
});