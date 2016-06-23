var sorting = function () {
    var onUpdate = function(event, ui){
        var data = '';
        getObject().children().each(function(){
            data += '&images['+$(this).data('id')+']='+$(this).index();
        });
        data += '&_token='+$('[name=csrf-token]').attr('content');
        data += '&_method=PUT';
        $.post(getObject().data('sorting-action') + data, onUpdateCallback);
    };

    var onUpdateCallback = function (response) {
        if ( response === true ) {
            console.log('Success! Images priorities have been changed');
        } else {
            console.log('Error! Images priorities have not been changed');
        }

    };

    var getObject = function () {
        return $('#sortable');
    };

    this.init = function () {
        getObject().sortable({
            placeholder: "ui-state-highlight",
            update: onUpdate
        });
    };
};