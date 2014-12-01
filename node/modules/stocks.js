var sql = require('./sql');
var request = require('request');
var config = require('./config');
var no = require('app/no');
var _ = require('lodash');
var cache = {};
var symbols;

sql.query('SELECT id, symbol FROM stocks', function(err, result){
    if(no(err)){
        symbols = result;
        
        startFetchInterval();
    }
});

startDeleteOldStocksInterval();

function startFetchInterval(){
	var callback = function(){
        var start = Date.now();
        
		fetchStocks(_.clone(symbols));
        console.log('Fetched stocks in ' + (Date.now() - start) + ' ms');
	};
	
	callback();
	setInterval(callback, 10000);//config.fetchDelaySec * 1000);
}

function fetchStocks(symbols){
	var yql = buildYqlQuery(symbols);
	var apiUrl = 'https://query.yahooapis.com/v1/public/yql?q=' + yql + '&format=json&env=store%3A%2F%2Fdatatables.org%2Falltableswithkeys&callback=';
    
	request.get(apiUrl, function(err, res, body){
		if(no(err)){
			body = JSON.parse(body);
			
            if(body.query && body.query.results){
                var quotes = body.query.results.quote;
                
                for(var i = 0; i < quotes.length; i++){
                    symbols[i].quote = quotes[i].LastTradePriceOnly;
                }
                
                var changedSymbols = checkForUnchangedQuotes(symbols);
                cache.symbols = symbols;
                
                if(changedSymbols.length){
                    console.log('Saving ' + changedSymbols.length + ' of ' + symbols.length + ' quotes');
                    saveQuotes(symbols);
                }else{
                    console.log('Unchanged quotes');   
                }
            }else{
                throw new Error('Invalid JSON response from Yahoo API');
            }
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

function saveQuotes(symbols){
	var values = [];

	symbols.forEach(function(symbol){
		values.push('(' + symbol.id + ',' + symbol.quote + ',now(),now())');
	});
	
	var query = 'INSERT INTO stock_values (stock_id, value, created_at, updated_at) VALUES ' + values.join(',');
	
    sql.query(query, no);
}

function startDeleteOldStocksInterval(){
    var callback = function(){
        var start = Date.now();
        
        deleteOldStocks();
        console.log('Deleted old stocks in ' + (Date.now() - start) + ' ms');
    };
    
    callback();
    setInterval(callback, config.deleteOldStocksDelayHours * 60 * 60 * 1000);
}

function deleteOldStocks(){
    sql.query('DELETE FROM stock_values WHERE created_at < DATE_SUB(NOW(), INTERVAL 30 DAY)', no);
}

function checkForUnchangedQuotes(symbols){
    if(cache.symbols){
        cache.symbols.forEach(function(cacheSymbol){
            var symbol = _.find(symbols, { id: cacheSymbol.id });
            
            if(symbol){
                if(symbol.quote === cacheSymbol.quote){
                    console.log('Unchanged quote found for symbol ' + symbol.symbol);
                    _.remove(symbols, { id: symbol.id });   
                }
            }
        });
        
        return symbols;
    }else{
        return symbols; 
    }
}