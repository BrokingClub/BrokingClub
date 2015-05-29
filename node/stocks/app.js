require('dotenv').load();

var stocks = require('./lib/stocks');
var memwatch = require('./lib/util/memwatch');

memwatch();
stocks();