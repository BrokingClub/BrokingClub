'use strict';

(function(){
	var app = angular.module('app', ['ngRoute']);
	
	app.config(function($routeProvider){
		$routeProvider.
			when('/feature/:feature', {
				templateUrl: 'views/feature.html',
				controller: 'feature'
			}).
			otherwise({
				redirectTo: '/'
			});
	});
	
	app.factory('feature', function(){
		return { name: '' };
	});
	
	app.controller('controller', function($scope, $http, feature){
		$http.get('/api/cucumber/features').success(function(features){
			$scope.features = features;
		});
		
		$scope.isCurrent = function(featureName){
			return featureName === feature.name ? 'active' : '';
		};
	});
	
	app.controller('feature', function($routeParams, $scope, $http, feature){
		feature.name = $routeParams.feature;
		
		$http.get('/api/cucumber/features/' + feature.name).success(function(featureText){
			$scope.featureText = featureText;
		});
		
		$http.get('/api/cucumber/features/' + feature.name + '/test').success(function(data){
			$scope.stdout = data.stdout;
			$scope.stderr = data.stderr;
		});
		
		$scope.getProgressClass = function(){
			if(isTesting()){
				return 'progress-bar-striped active';
			}else{
				var failed = $scope.stdout.toLowerCase().indexOf('failed') > -1;
			
				if(failed){
					return 'progress-bar-danger';
				}else{
					return 'progress-bar-success';
				}
			}
		};
		
		$scope.getProgressText = function(){
			return isTesting() ? 'Crunching the latest data, just for you. Hang tight...' : '';
		};
		
		function isTesting(){
			return !$scope.stdout;
		}
	});
}());