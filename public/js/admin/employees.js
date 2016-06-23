$(function(){
    objectsView.init();
});

var objectsView = function () {};
objectsView.settings = {
    'deleteButton'   : '.delete',
    'listRow'        : '.listRow',
    'container'      : '.listContainer',
    'errorContainer' : '.error'
};

objectsView.init = function () {
    objectsView.initDelete();

    return objectsView;
};

objectsView.getDeleteButton = function() {
    return $(objectsView.settings.deleteButton);
};

objectsView.initDelete = function () {
    objectsView.getDeleteButton().click(objectsView.deleteHandler);

    return objectsView;
};

objectsView.getRow = function () {
    return $(objectsView.settings.listRow);
};

objectsView.getRowByDeleteButton = function (button$) {
    return button$.parents(objectsView.settings.listRow);
};

objectsView.deleteHandler = function(){
    if ( typeof $(this).data('confirm') == 'undefined' ) {
        objectsView.delete.call(this);
    } else {
        if ( confirm($(this).data('confirm')) ) {
            objectsView.delete.call(this);
        }
    }

};
objectsView.delete = function () {
    $.post( $(this).data('action'), $(this).data('post'), $.proxy(objectsView.deleteCallback, this));
};

objectsView.deleteCallback = function (response) {
    var that = this;
    if ( typeof response === 'boolean' ) {
        objectsView.getRowByDeleteButton($(that)).fadeOut(200, function () { $(this).remove(); });
    } else {
        objectsView.errorMessage(response.error);
    }
};

objectsView.errorMessage = function(text){
    objectsView.getErrorContainer().text(text).fadeIn(400, function(){
        var that = this;
        setInterval(function(){ $(that).fadeOut(300) }, 8000);
    });
};

objectsView.getErrorContainer = function() {
    return $(objectsView.settings.errorContainer);
};