
var fileUploader = function () {};

fileUploader.init = function () {
    var element$ = $('#browse');
    var uploader = new plupload.Uploader({
        browse_button: element$.get(0), // this can be an id of a DOM element or the DOM element itself
        url: element$.data('action')+'&_method=PUT',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    uploader.init();
    uploader.bind('FilesAdded', function(up, files) {
        var html = '';
        plupload.each(files, function(file) {
            html += '<span id="' + file.id + '">' + file.name + ' (' + plupload.formatSize(file.size) + ') <b></b></span>';
        });
        document.getElementById('fileDetails').innerHTML += html;
        uploader.start();
    });
    uploader.bind('UploadProgress', function(up, file) {
        document.getElementById(file.id).getElementsByTagName('b')[0].innerHTML = '<span>' + file.percent + "%</span>";
    });
    uploader.bind('FileUploaded', function(up, file, response) {
        $('#avatar').attr('src', $.parseJSON(response.response).result.url);
        $(document.getElementById(file.id)).fadeOut();
    });
    uploader.bind('UploadComplete', function(up, file, response) {
        if ( typeof response  == 'undefined' ) {
            console.log('Something is wrong with image adding');
            return false;
        }
        location.reload();
    });
};
