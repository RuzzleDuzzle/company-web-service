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

  //as.config(function($httpProvider) {
  //  //$httpProvider.interceptors.push('xdebugInterceptor');
  //  //$httpProvider.interceptors.push(function($q) {
  //  //  return {
  //  //    'request': function(config) {
  //  //      return config || $q.when(config);
  //  //    },
  //  //    'response': function(response) {
  //  //      return response || $q.when(response);
  //  //    }
  //  //  }
  //  //});
  //
  //});

}());
