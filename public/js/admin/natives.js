/**
 * Created by rainx_000 on 05.11.2015.
 */
$(function(){

    $('.removeButton').click(function(){
        if ( confirm('Вы уверены?') ) {
            var that = this;
            $.post( $(this).data('action'), $(this).data('post'), function (response){
                $(that).parents('li').fadeOut();
            });
        }
    });
    $('.nativeButton').click(function(){
        var that = this;
        $.post( $(this).data('action'), $(this).data('post'), function (response){
            location.reload();
        });
    });

    $('[data-toggle="tooltip"]').tooltip();

});