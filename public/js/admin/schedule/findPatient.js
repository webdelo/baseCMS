var scheduleApp = angular.module('scheduleApp', ['ui.router', 'internationalPhoneNumber'], function ($interpolateProvider, $httpProvider) {
    $interpolateProvider.startSymbol('{%');
    $interpolateProvider.endSymbol('%}');

    $httpProvider.defaults.headers.post['Content-Type'] = 'application/x-www-form-urlencoded;charset=utf-8';

    // Переопределяем дефолтный transformRequest в $http-сервисе
    $httpProvider.defaults.transformRequest = [function(data)
    {
        /**
         * рабочая лошадка; преобразует объект в x-www-form-urlencoded строку.
         * @param {Object} obj
         * @return {String}
         */
        var param = function(obj)
        {
            var query = '';
            var name, value, fullSubName, subValue, innerObj, i;

            for(name in obj)
            {
                value = obj[name];

                if(value instanceof Array)
                {
                    for(i=0; i<value.length; ++i)
                    {
                        subValue = value[i];
                        fullSubName = name + '[' + i + ']';
                        innerObj = {};
                        innerObj[fullSubName] = subValue;
                        query += param(innerObj) + '&';
                    }
                }
                else if(value instanceof Object)
                {
                    for(subName in value)
                    {
                        subValue = value[subName];
                        fullSubName = name + '[' + subName + ']';
                        innerObj = {};
                        innerObj[fullSubName] = subValue;
                        query += param(innerObj) + '&';
                    }
                }
                else if(value !== undefined && value !== null)
                {
                    query += encodeURIComponent(name) + '=' + encodeURIComponent(value) + '&';
                }
            }

            return query.length ? query.substr(0, query.length - 1) : query;
        };

        return angular.isObject(data) && String(data) !== '[object File]' ? param(data) : data;
    }];
});

scheduleApp.config(function($stateProvider, $urlRouterProvider, ipnConfig){
    $urlRouterProvider.otherwise("/");

    ipnConfig.allowExtensions = false;
    ipnConfig.autoFormat = true;
    ipnConfig.autoHideDialCode = false;
    ipnConfig.defaultCountry = "md";
    ipnConfig.ipinfoToken = "yolo";
    ipnConfig.nationalMode = true;
    ipnConfig.numberType = "MOBILE";
    ipnConfig.onlyCountries = ['ru', 'md', 'ro', 'uk', 'it'];
    ipnConfig.preferredCountries = ['md', 'ru'];
    ipnConfig.utilsScript = "/build/js/utils.js";




    $stateProvider
        .state('today', {
            url : '/',
            templateUrl : '/admin/schedule/show',
            controller  : 'visitsList'
        })
        .state('date', {
            url : '/:date',
            templateUrl : '/admin/schedule/show',
            controller  : 'visitsList'
        });
});

scheduleApp.controller('visitsList', function ($scope, $http, $stateParams) {
    var today = new Date(),
        day   = today.getDate(),
        month = today.getMonth() + 1,
        year  = today.getFullYear();
        today = day+'-'+month+'-'+year;

    $scope.currentDate = $stateParams.date ? $stateParams.date : today;

    function reloadVisitsList()
    {
        $scope.schedule = {};
        $http.get('/admin/schedule/json/date/'+$scope.currentDate).then(function(response){
            $scope.schedule = response.data;
            $scope.prevDate = response.data.prevDate;
            $scope.nextDate = response.data.nextDate;
            $scope.times    = response.data.times;
            $scope.date     = response.data.date;
            $scope.doctors  = response.data.doctors;
        },function(response){
            console.log('Error with gettings visits list');
        });
    }
    reloadVisitsList();

    $scope.visit = {
        patient   : {},
        patientId : 0
    };

    $http.get('/admin/schedule/json/doctors').then(function(response){
        $scope.doctors = response.data;
    });

    $scope.changedDate = function(){
        console.log('changedDate');
    };

    $scope.changedDoctor = function(){
        console.log('changedDoctor', $scope.visit.doctorId);
    };

    $scope.searchByPhone = function () {
        if ( !$scope.visit.phone ) {
            $scope.foundByPhone = [];
            return;
        }
        if ( $scope.visit.phone.length > 3  ) {
            $http.get('/admin/schedule/json/patients?phone='+$scope.visit.phone).then(function(response){
                $scope.foundByPhone = response.data;
            });
            $scope.visit.patient.phone  = angular.copy($scope.visit.phone);
        }
        //$('.selectPatient').parents('.newContainer .patientRow').removeClass('selected');
        $scope.visit.patientId = 0;
    };

    $scope.searchByName = function () {
        if ( !$scope.visit.firstname && !$scope.visit.lastname && !$scope.visit.patronymic ) {
            $scope.foundByName = [];
            return;
        }
        var name = {
            'firstname'  : $scope.visit.firstname,
            'lastname'   : $scope.visit.lastname,
            'patronymic' : $scope.visit.patronymic
        };
        $scope.visit.patient.firstname  = angular.copy($scope.visit.firstname);
        $scope.visit.patient.lastname   = angular.copy($scope.visit.lastname);
        $scope.visit.patient.patronymic = angular.copy($scope.visit.patronymic);
        $http.get('/admin/schedule/json/patients?'+ $.param(name) ).then(function(response){
            $scope.foundByName = response.data;
        });
        //$('.selectPatient').parents('.newContainer .patientRow').removeClass('selected');
        $scope.visit.patientId = 0;
    };

    $scope.selectPatient = function( patient, event ){
        $scope.visit.patientId  = patient.id;
        $('.selectPatient').parents('.patientRow').removeClass('selected');
        $(event.currentTarget).parents('.patientRow').addClass('selected');
    };
    $scope.chooseNewPatient = function( event ){
        $scope.visit.patientId  = 0;
        $('.selectPatient').parents('.patientRow').removeClass('selected');
        $(event.currentTarget).parents('.patientRow').addClass('selected');
    };

    $scope.createNewVisit = function(){
        if ( $scope.newVisitForm.$invalid & !$scope.visit.patientId ) {
            console.log('Error in form');
        } else {
            $http.post('/admin/schedule', $scope.visit)
                .then(function(response){
                    if ( angular.isNumber(response.data) ) {
                        reloadVisitsList();
                    }
                });
        }
    };

    $scope.changeCurrentDate = function(date){
        $scope.currentDate = date.dmy;
        reloadVisitsList();
    };

    $scope.presetVisit = function (doctorId, time) {
        $scope.visit.doctorId = doctorId;
        $scope.visit.date = time;
        console.log($scope.visit);
    }
});

//scheduleApp.controller('newVisitController', function ($scope, $http, $rootScope) {
//
//});