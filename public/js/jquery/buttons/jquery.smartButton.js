(function($){
    $.fn.smartButton = function (options) {
        if ( $(this).length <= 0 ) {
            return this;
        }

        var settings = $.extend({
            'callback'   : null
        }, options||{});

        var button = function () {};

        button.init = function ( this$ ) {
            button.setButton(this$).alarm();
            $('body').on('click', '#'+button.getButton().attr('id'), button.run);
        };

        button.runTest = function (e) {
            console.log( e );
        };

        button.alarm = function () {
            if ( button.isIdentified() ) {
                throw 'You should add id attribute to target DOM-object ' + this.getButton().attr('class');
            }
            return button;
        };

        button.isIdentified = function(){
            return typeof this.getButton().attr('id') == 'undefined';
        };

        button.setButton = function(this$){
            button.button$ = this$;
            return button;
        };

        button.getButton = function(){
            return button.button$;
        };

        button.run = function (e) {
            button.setCallback().sendToServer();
            e.stopPropagation();
        };

        button.setCallback = function () {
            button.callback = button.getButton().data('callback');

            return button;
        };

        button.sendToServer = function () {
            $.post(button.getUrl(), button.render);
        };

        button.getUrl = function () {
            return button.getAction()+button.getPost()+button.getCSRF()+button.getMethod();
        };

        button.getAction = function () {
            var action = button.getButton().data('action').split('?');
            if ( action.length > 1 ) {
                console.log('Here\'s a problem! You should not send any parameters using URI query string.');
            }
            return action.shift();
        };

        button.getPost = function () {
            if ( typeof button.getButton().data('post') == 'undefined' ) {
                console.log('Here\'s a problem! You must define any parameters to post to Server');
                return '?';
            }
            return '?' + button.getButton().data('post');
        };

        button.getMethod = function () {
            if ( typeof button.getButton().data('method') == 'undefined') {
                console.log('You can change method using data-method parameter to button DOM-object ' + button.getButton().attr('class') );
                return '&_method=PUT';
            }
            return '&_method='+button.getButton().data('method');
        };

        button.getCSRF = function () {
            if ( $('[name=csrf-token]').length == 0 ) {
                console.log('You should use CSRF token to improve safety of your POST actions');
            }
            return '&_token='+$('[name=csrf-token]').attr('content');
        };

        button.render = function (response) {
            if ( typeof response == 'boolean' ) {
                var callback = button.callback.split('.');
                window[callback[0]][callback[1]].call(button, response);
            }
        };

        button.init( $(this) );

        return this;
    }
})(jQuery);