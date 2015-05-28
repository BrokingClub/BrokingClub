var cluster = require('cluster');
var fiveMinutes = 5 * 60 * 1000;

module.exports = function(){
    memwatch();
    setInterval(memwatch, fiveMinutes);
};

function memwatch(){
    var processName = cluster.isMaster ? 'master' : 'worker ' + process.pid;
    var mem = process.memoryUsage();
    var percent = Math.round(mem.heapUsed / mem.heapTotal * 100);
    var used = Math.round(mem.heapUsed / 1024 / 1024);
    var total = Math.round(mem.heapTotal / 1024 / 1024);

    console.log(processName + ' memory usage: ' + percent + '% - ' + used + ' MB / ' + total + ' MB');
}