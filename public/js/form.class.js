var form = function ( form$ ) {
    var fieldSelector = 'input[type=text]:not(form-exclude):visible,input[type=password]:not(form-exclude):visible,input[type=hidden]:not(form-exclude),input:not(form-exclude):checkbox:checked:visible,textarea:not(form-exclude):visible,select:not(form-exclude):visible,textarea.transformer:not(form-exclude):hidden,input.transformer:not(form-exclude):hidden,select.transformer:not(form-exclude):hidden,form-important:hidden';

    this.init = function () {
        getSubmit().click(submit);
    };

    function submit(e) {
        $.ajax(getAction(), {
            dataType : getDataType(),
            method   : getMethod(),
            data     : getData()
        }).done(formSuccess).fail(formError);

        if ($.isFunction(e) ) {
            e.stopPropagation();
        }
    }

    function getSubmit() {
        if ( typeof form$.data('submit') == 'undefined' ) {
            return form$.find('form-submit');
        }
        return $( '.'+form$.data('submit') );
    }

    function getAction () {
        return form$.is('form') ? form$.attr('action') : form$.data('action');
    }

    function getDataType () {
        return ( typeof form$.data('type') == 'undefined' )
            ? 'json'
            : form$.data('type');
    }

    function getMethod () {
        return ( typeof form$.data('method') == 'undefined' )
            ? 'post'
            : form$.data('method');
    }

    function getData () {
        var data;
        if ( form$.is('form') ) {
            data = form$.serialize();
        } else {
            data = form$.find(fieldSelector).serialize();
        }
        return data;
    }

    function formSuccess (response) {
        location.reload();
    }

    function formError (response) {
        console.log(response);
    }

    this.init();
};


