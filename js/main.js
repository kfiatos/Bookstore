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
                    '<td><button class="remove" book-id='+book.id+'>x</button>' +
                    '<button class="bookEdit noedit">Edit</button>' +
                    '<button class="saveEdit edit">Save</button>' +
                    '<button class="cencelEdit edit">Cancel</button>' +
                    '</td></tr>');

            })

        });

    $('#zapisz').on('click', function (e) {

        e.preventDefault();
        $.ajax({
            url:$url,
            method:'POST',
            data: {nazwa: $('#name').val(), author: $('#author').val(), opis: $('#opis').val() },
            dataType: "html"

        })

            .done(function(newIndex){
                $('#books')
                    .append('<tr><td>'+newIndex+'</td><td>'+$('#name').val()+'</td><td>'+$('#opis').val()+'</td><td>'+$('#author').val()+'</td><td><button class ="remove" book-Id'+newIndex.id+'>x</button><button>Edit</button></td></tr>');
                $('#addBookForm').reset();

            });

    });


    $('#books').delegate('.remove', 'click', function () {

        var $tr = $(this).closest('tr');

        $.ajax({
            url:$url,
            method: 'DELETE',
            data: $(this).attr('book-id'),
            dataType:'html',
            success: function(){

                $tr.fadeOut(400, function(){
                    $(this).remove();
                });

            }

        });





    });

    $('#books').delegate('.bookEdit', 'click', function(){
        var $tr = $(this).closest('tr');
        $tr.find('input.name').val($tr.find('span.name').html() );
        $tr.find('input.opis').val($tr.find('span.opis').html() );
        $tr.find('input.author').val($tr.find('span.author').html() );
        $tr.addClass('edit');

    })

    $('#books').delegate('.cancelEdit', 'click', function(){
        $(this).closest('tr').removeClass('edit');

    })

















});