jQuery(function($){
    $(".nav-item").on("click", function(){
        let cat_id = $(this).data("target");

        $.ajax({
            type: 'post',
            url: category_obj.ajax_url,
            data:{
                action: 'tab_category_ajax',
                id:cat_id
            },
            success: function(data){
                $(".content-item").html(data)
            }
        });
    });
    $(window).on("load", function(){
        let cat_id = $(".nav-items li:first-child").data("target");

        $.ajax({
            type: 'post',
            url: category_obj.ajax_url,
            data:{
                action: 'tab_category_ajax',
                id:cat_id
            },
            success: function(data){
                $(".content-item").html(data)
            }
        });
    });
});