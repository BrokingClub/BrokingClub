var fs = require('fs');
var exec = require('child_process').exec;
var stripAnsi = require('strip-ansi');
var shellEscape = require('shell-escape');
var _ = require('lodash');

module.exports = function(app){
	app.get('/api/cucumber/features', getFeatures);
	app.get('/api/cucumber/features/:feature', getFeature);
	app.get('/api/cucumber/features/:feature/test', testFeature);
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
	
	exec('cd test && ../node_modules/.bin/cucumber.js features/' + feature + '.feature', function(err, stdout, stderr){
		if(!stdout && err){
			stdout = err.message;
		}
	
		res.json({
			stdout: stripAnsi(stdout),
		});
	});
}