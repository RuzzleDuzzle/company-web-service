(function () {
  var as = angular.module('myApp.controllers', []);
  as.controller('AppController', function ($scope, envService, $rootScope, $http, $location) {
    $scope.activeWhen = function (value) {
      return value ? 'active' : '';
    };

    $scope.path = function () {
      return $location.url();
    };

    $rootScope.appUrl = envService.read('apiUrl');
    $rootScope.serverUrl = "/companies/";

  });

  as.controller('CompanyListController', function ($scope, $rootScope, $http, $location) {
    var load = function () {
      $http.get($rootScope.appUrl + $rootScope.serverUrl)
        .success(function (data, status, headers, config) {
          $scope.companies = data.data;
          angular.copy($scope.companies, $scope.copy);
        });
    };

    load();

    $scope.addCompany = function () {
      $location.path("/new");
    };

    $scope.editCompany = function (index) {
      $location.path('/edit/' + $scope.companies[index].id);
    };

    $scope.delCompany = function (index) {
      var todel = $scope.companies[index];

      if (window.confirm("Are you sure that you want to delete company?")) {
        $http
          .delete($rootScope.appUrl + $rootScope.serverUrl + todel.id)
          .success(function (data, status, headers, config) {
            load();
          }).error(function (data, status, headers, config) {
        });
      }
    };

  });

  as.controller('NewCompanyController', function ($scope, $rootScope, $http, $location) {
    $scope.company = {};
    $scope.saveCompany = function () {

      if ($scope.newCompanyForm.$invalid) {
        return;
      }

      $http.post($rootScope.appUrl + $rootScope.serverUrl, $scope.company)
        .success(function (data, status, headers, config) {
          $location.path($rootScope.serverUrl);
        })
        .error(function (data, status, headers, config) {
          console.log('Error occurred');
        });
    };

    $scope.cancel = function () {
      $location.path($rootScope.serverUrl);
    };
  });

  as.controller('EditCompanyController', function ($scope, $rootScope, $http, $routeParams, $location) {
    $scope.company = {};

    var load = function () {
      $http.get($rootScope.appUrl + $rootScope.serverUrl + $routeParams['id'])
        .success(function (data, status, headers, config) {
          $scope.company = data.data;
          angular.copy($scope.company, $scope.copy);
        });
    };

    load();

    $scope.updateCompany = function () {
      if ($scope.editCompanyForm.$invalid) {
        console.log('Form is invalid');
        return;
      }

      $http.put($rootScope.appUrl + $rootScope.serverUrl + $scope.company.id, $scope.company)
        .success(function (data, status, headers, config) {
          $location.path($rootScope.serverUrl);
        })
        .error(function (data, status, headers, config) {
          console.log('Error occurred');
        });
    };

    $scope.cancelEdit = function () {
      $location.path($rootScope.serverUrl);
    };
  });

  as.controller('CompanyController', function ($scope, $rootScope, $http, $routeParams, $location) {
    $scope.company = {};

    var load = function () {
      $http.get($rootScope.appUrl + $rootScope.serverUrl + $routeParams['id'])
        .success(function (data, status, headers, config) {
          $scope.company = data.data;
          angular.copy($scope.company, $scope.copy);
        });
    };

    load();
  });

}());
