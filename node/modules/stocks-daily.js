var sql = require('./sql');
var no = require('app/no');
var async = require('async');
var _ = require('lodash');
var minuteLimit = 120;
var dailyReset = false;
var dailyIds, unchangedStocksSince;

exports.init = function(allSymbols, callback){
    var tasks = {};
    
    _.each(allSymbols, function(symbol){
        tasks[symbol.id] = async.apply(getLastDailyId, symbol.id);
    });
    
    async.parallel(tasks, function(err, result){
        if(no(err)){
            dailyIds = result;
            
            callback();
        }
    });
};

exports.getNextDailyId = function(stockId){
    return ++dailyIds[stockId];
};

exports.changedStocks = function(){
    dailyReset = false;
    unchangedStocksSince = null;
};

exports.unchangedStocks = function(){
    if(!dailyReset){
        if(unchangedStocksSince){
            var timeSinceLastChange = _.now() - unchangedStocksSince;
            var minutesSinceLastChange = timeSinceLastChange / 1000 / 60;

            if(minutesSinceLastChange >= minuteLimit){
                dailyReset = true;
                unchangedStocksSince = null;

                console.log('Unchanged stocks since ' + minuteLimit + ' minutes, resetting daily ids.');
                resetDailyIds();
            }
        }else{
            unchangedStocksSince = _.now();
        }
    }
};

function getLastDailyId(stockId, callback){
    sql.query('SELECT daily_id FROM stock_values WHERE stock_id = ? ORDER BY updated_at DESC LIMIT 1', [stockId], function(err, rows){
        if(no(err)){
            callback(null, rows[0].daily_id);   
        }
    });
}

function resetDailyIds(){
    _.each(dailyIds, function(value, key){
        dailyIds[key] = -1; 
    });
}