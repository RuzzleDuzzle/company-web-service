(function () {
  var as = angular.module('myApp', ['ngRoute', 'myApp.services', 'myApp.controllers']);

  as.value('version', '1.4.8');

  as.config(function ($routeProvider, $locationProvider, $httpProvider) {

    $routeProvider
      .when('/companies', {templateUrl: 'partials/companies.html'})
      .when('/new', {templateUrl: 'partials/new.html'})
      .when('/edit/:id', {templateUrl: 'partials/edit.html'})
      .when('/company/:id', {templateUrl: 'partials/company.html'})
      .otherwise({redirectTo: '/'});
  });

  as.config(function(envServiceProvider) {
    envServiceProvider.config({
      domains: {
        development: ['localhost'],
        production: ['company-web-service.herokuapp.com']
      },
      vars: {
        development: {
          apiUrl: '//localhost'
        },
        production: {
          apiUrl: '//company-web-service.herokuapp.com'
        }
      }
    });

    envServiceProvider.check();
  });

}());
