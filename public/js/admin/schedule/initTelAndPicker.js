$(function(){
    $("#phone").intlTelInput({
        allowExtensions: false,
        autoFormat: true,
        autoHideDialCode: false,
        defaultCountry: "md",
        ipinfoToken: "yolo",
        nationalMode: true,
        numberType: "MOBILE",
        onlyCountries: ['ru', 'md', 'ro', 'uk', 'it'],
        preferredCountries: ['md', 'ru'],
        utilsScript: "/build/js/utils.js"
    });

    $('.datetimepickers').datetimepicker({
        formatDate : 'd-m-Y',
        formatTime : 'H:i'
    });

});
