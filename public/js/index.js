$(function(){

    $('.most-useful-services').waypoint(function(){
        $('.most-useful-services').find('.animated').addClass('fadeInUp');
    },{offset: '100%'});

    $('.most-useful-services').waypoint(function(){
        $('.most-useful-services').find('.animated').addClass('bounce');
    },{offset: '10%'});

    $('.welcomeContainer').waypoint(function(){
        $('.welcomeContainer').find('img.animated').addClass('slideInLeft');
        $('.welcomeContainer').find('.mainArticle.animated').addClass('slideInRight');
    },{offset: '80%'});

});