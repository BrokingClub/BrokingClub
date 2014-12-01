var sql = require('./sql');
var timer = require('app/timer').create();
var no = require('app/no');

exports.deleteOldStocks = function(){
    timer.start();
    sql.query('DELETE FROM stock_values WHERE created_at < DATE_SUB(NOW(), INTERVAL 30 DAY)', function(err, result){
        if(no(err)){
            timer.stop('Deleted ' + result.affectedRows + ' old stocks');   
        }
    });
}