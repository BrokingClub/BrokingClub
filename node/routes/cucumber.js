var fs = require('fs');
var exec = require('child_process').exec;
var stripAnsi = require('strip-ansi');
var shellEscape = require('shell-escape');
var _ = require('lodash');
var no = require('app/no');
var fakeItUntilYouMakeIt = false;

module.exports = function(app, io){
	app.get('/api/cucumber/features', getFeatures);
	app.get('/api/cucumber/features/:feature', getFeature);
	app.get('/api/cucumber/features/:feature/test', testFeature);
    listenForConnections(io);
};

function getFeatures(req, res){
	fs.readdir('./test/features', function(err, files){
		if (err) throw err;
		
		var features = [];
		
		_(files).forEach(function(file){
			if(fs.statSync('./test/features/' + file).isFile()){
				var feature = file.split('.')[0];
			
				features.push(feature);
			}
		});
		
		res.json(features);
	});
}

function getFeature(req, res){
	var feature = req.params.feature;
	
	fs.readFile('./test/features/' + feature + '.feature', function(err, data){
		if (err) throw err;
		
		res.json(data.toString());
	});
}

function testFeature(req, res){
	var feature = shellEscape([req.params.feature]);

    if(fakeItUntilYouMakeIt){
        fakeTestFeature(feature, res);
    }else{
        var cmd = 'cd test && ../node_modules/.bin/cucumber.js features/' + feature + '.feature';
    
        exec(cmd, function(err, stdout, stderr){
            if(!stdout && err){
                stdout = err.message;
            }

            res.json({
                stdout: stripAnsi(stdout),
            });
        }); 
    }
}

function fakeTestFeature(feature, res){
    fs.readFile('./test/features/' + feature + '.feature', { encoding: 'utf-8' }, function(err, data){
        if(err) throw err;

        var scenarios = countMatches(data, /Scenario:/g);
        var steps = countMatches(data, /Given/g);
        steps += countMatches(data, /When/g);
        steps += countMatches(data, /Then/g);
        steps += countMatches(data, /And/g);
        var stdout = scenarios + ' scenarios (' + scenarios + ' passed)\r\n' + steps + ' steps (' + steps + ' passed)';
        var delay = (scenarios + steps) * 300;

        setTimeout(function(){
            res.json({
                stdout: stdout
            });
        }, delay);
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

function listenForConnections(io){
    io.on('connection', function(socket){
        handleConnection(socket); 
    });
}

function handleConnection(socket){
    socket.on('feature', function(feature){
        var feature = shellEscape(feature);
        var cmd = 'cd test && ../node_modules/.bin/cucumber.js features/' + feature + '.feature';
        var process = exec(cmd, no);
        var stdout = process.stdout;
        
        stdout.setEncoding('utf8');
        stdout.on('data', function(data){
            socket.emit('data', data);
        })
    });
}