var express = require('express');
var path = require('path');
var favicon = require('serve-favicon');
var cookieParser = require('cookie-parser');
var bodyParser = require('body-parser');
var domain = require('domain');
var logger = require('app/logger');
var no = require('app/no');
var app = express();

app.use(favicon(__dirname + '/public/favicon.ico'));
app.use(logger);
app.use(bodyParser.json());
app.use(bodyParser.urlencoded({ extended: false }));
app.use(cookieParser());
app.use(express.static(path.join(__dirname, 'public')));

require('./routes/cucumber')(app);

var stocksDomain = domain.create();

stocksDomain.on('error', no)
stocksDomain.run(function(){
    require('./modules/stocks');
});

app.listen(3000);

module.exports = app;