/* http://jqueryajaxphp.com */

$(document).ready(function($) {
    $('.knob').each(function(){
        (function animateKnob(knob$) {
            var initval = parseInt(knob$.attr('data-targetValue'));

            $({value: 0}).animate({value: initval}, {
                duration: 1000,
                easing:'swing',
                step: function()
                {
                    knob$.val(this.value).trigger('change');
                }
            });
        })($(this));

        $(this).knob({
            value: 0,
            'readOnly': true,
            'width': 200,
            'height': 200,
            'dynamicDraw': true,
            'skin': 'tron'
        });
    });
    $("input.dial").change(function () {
        $(this).parent().siblings(".circle").find(".pie_value").text($(this).val() + "%");
    })
});

