$(document).ready(function() {
    var divImage = $(window).height() - 115;

    if($(window).height()<=960){
        $("#div-logo").css('height', divImage+'px');
    } else {
        $("#div-logo").css('height','760px');
    }
});

$(window).on('load', function(){
    var divDestino = ($(".destino").height())*0.30;
    $(".home-destino").css('height', divDestino+'px');
});

// Instantiate the Bootstrap carousel
$('.carousel').carousel({
    interval: false
});


$(document).ready(function() {
    $('.multi-item-carousel .item').each(function(){
        var next = $(this).next();
        if (!next.length) {
            next = $(this).siblings(':first');
        }
        next.children(':first-child').clone().appendTo($(this));

        for (var i=0;i<2;i++) {
            next=next.next();
            if (!next.length) {
                next = $(this).siblings(':first');
            }

            next.children(':first-child').clone().appendTo($(this));
        }
    });
});
