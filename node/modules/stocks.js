var config = require.main.require('./modules/config');
var stocksDelete = require.main.require('./modules/stocks-delete');
var stocksFetch = require.main.require('./modules/stocks-fetch');

stocksDelete.deleteOldStocks();
setInterval(stocksDelete.deleteOldStocks, config.deleteOldStocksDelayHours * 60 * 60 * 1000);
setInterval(stocksFetch.fetchStocks, config.fetchDelaySec * 1000);