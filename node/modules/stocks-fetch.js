var sql = require('./sql');
var yahoo = require('./stocks-yahoo');
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
	yahoo.queryStocks(symbols, function(err, symbols){
        if(no(err)){
            var changed = getChangedQuotes(symbols);
            cache.symbols = symbols;

            if(changed.length){
                saveQuotes(changed);
            }else{
                timer.stop('Unchanged quotes');
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