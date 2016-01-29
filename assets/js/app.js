"use strict";

var impApplication = angular.module('impApplication', [
    'ui.router', 'ngCookies', 'ui.bootstrap', 'xeditable'
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
            })
            .state('nav.infos', {
                url: '/infos',
                templateUrl: 'views/userInfos.html'
            })
            .state('nav.guides', {
                url: '/guides',
                templateUrl: 'views/userGuides.html'
            });
    })
    .constant("config", {
        "baseUrl": "http://localhost/impadmin/api"
    });

impApplication.run(function(editableOptions) {
    editableOptions.theme = 'bs3';
});

impApplication.controller("LoginController",
    function($scope, $http, loginFactory, $cookies, $state, $rootScope) {
        $scope.handleLoginBtnClick  = function (user) {
            var credentials = {
                email: user.email,
                password: user.password
            };
            loginFactory.login(credentials)
                .success(function (data) {
                    if (data) {
                        $rootScope.user = data;
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
    function($scope, $rootScope, $http, addStandingFactory, deleteStandingFactory, standingsFactory, $cookies, $state, config, $window) {
        $scope.classes = [
            {value: 'Assassin', text: 'Assassin'},
            {value: 'Blade Dancer', text: 'Blade Dancer'},
            {value: 'Blade Master', text: 'Blade Master'},
            {value: 'Destroyer', text: 'Destroyer'},
            {value: 'Force Master', text: 'orce Master'},
            {value: 'Kung Fu Master', text: 'Kung Fu Master'},
            {value: 'Summoner', text: 'Summoner'}
        ];
        $scope.regions = [
            {value: 'na', text: 'North America'},
            {value: 'eu', text: 'Europe'}
        ];
        $scope.handleStandingsBtnClick  = function (standings) {
            var url = config.baseUrl + "/standings/"+standings.month+"/"+standings.region;
            $scope.month = standings.month;
            $scope.region = standings.region;
            standingsFactory.standings(url)
                .success(function (data) {
                    $rootScope.rankings = data;
                })
                .error(function (data) {
                    $rootScope.rankings = data;
                });
        };
        if ($rootScope.user.status == 'admin') {
            $scope.deleteStanding = function (standing) {
                var info = {id: standing.id, name: standing.name, month: $scope.month};
                if ($window.confirm("Do you really want to delete "+standing.name +" \n Please note that this action is not reversible !") == true) {
                    deleteStandingFactory.delete(info);
                    var url = config.baseUrl + "/standings/"+$scope.month+"/"+$scope.region;
                    standingsFactory.standings(url)
                        .success(function (data) {
                            $rootScope.rankings = data;
                        })
                        .error(function (data) {
                            $rootScope.rankings = data;
                        });
                }
            };
            $scope.editStandingName = function (data, id) {
                var info = {name: data, id: id, month: $scope.month};
                var url = config.baseUrl + "/standing/editName";
                $http.post(url, info);
            };
            $scope.editStandingClass = function (data, id) {
                var info = {class: data, id: id, month: $scope.month};
                var url = config.baseUrl + "/standing/editClass";
                $http.post(url, info);
            };
            $scope.editStandingPoints = function (data, id) {
                var info = {points: data, id: id, month: $scope.month};
                var url = config.baseUrl + "/standing/editPoints";
                $http.post(url, info);
            };
            $scope.editStandingProfile = function (data, id) {
                var info = {profile: data, id: id, month: $scope.month};
                var url = config.baseUrl + "/standing/editProfile";
                $http.post(url, info);
            };
            $scope.editStandingRegion = function (data, id) {
                var info = {region: data, id: id, month: $scope.month};
                var url = config.baseUrl + "/standing/editRegion";
                $http.post(url, info);
            }
        }
    });

impApplication.controller("AddStandingController",
    function ($scope, $modal, $log) {
        $scope.showForm = function () {
            var modalInstance = $modal.open({
                templateUrl: 'views/createStanding.html',
                controller: ModalInstanceCtrl,
                scope: $scope,
                resolve: {
                    standingForm: function () {
                        return $scope.standingForm;
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


impApplication.controller("UserInfosController",
    function($scope, $rootScope, $http, config) {
        var url = config.baseUrl+"/userInfo/"+$rootScope.user.id;
        $http.get(url).then(function (data) {
            $scope.userInfos = data.data;
        });
        $scope.editUserDescription = function (data, id) {
            var info = {description: data, id: id};
            var url = config.baseUrl + "/user/editDescription";
            $http.post(url, info);
        };
        $scope.editUserFacebook = function (data, id) {
            var info = {facebook: data, id: id};
            var url = config.baseUrl + "/user/editFacebook";
            $http.post(url, info);
        };
        $scope.editUserGoogleplus = function (data, id) {
            var info = {googleplus: data, id: id};
            var url = config.baseUrl + "/user/editGoogleplus";
            $http.post(url, info);
        };
        $scope.editUserIntrovid = function (data, id) {
            var info = {introvid: data, id: id};
            var url = config.baseUrl + "/user/editIntrovid";
            $http.post(url, info);
        };
        $scope.editUserMention = function (data, id) {
            var info = {mention: data, id: id};
            var url = config.baseUrl + "/user/editMention";
            $http.post(url, info);
        };
        $scope.editUserTwitter = function (data, id) {
            var info = {twitter: data, id: id};
            var url = config.baseUrl + "/user/editTwitter";
            $http.post(url, info);
        };
        $scope.editUserYoutube = function (data, id) {
            var info = {youtube: data, id: id};
            var url = config.baseUrl + "/user/editYoutube";
            $http.post(url, info);
        };
    });


impApplication.controller("UserGuidesController",
    function ($scope, $rootScope, $http, config, $window) {
        $scope.classes = [
            {value: 'Assassin', text: 'Assassin'},
            {value: 'Blade Dancer', text: 'Blade Dancer'},
            {value: 'Blade Master', text: 'Blade Master'},
            {value: 'Destroyer', text: 'Destroyer'},
            {value: 'Force Master', text: 'orce Master'},
            {value: 'Kung Fu Master', text: 'Kung Fu Master'},
            {value: 'Summoner', text: 'Summoner'}
        ];
        var url = config.baseUrl+"/user/guides/"+$rootScope.user.id;
        $http.get(url).then(function (data) {
            $rootScope.guides = data.data;
        });
        $scope.editGuideClass= function (data, id) {
            var info = {class: data, id: id};
            var url = config.baseUrl + "/user/guide/editClass";
            $http.post(url, info);
        };
        $scope.editGuideTitle= function (data, id) {
            var info = {title: data, id: id};
            var url = config.baseUrl + "/user/guide/editTitle";
            $http.post(url, info);
        };
        $scope.editGuideDescription = function (data, id) {
            var info = {description: data, id: id};
            var url = config.baseUrl + "/user/guide/editDescription";
            $http.post(url, info);
        };
        $scope.editGuideVideo = function (data, id) {
            var info = {video: data, id: id};
            var url = config.baseUrl + "/user/guide/editVideo";
            $http.post(url, info);
        };
        $scope.editGuideIframe = function (data, id) {
            var info = {iframe: data, id: id};
            var url = config.baseUrl + "/user/guide/editIframe";
            $http.post(url, info);
        };
        $scope.deleteGuide = function (guideID) {
            if ($window.confirm("Do you really want to delete this guide ? \n Please note that this action is not reversible !") == true) {
                var urlDelete = config.baseUrl+"/user/guide/delete/"+guideID;
                $http.get(urlDelete);
                var url = config.baseUrl+"/user/guides/"+$rootScope.user.id;
                $http.get(url).then(function (data) {
                    $rootScope.guides = data.data;
                });
            }
        };
    });


impApplication.controller("AddUserGuideController",
    function ($scope, $modal, $log) {
        $scope.showForm = function () {
            var modalInstance = $modal.open({
                templateUrl: 'views/createGuide.html',
                controller: ModalGuideCtrl,
                scope: $scope,
                resolve: {
                    guideForm: function () {
                        return $scope.guideForm;
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

var ModalGuideCtrl = function ($scope, $rootScope, $http, $modalInstance, guideForm, config, addGuideFactory) {
    $scope.form = {};
    $scope.submitForm = function (guide) {
        var newGuide = {
            class: guide.class,
            title: guide.title,
            description: guide.description,
            video: guide.video,
            iframe: guide.iframe,
            userId: $rootScope.user.id
        };
console.log(newGuide);
        addGuideFactory.add(newGuide)
            .success(function (data) {
                if (data == "") { //will return nothing if success
                    $modalInstance.close('closed');
                    var url = config.baseUrl+"/user/guides/"+$rootScope.user.id;
                    $http.get(url).then(function (data) {
                        $rootScope.guides = data.data;
                    });
                }
            })
            .error(function (data) {
                console.log(data);
            });


    };


    $scope.cancel = function () {
        $modalInstance.dismiss('cancel');
    };
};


var ModalInstanceCtrl = function ($scope, $rootScope, $modalInstance, standingForm, addStandingFactory, standingsFactory, config) {
    $scope.form = {};
    $scope.submitForm = function (standing) {
        var newStanding = {
            name: standing.name,
            class: standing.class,
            points: standing.points,
            profile: standing.profile,
            region: standing.region,
            month: standing.month
        };

        addStandingFactory.add(newStanding)
            .success(function (data) {
                if (data == "") { //will return nothing if success
                    $modalInstance.close('closed');
                    var url = config.baseUrl + "/standings/"+standing.month+"/"+standing.region;
                    standingsFactory.standings(url)
                        .success(function (data) {
                            $rootScope.rankings = data;
                        });
                }
            })
            .error(function (data) {
                console.log(data);
            });

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

impApplication.factory('addGuideFactory',
    function (config, $http) {
        var url = config.baseUrl + "/user/guide/add";
        return {
            add: function(params) {
                return $http.post(url, params)
            }
        }
    });

impApplication.factory('deleteStandingFactory',
    function (config, $http) {
        var url = config.baseUrl + "/standing/delete";
        return {
            delete: function(params) {
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