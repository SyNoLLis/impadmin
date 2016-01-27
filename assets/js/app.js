"use strict";

var impApplication = angular.module('impApplication', [
    'ui.router', 'ngCookies', 'ui.bootstrap'
]);
impApplication
    .config(function($stateProvider, $urlRouterProvider, $locationProvider) {
        $urlRouterProvider.when('', '/');
        $stateProvider
            .state('index', {
                url: '/',
                templateUrl: 'views/login.html'
            })
            .state('nav', {
                url: '/',
                templateUrl: 'views/nav.html'
            })
            .state('nav.standings', {
                url: '/standings',
                templateUrl: 'views/standings.html'
            });
    })
    .constant("config", {
        "baseUrl": "http://localhost/impadmin/api"
    });

impApplication.controller("LoginController",
    function($scope, $http, loginFactory, $cookies, $state) {
        $scope.handleLoginBtnClick  = function (user) {
            var credentials = {
                email: user.email,
                password: user.password
            };
            loginFactory.login(credentials)
                .success(function (data) {
                    if (data) {
                        $cookies.put("id", data.id);
                        $cookies.put("username", data.username);
                        $cookies.put("status", data.status);
                        $state.transitionTo("nav");
                    }
                    else {
                        $state.transitionTo("index");
                    }
                })
                .error(function () {
                    $scope.loginError = true;
                });
        }
    });

impApplication.controller("StandingsController",
    function($scope, $http, addStandingFactory, standingsFactory, $cookies, $state, config) {
        $scope.handleStandingsBtnClick  = function (standings) {
            var url = config.baseUrl + "/standings/"+standings.month+"/"+standings.region;
            $scope.month = standings.month;
            $scope.region = standings.region;
            standingsFactory.standings(url)
                .success(function (data) {
                    $scope.rankings = data;
                })
                .error(function () {
                    $scope.standingsError = true;
                });
        };
    });

impApplication.controller("AddStandingController",
    function ($scope, $modal, $log) {

        $scope.showForm = function () {
            $scope.message = "Show Form Button Clicked";
            console.log($scope.message);

            var modalInstance = $modal.open({
                templateUrl: 'views/modal-form.html',
                controller: ModalInstanceCtrl,
                scope: $scope,
                resolve: {
                    userForm: function () {
                        return $scope.userForm;
                    }
                }
            });

            modalInstance.result.then(function (selectedItem) {
                $scope.selected = selectedItem;
            }, function () {
                $log.info('Modal dismissed at: ' + new Date());
            });
        };
    });

var ModalInstanceCtrl = function ($scope, $modalInstance, userForm) {
    $scope.form = {};
    $scope.submitForm = function () {
        if ($scope.form.userForm.$valid) {
            console.log('user form is in scope');
            $modalInstance.close('closed');
        } else {
            console.log('userform is not in scope');
        }
    };

    $scope.cancel = function () {
        $modalInstance.dismiss('cancel');
    };
};

impApplication.factory('loginFactory',
    function (config, $http) {
        var url = config.baseUrl + "/login";
        return {
            login: function(params) {
                return $http.post(url, params)
            }
        }
    });

impApplication.factory('standingsFactory',
    function ($http) {
        return {
            standings: function(url) {
                return $http.get(url)
            }
        }
    });

impApplication.factory('addStandingFactory',
    function (config, $http) {
        var url = config.baseUrl + "/standing/add";
        return {
            add: function(params) {
                return $http.post(url, params)
            }
        }
    });

impApplication.directive('modal', function () {
    return {
        template: '<div class="modal fade">' +
        '<div class="modal-dialog">' +
        '<div class="modal-content">' +
        '<div class="modal-header">' +
        '<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>' +
        '<h4 class="modal-title">{{ title }}</h4>' +
        '</div>' +
        '<div class="modal-body" ng-transclude></div>' +
        '</div>' +
        '</div>' +
        '</div>',
        restrict: 'E',
        transclude: true,
        replace:true,
        scope:true,
        link: function postLink(scope, element, attrs) {
            scope.title = attrs.title;

            scope.$watch(attrs.visible, function(value){
                if(value == true)
                    $(element).modal('show');
                else
                    $(element).modal('hide');
            });

            $(element).on('shown.bs.modal', function(){
                scope.$apply(function(){
                    scope.$parent[attrs.visible] = true;
                });
            });

            $(element).on('hidden.bs.modal', function(){
                scope.$apply(function(){
                    scope.$parent[attrs.visible] = false;
                });
            });
        }
    };
});