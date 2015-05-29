var request = require('request');
var async = require('async');
var apiUrl = 'http://brokingclub.myjetbrains.com/youtrack/rest/issue/';

exports.getTasks = getTasks;

function getTasks(issues, cb){
    async.mapLimit(issues, 100, getTask, function(err, tasks){
        if(err) return cb(err);

        tasks = filterNulls(tasks);

        cb(null, tasks);
    });
}

function getTask(issue, cb){
    sendApiRequest(apiUrl + issue.id, function(err, xml){
        if(err){
            console.error(err);

            return cb(null, null);
        }

        cb(null, {
            id: issue.id,
            lines: issue.lines,
            summary: extractTaskValue(xml, 'summary'),
            created: extractTaskValue(xml, 'created'),
            spentTime: extractTaskValue(xml, 'Spent time')
        });
    });
}

function extractTaskValue(xml, name){
    var regex = new RegExp('name="' + name + '"><value>(.+?)<\/value>');
    var result = xml.match(regex);

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

function filterNulls(arr){
    return arr.filter(function(value){
        return value !== null;
    })
}