/**
 * Created by michal on 24.07.15.
 */
$(document).ready(function(){

    var $url = 'api/books.php';
    var $context = $('#books');
    $.ajax({url: $url,
        context: $context
    })
        .done(function(data){
            $.each(data, function(key, book){
                $('#books')
                    .append('<tr><td>'+book.id+'</td>' +
                    '<td><span class="name noedit">'+book.name+'</span><input class = "name edit"></input></td>' +
                    '<td><span class="opis noedit" >'+book.opis+'</span><input class = "opis edit"></input></td>' +
                    '<td><span class="author noedit" >'+book.author+'</span><input class="author edit"></input></td>' +
                    '<td><button alt="delete" class="remove glyphicon glyphicon-remove-sign" book-id='+book.id+'></button>' +
                    '<button class="glyphicon glyphicon-edit bookEdit noedit "></button>' +
                    '<button class="saveEdit edit">Save</button>' +
                    '<button class="cancelEdit edit">Cancel</button>' +
                    '</td></tr>');


            })

        });

    $('#zapisz').on('submit', function (e) {

        e.preventDefault();
        $.ajax({
            url:$url,
            method:'POST',
            data: {nazwa: $('#name').val(), author: $('#author').val(), opis: $('#opis').val() },
            dataType: "html"

        })

            .done(function(newIndex){
                $('#books')
                    .append('<tr><td>'+newIndex+'</td><td>'+$('#name').val()+'</td><td>'+$('#opis').val()+'</td><td>'+$('#author').val()+'</td><td><button class ="remove glyphicon glyphicon-remove-sign" book-Id'+newIndex.id+'></button><button class="glyphicon glyphicon-edit bookEdit noedit"></button>'+
                '<button class="saveEdit edit">Save</button>' +
                '<button class="cancelEdit edit">Cancel</button>' +
                '</td></tr>');
                alert('Książka dodana prawidłowo');


            });

    });


    $('#books').delegate('.remove', 'click', function () {

        $conf = confirm('You are about to delete book, are You sure?');
        if($conf) {

            var $tr = $(this).closest('tr');

            $.ajax({
                url: $url,
                method: 'DELETE',
                data: $(this).attr('book-id'),
                dataType: 'html',
                success: function () {

                    $tr.fadeOut(400, function () {
                        $(this).remove();
                    });

                }

            });
        }





    });

    $('#books').delegate('.bookEdit', 'click', function(){
        var $tr = $(this).closest('tr');
        $tr.find('input.name').val($tr.find('span.name').html() );
        $tr.find('input.opis').val($tr.find('span.opis').html() );
        $tr.find('input.author').val($tr.find('span.author').html() );
        $tr.addClass('edit');

    });

    $('#books').delegate('.cancelEdit', 'click', function(){
        $(this).closest('tr').removeClass('edit');

    });

    $('#books').delegate('.saveEdit', 'click', function(){


        var $tr = $(this).closest('tr');
        var book = {
            id: $tr.find('button.remove').attr('book-id'),
            name: $tr.find('input.name').val(),
            opis: $tr.find('input.opis').val(),
            author: $tr.find('input.author').val()
        }

        $.ajax({
            url:$url,
            method:'PUT',
            data: book,
            dataType:'html',
            success: function(){
                $tr.find('span.name').html(book.name);
                $tr.find('span.opis').html(book.opis);
                $tr.find('span.author').html(book.author);
                $tr.removeClass('edit');
            },

            error: function(){
                alert('Error updating database');
            }

        });
    });

    // var $tr = $('tr');
    //var $text = $("#books table:eq(1) tr:eq(1) td:eq(1)");
    //var $link = $('#books').find('tr').find('td').next().text().css('color', "red");
    //$text.css('color', "red");
    ////$(link).delegate('click', function(){
    ////    console.log('click');
    ////})
});