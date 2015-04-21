'use strict';

module.exports = /*@ngInject*/ function($scope, $http){
    $http.get('/api/linesofcode').success(function(data){
        $scope.data = data;

        _.forEach(data.data, function(task){
            task.created = new Date(parseInt(task.created, 10));
            var spentHours = task.spentTime / 60;
            task.lph = Math.floor(task.lines / spentHours);
        });
    });

    $scope.moment = function(date){
        if(date){
            return moment(date).fromNow();
        }
    };

    $scope.spentTime = function(minutes){
        if(minutes < 60){
            return minutes + ' minutes';
        }

        var hours = Math.floor(minutes / 60);
        minutes -= hours * 60;
        var spentTime = hours + ' ' + pluralize(hours, 'hour');

        if(minutes > 0){
            spentTime += ' ' + minutes + ' ' + pluralize(minutes, 'minute');
        }

        return spentTime;
    };
};

function pluralize(num, word){
    return num === 1 ? word : word + 's';
}