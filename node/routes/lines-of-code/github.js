var async = require('async');
var githubApi = require('./githubApi');

exports.getCommits = function(cb){
    getCommitHashes(function(err, hashes){
        if(err) return cb(err);

        getCommitDetails(hashes, cb);
    });
};

function getCommitDetails(commits, cb){
    async.mapLimit(commits, 100, githubApi.getCommit, cb);
}

function getCommitHashes(cb, sha, hashes){
    sha = sha || 'master';
    hashes = hashes || [];

    githubApi.getCommits(sha, function(err, commits){
        if(err){
            return cb(err);
        }

        if(commits.length === 1){
            return cb(null, hashes);
        }

        commits.forEach(function(commit){
            if(commit.commit.message.indexOf('#') === 0) {
                hashes.push(commit.sha);
            }
        });

        getCommitHashes(cb, commits[commits.length - 1].sha, hashes);
    });
}