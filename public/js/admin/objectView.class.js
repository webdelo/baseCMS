var objectView  = function(){};
objectView.settings = {
    'form'           : '.objectForm',
    'submit'         : '.objectFormSubmit',
    'errorContainer' : '.error',
    'successContainer' : '.success'
};

objectView.init = function () {
    objectView.formInit();

    return objectView;
};

objectView.formInit = function () {
    objectView.getFormSubmit().click(function(){
        var data = objectView.getForm().serialize();
        $.ajax({
            'url'      : objectView.getForm().attr('action'),
            'data'     : data,
            'success'  : objectView.formCallback,
            'error'    : objectView.formCallback,
            'dataType' : 'json',
            'method'   : 'POST'
        });
        //$.post(objectView.getForm().attr('action'), data, objectView.formCallback);
        return false;
    });
};

objectView.formCallback = function (response) {
    if ( typeof response === 'number' ) {
        objectView.successMessage('Объект успешно сохранен!');
        if ( objectView.getForm().data('post-action') == 'reload' ) {
            location.href = objectView.getForm().attr('action')+'/'+response+'/edit';
        }
    } else if ( response == true ) {
        objectView.successMessage('Объект успешно сохранен!');
        //location.reload();
    } else {
        objectView.errorMessage(response.error);
    }
};

objectView.successMessage = function(text){
    objectView.getSuccessContainer().text(text).fadeIn(400, function(){
        var that = this;
        setInterval(function(){ $(that).fadeOut(300) }, 8000);
    });
};

objectView.getSuccessContainer = function () {
    return $(objectView.settings.successContainer);
};

objectView.errorMessage = function(text){
    objectView.getErrorContainer().text(text).fadeIn(400, function(){
        var that = this;
        setInterval(function(){ $(that).fadeOut(300) }, 8000);
    });
};

objectView.getErrorContainer = function () {
    return $(objectView.settings.errorContainer);
};

objectView.getForm = function () {
    return $(objectView.settings.form);
};

objectView.getFormSubmit = function () {
    return $(objectView.settings.submit);
};