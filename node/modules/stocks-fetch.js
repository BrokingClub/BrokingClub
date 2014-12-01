var sql = require('./sql');
var request = require('request');
var no = require('app/no');
var timer = require('app/timer').create();
var _ = require('lodash');
var cache = {};
var symbols;

sql.query('SELECT id, symbol FROM stocks', function(err, result){
    if(no(err)){
        symbols = result;
        
        exports.fetchStocks();
    }
});

exports.fetchStocks = function(){
    if(symbols){
        timer.start();
        fetchStocks(_.clone(symbols));
    }else{
        console.error('Symbols not loaded!');   
    }
};

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
                
                var changed = getChangedQuotes(symbols);
                cache.symbols = symbols;
                
                if(changed.length){
                    saveQuotes(changed);
                }else{
                    timer.stop('Unchanged quotes');
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
	
    sql.query(query, function(err){
        if(no(err)){
            timer.stop('Fetched stocks');   
        }
    });
}

function getChangedQuotes(symbols){
    if(cache.symbols){
        var changed = [];
        
        symbols.forEach(function(symbol){
            var cached = _.find(cache.symbols, { id: symbol.id });
            
            if(!cached || symbol.quote !== cached.quote){
                changed.push(symbol);
            }else{
                console.log('Unchanged quote found for symbol ' + symbol.symbol);
            }
        });
        
        return changed;
    }else{
        return symbols; 
    }
}