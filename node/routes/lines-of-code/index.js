var loc = require('loc');
var config = require.main.require('./modules/config');
var youtrack = require('./youtrack');
var cache;
var oneHourDelay = 60 * 60 * 1000;

module.exports = function(app){
    app.get('/api/linesofcode', handleRequest);
    app.get('/api/linesofcode/csv', csv);
};

refreshTasks();
setInterval(refreshTasks, oneHourDelay);

function handleRequest(req, res){
    if(cache){
        res.json(cache);
    }else{
        setTimeout(function(){
            handleRequest(req, res);
        }, 1000);
    }
}

function getTasks(cb){
    var options = {
        repository: 'BrokingClub/BrokingClub',
        githubToken: config.githubToken
    };

    loc(options, function(err, issues){
        if(err) return cb(err);

        youtrack.getTasks(issues, cb);
    });
}

function refreshTasks(){
    var label = 'Refresh tasks';

    console.time(label);

    getTasks(function(err, tasks){
        if(err) throw err;

        cache = {
            data: tasks,
            created: new Date()
        };

        console.timeEnd(label);
    });
}

function csv(req, res){
    if(cache){
        var lines = [];

        cache.data.forEach(function(task){
            lines.push(task.id + ';' + task.summary + ';' + task.lines + ';' + task.spentTime);
        });

        res.attachment('linesofcode.csv');
        res.set('Content-Type', 'text/csv');
        res.send(lines.join('\n'));
    }else{
        setTimeout(function(){
            csv(req, res);
        }, 1000);
    }
}