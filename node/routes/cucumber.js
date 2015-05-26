var fs = require('fs');
var exec = require('child_process').exec;
var stripAnsi = require('strip-ansi');
var shellEscape = require('shell-escape');
var async = require('async');
var no = require.main.require('./modules/util/no');
var debug = false;

module.exports = function(){
    var router = require('koa-router')();

	router.get('/api/cucumber/features', getFeatures);
	router.get('/api/cucumber/features/:feature', getFeature);
    listenForConnections(io);

    return router.routes();
};

function* getFeatures(req, res){
	fs.readdir('./test/features', function(err, files){
		if (err) throw err;
		
		var features = [];

		files.forEach(function(file){
			if(fs.statSync('./test/features/' + file).isFile()){
				var feature = file.split('.')[0];

				features.push(feature);
			}
		});
		
		res.json(features);
	});
}

function* getFeature(req, res){
	var feature = req.params.feature;
    
    async.parallel({
        feature: function(callback){
            fs.readFile('./test/features/' + feature + '.feature', { encoding: 'utf8' }, callback);
        },
        source: function(callback){
             fs.readFile('./test/features/step_definitions/' + feature + '.js', { encoding: 'utf8' }, callback);
        }
    }, function(err, results){
        if(no(err, res)){
            res.json(results);
        }
    });
}

function listenForConnections(io){
    io.on('connection', function(socket){
        handleConnection(socket); 
    });
}

function handleConnection(socket){
    socket.on('feature', function(feature){
        feature = shellEscape([feature]);
        
        if(debug){
            testFeature(feature, function(err, stdout){
                socket.emit('data', stdout);
            });
        }else{
            var cmd = 'cd test && ../node_modules/.bin/cucumber.js features/' + feature + '.feature';
            var process = exec(cmd, no);
            var stdout = process.stdout;

            stdout.setEncoding('utf8');
            stdout.on('data', function(data){
                socket.emit('data', stripAnsi(data));
            });
            stdout.on('end', function(){
                socket.emit('end');
            });
        }
    });
}

function testFeature(feature, callback){
    fs.readFile('./test/features/' + feature + '.feature', { encoding: 'utf-8' }, function(err, data){
        if(err){
            callback(err);
        }else{
            var scenarios = countMatches(data, /Scenario:/g);
            var steps = countMatches(data, /Given/g);
            steps += countMatches(data, /When/g);
            steps += countMatches(data, /Then/g);
            steps += countMatches(data, /And/g);
            var stdout = scenarios + ' scenarios (' + scenarios + ' passed)\r\n' + steps + ' steps (' + steps + ' passed)';
            var delay = (scenarios + steps) * 500;

            setTimeout(function(){
                callback(null, stdout);
            }, delay);
        }
    });
}

function countMatches(str, regexp){
    var matches = str.match(regexp);
    
    if(matches){
        return matches.length;
    }else{
        return 0;   
    }
}