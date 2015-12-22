(function() {

  var
  //the HTTP headers to be used by all requests
    httpHeaders,
  //the message to be shown to the user
    message,
    as = angular.module('myApp', ['ui.router', 'myApp.controllers']);

  as.value('version', '1.0.7');

  as.config(function($stateProvider, $httpProvider) {
    $stateProvider
      .state('index', {
        url: '/companies',
        templateUrl: 'partials/companies.html',
        controller: 'CompanyListController'
        //views: {
        //  "viewA": { template: "index.viewA" },
        //  "viewB": { template: "index.viewB" }
        //}
      });
      //.state('route1', {
      //  url: "/route1",
      //  views: {
      //    "viewA": { template: "route1.viewA" },
      //    "viewB": { template: "route1.viewB" }
      //  }
      //})
      //.state('route2', {
      //  url: "/route2",
      //  views: {
      //    "viewA": { template: "route2.viewA" },
      //    "viewB": { template: "route2.viewB" }
      //  }
      //});

    //$routeProvider
    //  .when('/companies', {templateUrl: 'partials/companies.html', controller: 'CompanyListController'})
    //  .when('/new', {templateUrl: 'partials/new.html', controller: 'NewCompanyController'})
    //  .when('/edit/:id', {templateUrl: 'partials/edit.html', controller: 'EditCompanyController'})
    //  .when('/company/:id', {templateUrl: 'partials/album.html', controller: 'CompanyController'})
    //  .otherwise({redirectTo: '/'});
//        $httpProvider.defaults.useXDomain = true;
//        delete $httpProvider.defaults.headers.common["X-Requested-With"];
  });

  //as.config(function($httpProvider) {
  //
  //
  //  //configure $http to catch message responses and show them
  //  $httpProvider.responseInterceptors.push(
  //    function($q) {
  //      console.log('call response interceptor and set message...');
  //      var setMessage = function(response) {
  //        //if the response has a text and a type property, it is a message to be shown
  //        //console.log('@data'+response.data);
  //        if (response.data.message) {
  //          message = {
  //            text: response.data.message.text,
  //            type: response.data.message.type,
  //            show: true
  //          };
  //        }
  //      };
  //      return function(promise) {
  //        return promise.then(
  //          //this is called after each successful server request
  //          function(response) {
  //            setMessage(response);
  //            return response;
  //          },
  //          //this is called after each unsuccessful server request
  //          function(response) {
  //            setMessage(response);
  //            return $q.reject(response);
  //          }
  //        );
  //      };
  //    });
  //});

}());
