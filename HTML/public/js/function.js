$(document).ready(function(){
    new WOW().init();
    $("div[id|='product'] .link__orange").on('click',function () {
        var modal= $(this).parent().parent().parent().parent().parent().parent();
        $('.modal-backdrop').remove();
        $('body').css('padding','0');
        modal.removeClass('in');
        modal.fadeOut();
    });
    $('.required').on('blur',function(){
        if($(this).val().length>5){
            if($(this).hasClass('danger')){
                $(this).removeClass('danger')
            }
            $(this).tooltip('destroy');
            $(this).addClass('success');
        }
        else{
            if($(this).hasClass('success')){
                $(this).removeClass('success')
            }
            $(this).tooltip({
                title:'Поле обязательно для заполнения'
            });
            $(this).addClass('danger');
        }

    });
});
var swiper = new Swiper('.swiper-container', {
    loop:true,
    speed: 500,
    /*
     autoplay: {
     delay: 5000,
     },
     */
    pagination: {
        el: '.swiper-pagination',
        clickable:true,
        hideOnClick:false
    },
    on: {
        slideChange: function () {
            new WOW().init();
        }
    }
});

$(function(){
    $("#menu a[href^='#']").click(function(){
        var _href = $(this).attr("href");
        $("html, body").animate({scrollTop: $(_href).offset().top+"px"});
        return false;
    });
});