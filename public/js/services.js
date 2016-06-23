$(function(){

    $('.service').waypoint(function(){
        $(this.element).addClass('fadeInUp');
    },{offset: '100%'});

});