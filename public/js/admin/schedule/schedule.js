$(function(){
    $('[data-toggle="popover"]').popover();

    jQuery.datetimepicker.setLocale('ru');
    $('#date').datetimepicker({
        format:'Y-m-d H:i',
        step: 15,
        allowTimes: window.allowedTime.get(),
        minTime: '08:00',
        maxTime: '17:30',
        onSelectDate: function(currentDate, $input){
            angular.element($input).triggerHandler('change');
        },
        onSelectTime: function (currentTime, $input){
            angular.element($input).triggerHandler('change');
        }
    });

    $('.add-visit').click(function(e){
        var date$ = $('.new-visit-form').find('[name=date]').val($(this).data('time'));
        var doc$  = $('.new-visit-form').find('[name=doctorId]').val($(this).data('doctor-id'));

        angular.element(date$).triggerHandler('change');
        angular.element(doc$).triggerHandler('change');
    });
});