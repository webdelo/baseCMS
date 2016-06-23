$(function(){

    $('.employee:odd').waypoint(function(){
        $(this.element).addClass('fadeInRight');
    },{offset: '100%'});
    $('.employee:even').waypoint(function(){
        $(this.element).addClass('fadeInLeft');
    },{offset: '100%'});

});