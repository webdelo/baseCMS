(function($){
    $.fn.confirm = function (options) {
        if ( $(this).length <= 0 ) {
            return this;
        }

        var settings = $.extend({
            'duration'   : '400',
            'paddingTop' : '0',
            'callback'   : null
        }, options||{});

        if ( typeof $(this).attr('id') == 'undefined' ) {
            throw 'You should add id attribute to target DOM-object ' + $(this).attr('class');
        }

        $('body').on('click', '#'+$(this).attr('id'), function() {
            var default$      = $(this).children('.default');
            var confirmation$ = $(this).children('.confirmation');
            var cancel$       = confirmation$.children('.cancel');
            var confirm$      = confirmation$.children('.confirm');

            default$.addClass('hide');
            confirmation$.removeClass('hide');
            cancel$.attr('id', $(this).attr('id')+'Cancel');
            confirm$.attr('id', $(this).attr('id')+'Confirm');

            var label$ = $('<span class="badge">').attr('id', $(this).attr('id')+'Label').text('10');
            cancel$.append(label$);

            $(this).data('class', $(this).attr('class') )
                   .attr('class', '')
                   .css('display', 'inline-block');

            var that = this;
            $(this).data('interval', setInterval(function(){
                var counter = parseInt($(that).find( '#'+$(that).attr('id')+'Label').text());
                $(that).find( '#'+$(that).attr('id')+'Label').text(--counter);
            }, 1000) );
            $(this).data('timeout', setTimeout(function(){
                cancel$.click();
            }, 10000));
        });

        $('body').on('click', '#'+$(this).attr('id')+'Confirm', function(e) {
            e.stopPropagation();
        });

        $('body').on('click', '#'+$(this).attr('id')+'Cancel', function(e) {
            var button$ = $(this).parent().parent();
            button$.attr('class', button$.data('class') );
            $(this).parent().siblings('.default').removeClass('hide');
            $(this).parent('.confirmation').addClass('hide');
            $(this).parent().find( '#'+button$.attr('id')+'Label').remove();
            clearInterval(button$.data('interval'));
            clearTimeout(button$.data('timeout'));

            e.stopPropagation();
        });

        return this;
    }
})(jQuery);