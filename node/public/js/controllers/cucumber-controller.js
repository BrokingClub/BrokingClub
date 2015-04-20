'use strict';

module.exports = /*@ngInject*/ function($routeParams, $scope, $http, $interval){
    $scope.output = ' ';
    $scope.testing = false;

    $http.get('/api/cucumber/features').success(function(features){
        $scope.features = features;
    });

    $scope.isCurrent = function(feature){
        return feature === $scope.feature ? 'active' : '';
    };

    $scope.selectFeature = function(feature){
        $scope.feature = feature;
        $scope.testing = true;

        $http.get('/api/cucumber/features/' + $scope.feature).success(function(data){
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
    };

    $scope.progressText = function(){
        return $scope.testing ? 'Crunching the latest data, just for you. Hang tight...' : '';
    };

    $scope.progressClass = function(){
        return $scope.testing ? 'progress-bar-striped active' : 'progress-bar-success';
    };

    $interval(function(){
        $scope.cursor = !$scope.cursor;
    }, 500);

    if($routeParams.feature){
        $scope.selectFeature($routeParams.feature);
    }
};