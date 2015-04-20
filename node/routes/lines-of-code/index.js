var async = require('async');
var github = require('./github');
var youtrack = require('./youtrack');
var cache;

module.exports = function(app){
    app.get('/api/linesofcode', handleRequest);
};

function handleRequest(req, res){
   getLinesOfCode(function(err, data){
       if(err){
           console.error(err);

           return res.sendStatus(500);
       }

       res.json({
           data: data
       });
   });
}

function getLinesOfCode(cb){
    if(isCacheValid()){
        return cb(null, cache.data);
    }

    async.waterfall([
        github.getCommits,
        youtrack.getTasks
    ], function(err, result){
        if(err) return cb(err);

        cache = {
            data: result,
            created: new Date()
        };

        cb(null, result);
    });
}

function isCacheValid(){
    if(cache){
        var age = new Date() - cache.created;
        var oneHourInMilliseconds = 60 * 60 * 1000;

        return age < oneHourInMilliseconds;
    }

    return false;
}