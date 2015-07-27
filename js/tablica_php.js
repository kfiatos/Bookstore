/**
 * Created by michal on 24.07.15.
 */


$(document).on('ready', function() {
    var $context = $('.data');
    var $url = "http://date.jsontest.com/";
    $.ajax({
        url: $url,
        context: $context })
        .done(function(data){
        $(this).text(data.date);
        //$(this).text(data.time);
        });

    setInterval(function() {

            var $context = $('.czas');
            var $url = "http://date.jsontest.com/";
            $.ajax({
                url: $url,
                context: $context })
                .done(function (data) {
                    //$(this).text(data.date);
                    $(this).text(data.time);

                     //$.each(data, function(key, value) {
                     //    $(".data").append('<div> ' + key + " " + value + '</div>');
                     //});

                });

        },1000);

});



