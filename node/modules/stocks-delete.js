var sql = require.main.require('./modules/sql');
var timer = require.main.require('./modules/util/timer').create();
var no = require.main.require('./modules/util/no.js');

exports.deleteOldStocks = function(){
    timer.start();
    sql.query('DELETE FROM stock_values WHERE created_at < DATE_SUB(NOW(), INTERVAL 30 DAY)', function(err, result){
        if(no(err)){
            timer.stop('Deleted ' + result.affectedRows + ' old stocks');   
        }
    });
};