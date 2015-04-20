var request = require('request');
var config = require.main.require('./modules/config');
var apiUrl = 'https://api.github.com/repos/BrokingClub/BrokingClub/commits';

exports.getCommits = getCommits;
exports.getCommit = getCommit;

function getCommits(sha, cb){
    sendApiRequest('?sha=' + sha, cb);
}

function getCommit(sha, cb){
    sendApiRequest('/' + sha, function(err, data){
        if(err) return cb(err);

        cb(null, {
            sha: sha,
            message: data.commit.message,
            stats: data.stats.additions - data.stats.deletions
        });
    });
}

function sendApiRequest(query, cb){
    var options = {
        url: apiUrl + query,
        headers: {
            'User-Agent': 'Broking Club'
        },
        auth: {
            username: config.githubToken,
            password: 'x-oauth-basic'
        }
    };
    console.log(options.url);
    request.get(options, function(err, response, body){
        if(err){
            return cb(err);
        }

        if(response.statusCode !== 200){
            return cb(response.body);
        }

        cb(null, JSON.parse(body));
    });
}