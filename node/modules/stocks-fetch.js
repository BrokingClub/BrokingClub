var sql = require('./sql');
var yahoo = require('./stocks-yahoo');
var daily = require('./stocks-daily');
var no = require('app/no');
var timer = require('app/timer').create();
var _ = require('lodash');
var cache = {};
var allSymbols, dailyIds;

sql.query('SELECT id, symbol FROM stocks', function(err, result){
    if(no(err)){
        allSymbols = result;
        
        daily.init(allSymbols, exports.fetchStocks);
    }
});

exports.fetchStocks = function(){
    if(allSymbols){
        timer.start();
        fetchStocks(_.cloneDeep(allSymbols));
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
                daily.changedStocks();
                saveStocks(changed);
            }else{
                daily.unchangedStocks();
                timer.stop('Unchanged stocks');
            }   
        }
    });
}

function saveStocks(stocks){
	var values = [];

	stocks.forEach(function(stock){
		values.push('(' + stock.id + ',' + daily.getNextDailyId(stock.id) + ',' + stock.quote + ',now(),now())');
	});
	
	var query = 'INSERT INTO stock_values (stock_id, daily_id, value, created_at, updated_at) VALUES ' + values.join(',');
	
    sql.query(query, function(err){
        if(no(err)){
            timer.stop('Saved ' + stocks.length + ' stocks');   
        }
    });
}

function getChangedStocks(stocks){
    if(cache.stocks){
        var changed = [];
        var unchanged = 0;
        
        stocks.forEach(function(stock){
            var cached = _.find(cache.stocks, { id: stock.id });
            
            if(!cached || stock.quote !== cached.quote){
                changed.push(stock);
            }else{
                unchanged++;
            }
        });
        
        if(changed.length){
            console.log('Changed stocks: ' + changed.length);   
        }
        
        if(unchanged){
            console.log('Unchanged stocks: ' + unchanged);   
        }
        
        return changed;
    }else{
        console.log('Skipped stocks cache');
        
        return stocks;
    }
}