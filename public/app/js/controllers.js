(function () {
  var as = angular.module('myApp.controllers', []);
  as.controller('AppController', function ($scope, $rootScope, $http, $location) {
    $scope.activeWhen = function (value) {
      return value ? 'active' : '';
    };

    $scope.path = function () {
      return $location.url();
    };

//        $scope.login = function() {
//            $scope.$emit('event:loginRequest', $scope.username, $scope.password);
//            //$location.path('/login');
//        };

//        $scope.logout = function() {
//            $rootScope.user = null;
//            $scope.username = $scope.password = null;
//            $scope.$emit('event:logoutRequest');
//            $location.url('/');
//        };

    $rootScope.appUrl = "http://localhost";

  });

  as.controller('CompanyListController', function ($scope, $rootScope, $http, $location) {
    var load = function () {
      console.log('call load()...');
      $http.get($rootScope.appUrl + '/companies')
        .success(function (data, status, headers, config) {
          $scope.companies = data.data;
          angular.copy($scope.companies, $scope.copy);
        });
    }

    load();

    $scope.addCompany = function () {
      console.log('call addAlbum');
      $location.path("/new");
    }

    $scope.editCompany = function (index) {
      console.log('call editAlbum');
      $location.path('/edit/' + $scope.companies[index].id);
    }

    $scope.delCompany = function (index) {
      console.log('call delAlbum');
      var todel = $scope.companies[index];
      $http
        .delete($rootScope.appUrl + '/companies/' + todel.id)
        .success(function (data, status, headers, config) {
          load();
        }).error(function (data, status, headers, config) {
      });
    }

  });

  as.controller('NewCompanyController', function ($scope, $rootScope, $http, $location) {

    $scope.company = {};
    $scope.saveCompany = function () {
      console.log('call saveAlbum');
      $http.post($rootScope.appUrl + '/companies', $scope.company)
        .success(function (data, status, headers, config) {
          console.log('success...');
          $location.path('/companies');
        })
        .error(function (data, status, headers, config) {
          console.log('error...');
        });
    }
  });

  as.controller('EditCompanyController', function ($scope, $rootScope, $http, $routeParams, $location) {
    $scope.company = {};

    var load = function () {
      console.log('call load()...');
      $http.get($rootScope.appUrl + '/companies/' + $routeParams['id'])
        .success(function (data, status, headers, config) {
          $scope.company = data.data;
          angular.copy($scope.company, $scope.copy);
        });
    };

    load();

    $scope.updateCompany = function () {
      console.log('call updateAlbum');

      $http.put($rootScope.appUrl + '/companies/' + $scope.company.id, $scope.company)
        .success(function (data, status, headers, config) {
          $location.path('/companies');
        })
        .error(function (data, status, headers, config) {
        });
    }
  });

  as.controller('CompanyController', function ($scope, $rootScope, $http, $routeParams, $location) {
    $scope.company = {};

    var load = function () {
      console.log('call load()...');
      $http.get($rootScope.appUrl + '/companies/' + $routeParams['id'])
        .success(function (data, status, headers, config) {
          $scope.company = data;
          angular.copy($scope.company, $scope.copy);
        });
    };

    load();
  });

}());
