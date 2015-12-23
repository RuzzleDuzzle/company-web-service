(function () {

  var
  //the HTTP headers to be used by all requests
    httpHeaders,
  //the message to be shown to the user
    message,
    as = angular.module('myApp', ['ngRoute', 'myApp.controllers']);

  as.value('version', '1.4.8');

  as.config(function ($routeProvider, $locationProvider, $httpProvider) {

    $routeProvider
      .when('/companies', {templateUrl: 'partials/companies.html'})
      .when('/new', {templateUrl: 'partials/new.html'})
      .when('/edit/:id', {templateUrl: 'partials/edit.html'})
      .when('/company/:id', {templateUrl: 'partials/company.html'})
      .otherwise({redirectTo: '/'});
    //$httpProvider.defaults.useXDomain = true;
    //delete $httpProvider.defaults.headers.common["X-Requested-With"];

  });

  //as.config(function($httpProvider) {
  //
  //  $httpProvider.interceptors.push(function($q) {
  //    return {
  //      'request': function(config) {
  //        return config || $q.when(config);
  //      },
  //      'response': function(response) {
  //        return response || $q.when(response);
  //      }
  //    }
  //  });
  //
  //});

}());
