var sql = require('./sql');
var request = require('request');
var config = require('./config');
var ok = require('../ok');

deleteOldStocks();
setInterval(deleteOldStocks, 60 * 60 * 1000);

sql.query('SELECT id, symbol FROM stocks', function(err, result){
    if(ok(err)){
        startFetchInterval(result);
    }
});

function startFetchInterval(symbols){
	var callback = function(){
		fetchStocks(symbols);
	};
	
	callback();
	setInterval(callback, config.fetchDelaySec * 1000);
}

function fetchStocks(symbols){
	var yql = buildYqlQuery(symbols);
	var apiUrl = 'https://query.yahooapis.com/v1/public/yql?q=' + yql + '&format=json&env=store%3A%2F%2Fdatatables.org%2Falltableswithkeys&callback=';
	
	request.get(apiUrl, function(err, res, body){
		if(err){
			console.log(err);
		}else{
			body = JSON.parse(body);
			
			saveQuotes(symbols, body.query.results.quote);
		}
	});
}

function buildYqlQuery(symbols){
	var symbolNames = [];
	
	symbols.forEach(function(symbol){
		symbolNames.push(symbol.symbol);
	});
	
	return 'select LastTradePriceOnly from yahoo.finance.quote where symbol in ("' + symbolNames.join('","') + '")';
}

function saveQuotes(symbols, quotes){
	var values = [];

	for(var i = 0; i < quotes.length; i++){
		var symbol = symbols[i];
		var quote = quotes[i];
		
		values.push('(' + symbol.id + ',' + quote.LastTradePriceOnly + ',now(),now())');
	}
	
	var sql = 'INSERT INTO stock_values (stock_id, value, created_at, updated_at) VALUES ' + values.join(',');
	
	mysql.getConnection(function(err, connection){
		if(err){
			console.log(err);
		}else{
			connection.query(sql, function(err){
				if(err){
					console.log(err);
				}
				
				connection.release();
			});
		}
	});
}

function deleteOldStocks(){
	mysql.getConnection(function(err, connection){
		if(err){
			console.log(err);
		}else{
			connection.query('DELETE FROM stock_values WHERE created_at < DATE_SUB(NOW(), INTERVAL 30 DAY)', function(err){
				if(err){
					console.log(err);
				}
				
				connection.release();
			});
		}
	});
}