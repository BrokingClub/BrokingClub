var config = require('./config');
var stocksDelete = require('./stocks-delete');
var stocksFetch = require('./stocks-fetch');

stocksDelete.deleteOldStocks();
setInterval(stocksDelete.deleteOldStocks, config.deleteOldStocksDelayHours * 60 * 60 * 1000);
setInterval(stocksFetch.fetchStocks, config.fetchDelaySec * 1000);