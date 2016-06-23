//'use strict';
//
//var app = angular.module('test-app', ['ui.utils']);
//app.config(function($interpolateProvider) {
//    $interpolateProvider.startSymbol('[[');
//    $interpolateProvider.endSymbol(']]');
//});
//
//app.controller('ctrlGallery', function($scope, $http) {
//    $http.get('/gallery/galleryJson').success(function(albums) {
//        $scope.albums = albums;
//    });
//});

$(function(){
    $('.albumImages').waypoint(function(){
        $(this.element).children().addClass('fadeIn');
    },{offset: '100%'});

});