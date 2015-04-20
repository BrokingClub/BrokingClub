require('dotenv').load();

var express = require('express');
var app = express();
var server = require('http').Server(app);
var io = require('socket.io')(server);
var path = require('path');
var favicon = require('serve-favicon');
var cookieParser = require('cookie-parser');
var bodyParser = require('body-parser');
var domain = require('domain');
var logger = require('./modules/logger');
var no = require('app/no');

app.use(favicon(__dirname + '/public/favicon.ico'));
app.use(logger);
app.use(bodyParser.json());
app.use(bodyParser.urlencoded({ extended: false }));
app.use(cookieParser());
app.use(express.static(path.join(__dirname, 'public')));

require('./routes/cucumber')(app, io);
require('./routes/lines-of-code')(app);

var stocksDomain = domain.create();

stocksDomain.on('error', no)
stocksDomain.run(function(){
    require('./modules/stocks');
});

server.listen(3000);

exports.app = app;
exports.io = io;