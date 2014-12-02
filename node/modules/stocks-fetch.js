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

function saveQuotes(symbols){
	var values = [];

	symbols.forEach(function(symbol){
		values.push('(' + symbol.id + ',' + symbol.quote + ',now(),now())');
	});
	
	var query = 'INSERT INTO stock_values (stock_id, value, created_at, updated_at) VALUES ' + values.join(',');
	
    sql.query(query, function(err){
        if(no(err)){
            timer.stop('Fetched ' + symbols.length + ' stocks');   
        }
    });
}

function getChangedQuotes(symbols){
    if(cache.symbols){
        var changed = [];
        var unchanged = [];
        
        symbols.forEach(function(symbol){
            var cached = _.find(cache.symbols, { id: symbol.id });
            
            if(!cached || symbol.quote !== cached.quote){
                changed.push(symbol);
            }else{
                unchanged.push(symbol.symbol);
            }
        });
        
        if(changed.length){
            console.log('Changed symbols: ' + changed.join(', '));   
        }
        
        if(unchanged.length){
            console.log('Unchanged symbols: ' + unchanged.join(', '));   
        }
        
        return changed;
    }else{
        return symbols; 
    }
}