$(document).ready(function(){
    if($("#result").children().length == 0){
        $("#result").css("visibility","hidden");
    }

    (function(){
        if($.cookie("img_id")){
        var img_id_cookie = $.cookie("img_id");
        var img_id = $.parseJSON(img_id_cookie);
            var img_url = "url(images/fortress-"+ img_id + ".jpg)";
            $("table").css("background-image",img_url);
        }
        if($.cookie("correct_sections")){
            var correct_sections = $.cookie("correct_sections");
            var data = $.parseJSON(correct_sections);
            $.each(data, function(i,item){
                $(".img__section").each(function(){
                    if($(this).hasClass("id-"+item)){
                        $(this).removeClass("img__section");
                    };
                });
            });
        }
        
    })()
    $(".question__form-possible_answer").on('click',function(){
        $(".question__form-possible_answer").removeClass("active");
        $(this).addClass("active");
        $("#selected_answers").val($(this).data("value"));
    });
});
