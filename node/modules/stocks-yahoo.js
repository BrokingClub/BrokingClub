var request = require('request');
var no = require.main.require('./modules/util/no');

exports.queryStocks = queryStocks;

function queryStocks(symbols, callback){
    var url = buildApiUrl(symbols);
    
	request.get(url, function(err, res, body){
		if(no(err)){
			body = JSON.parse(body);
			
            if(body.query && body.query.results){
                var quotes = body.query.results.quote;
                
                for(var i = 0; i < quotes.length; i++){
                    symbols[i].quote = quotes[i].LastTradePriceOnly;
                    symbols[i].change = parseFloat(quotes[i].Change);
                }
                
                callback(null, symbols);
            }else{
                callback(new Error('Invalid JSON response from Yahoo API!'));
            }
		}else{
            callback(err);   
        }
	});
}

function buildApiUrl(symbols){
    var yql = buildYqlQuery(symbols);
    
    return 'https://query.yahooapis.com/v1/public/yql?q=' + yql + '&format=json&env=store%3A%2F%2Fdatatables.org%2Falltableswithkeys&callback=';
}

function buildYqlQuery(symbols){
	var symbolNames = [];
	
	symbols.forEach(function(symbol){
		symbolNames.push(symbol.symbol);
	});
	
	return 'select LastTradePriceOnly, Change from yahoo.finance.quote where symbol in ("' + symbolNames.join('","') + '")';
}