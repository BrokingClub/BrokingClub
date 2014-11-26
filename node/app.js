var express = require('express');
var path = require('path');
var favicon = require('serve-favicon');
var morgan = require('morgan');
var cookieParser = require('cookie-parser');
var bodyParser = require('body-parser');
var logger = require('./modules/logger');
var app = express();

app.use(favicon(__dirname + '/public/favicon.ico'));
app.use(morgan('dev'));
app.use(logger.morgan);
app.use(bodyParser.json());
app.use(bodyParser.urlencoded({ extended: false }));
app.use(cookieParser());
app.use(express.static(path.join(__dirname, 'public')));

require('./routes/cucumber')(app);
require('./modules/stocks/stocks');

app.listen(3000);

module.exports = app;