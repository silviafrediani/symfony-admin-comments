// preloader
$(window).load(function() {
    $("#preloader").delay(500).fadeOut("slow");
});

$(document).ready(function(){

    $('.overlay-modal').hide();

    $('.form-eliminazione').submit(function(e){
        e.preventDefault();
        $(this).attr('id','current');

        console.log($('#current'));

        $('.overlay-modal').show();

        $('.ok').on('click', function(){
            $('.overlay-modal').hide();
            $('#current')[0].submit();
        });

        $('.annulla').on('click', function(){
            $('.overlay-modal').hide();
            $('.form-eliminazione').removeAttr('id','current');
        });

    });
});
