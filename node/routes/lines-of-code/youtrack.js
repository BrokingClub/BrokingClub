var request = require('request');
var async = require('async');
var objectToArray = require.main.require('./modules/util/objectToArray');
var apiUrl = 'http://brokingclub.myjetbrains.com/youtrack/rest/issue/';

exports.getTasks = getTasks;

function getTasks(commits, cb){
    var tasks = extractTasks(commits);

    getTaskSummaries(tasks, cb);
}

function getTaskSummaries(tasks, cb){
    async.mapLimit(tasks, 100, getTaskSummary, function(err, summaries){
        if(err) return cb(err);

        summaries = summaries.filter(function(summary){
            return summary !== null;
        });

        cb(null, summaries);
    });
}

function getTaskSummary(task, cb){
    sendApiRequest(apiUrl + task.id, function(err, xml){
        if(err){
            console.error(err);

            return cb(null, null);
        }

        cb(null, {
            id: task.id,
            summary: extractTaskSummary(xml),
            lines: task.lines
        });
    });
}

function extractTaskSummary(xml){
    var regex = /name="summary"><value>(.+?)<\/value>/;
    var result = xml.match(regex);

    if(result){
        return result[1];
    }

    return null;
}

function extractTasks(commits){
    var tasks = {};

    commits.forEach(function(commit){
        var id = matchTaskId(commit.message);

        if(id) {
            var task = tasks[id];

            if (!task) {
                tasks[id] = task = {
                    id: id,
                    lines: 0
                };
            }

            task.lines += commit.stats;
        }
    });

    return objectToArray(tasks);
}

function matchTaskId(commitMessage){
    var regex = /#(bc-[0-9]+)\s/;
    var result = commitMessage.match(regex);

    if(result){
        return result[1];
    }

    return null;
}

function sendApiRequest(url, cb){
    request.get(url, function(err, response, body){
        if(err) return cb(err);
        if(response.statusCode !== 200) return cb(response.body);

        cb(null, body);
    });
}