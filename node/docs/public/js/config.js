'use strict';

module.exports = /*@ngInject*/ function($routeProvider){
    $routeProvider
        .when('/', {
            templateUrl: 'views/dashboard.html',
            name: 'Dashboard'
        })
        .when('/cucumber/:feature?', {
            templateUrl: 'views/cucumber.html',
            controller: 'CucumberController',
            name: 'Cucumber testing'
        })
        .when('/linesofcode', {
            templateUrl: 'views/lines-of-code.html',
            controller: 'LinesOfCodeController',
            name: 'Lines of code'
        })
        .otherwise({
            redirectTo: '/'
        });
};