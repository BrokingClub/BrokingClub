'use strict';

(function(){
	var app = angular.module('app', ['ngRoute']);
	
	app.config(function($routeProvider){
		$routeProvider
            .when('/', {
                templateUrl: 'views/dashboard.html',
                controller: 'DashboardController'
            })
            .when('/cucumber/:feature', {
                templateUrl: 'views/cucumber.html',
                controller: 'CucumberController'
            })
            .when('/linesofcode', {
                templateUrl: 'views/lines-of-code.html',
                controller: 'LinesOfCodeController'
            })
            .otherwise({
				redirectTo: '/'
			});
	});
	
	app.factory('feature', function(){
		return { name: '' };
	});

    app.run(function($rootScope){
        $rootScope.currentPage = 'Dashboard';
    });

    app.controller('DashboardController', function($scope){

    });

    app.controller('LinesOfCodeController', function($scope){

    });

	app.controller('CucumberController', function($routeParams, $scope, $http, $interval, feature){
		$http.get('/api/cucumber/features').success(function(features){
			$scope.features = features;
		});
		
		$scope.isCurrent = function(featureName){
			return featureName === feature.name ? 'active' : '';
		};

        feature.name = $routeParams.feature;
        $scope.output = '';
        $scope.testing = true;

        $http.get('/api/cucumber/features/' + feature.name).success(function(data){
            $scope.featureText = data.feature;
            $scope.source = data.source;

            setTimeout(function(){
                $('div.gherkin, div.javascript').each(function(i, block){
                    hljs.highlightBlock(block);
                });
            }, 1);
        });

        var socket = io.connect();

        socket.emit('feature', feature.name);
        socket.on('data', function(data){
            $scope.$apply(function(){
                $scope.output += data;
            });
        });
        socket.on('end', function(){
            $scope.testing = false;
        });

        $scope.progressText = function(){
            return $scope.testing ? 'Crunching the latest data, just for you. Hang tight...' : '';
        };

        $scope.progressClass = function(){
            return $scope.testing ? 'progress-bar-striped active' : 'progress-bar-success';
        };

        $interval(function(){
            $scope.cursor = !$scope.cursor;
        }, 500);
	});
}());