(function () {
  var as = angular.module('myApp.services', []);

  as.factory('xdebugInterceptor', function($q) {
    return {
      'request': function(config) {
        config.params = config.params || {};
        config.params.XDEBUG_SESSION_START = "PHPSTORM";
        return config;
      }
    };
  });

}());
