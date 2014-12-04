var sql = require('./sql');
var yahoo = require('./stocks-yahoo');
var no = require('app/no');
var timer = require('app/timer').create();
var _ = require('lodash');
var cache = {};
var allSymbols;

sql.query('SELECT id, symbol FROM stocks', function(err, result){
    if(no(err)){
        allSymbols = result;
        
        exports.fetchStocks();
    }
});

exports.fetchStocks = function(){
    if(allSymbols){
        timer.start();
        fetchStocks(_.clone(allSymbols));
    }else{
        console.error('Symbols not loaded!');   
    }
};

function fetchStocks(symbols){
	yahoo.queryStocks(symbols, function(err, stocks){
        if(no(err)){
            var changed = getChangedStocks(stocks);
            cache.stocks = stocks;

            if(changed.length){
                saveStocks(changed);
            }else{
                timer.stop('Unchanged quotes');
            }   
        }
    });
}

function saveStocks(stocks){
	var values = [];

	stocks.forEach(function(stock){
		values.push('(' + stock.id + ',' + stock.quote + ',now(),now())');
	});
	
	var query = 'INSERT INTO stock_values (stock_id, value, created_at, updated_at) VALUES ' + values.join(',');
	
    sql.query(query, function(err){
        if(no(err)){
            timer.stop('Saved ' + stocks.length + ' stocks');   
        }
    });
}

function getChangedStocks(stocks){
    if(cache.stocks){
        var changed = [];
        var unchanged = [];
        
        stocks.forEach(function(stock){
            var cached = _.find(cache.stocks, { id: stock.id });
            
            console.log('[DEBUG] Cache compare: ' + (cached ? stock.quote + ' !== ' + cached.quote : 'not cached'));
            
            if(!cached || stock.quote !== cached.quote){
                changed.push(stock);
            }else{
                unchanged.push(stock.symbol);
            }
        });
        
        if(changed.length){
            console.log('Changed stocks: ' + changed.join(', '));   
        }
        
        if(unchanged.length){
            console.log('Unchanged stocks: ' + unchanged.join(', '));   
        }
        
        return changed;
    }else{
        console.log('Skipped stocks cache');
        
        return stocks;
    }
}