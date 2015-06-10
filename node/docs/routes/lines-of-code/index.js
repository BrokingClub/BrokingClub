var loc = require('loc');
var youtrack = require('./youtrack');
var cache;
var oneHourDelay = 60 * 60 * 1000;
var router = require('koa-router')();

router.get('/api/linesofcode', handleRequest);
router.get('/api/linesofcode/csv', csv);

module.exports = router.routes();

refreshTasks();
setInterval(refreshTasks, oneHourDelay);

function* handleRequest(){
    this.body = yield getCache;
}

function getCache(callback){
    if(cache){
        callback(null, cache);
    }else{
        setTimeout(function(){
            getCache(callback);
        }, 1000);
    }
}

function getTasks(cb){
    var options = {
        repository: 'BrokingClub/BrokingClub',
        githubToken: process.env.GITHUB_TOKEN
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

function* csv(){
    var cache = yield getCache;
    var lines = [];

    cache.data.forEach(function(task){
        lines.push(task.id + ';' + task.summary + ';' + task.lines + ';' + task.spentTime);
    });

    this.attachment('linesofcode.csv');
    this.set('Content-Type', 'text/csv');

    this.body = lines.join('\n');
}