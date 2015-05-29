var fiveMinutes = 5 * 60 * 1000;

module.exports = function(){
    memwatch();
    setInterval(memwatch, fiveMinutes);
};

function memwatch(){
    var memory = process.memoryUsage();
    var percent = Math.round(memory.heapUsed / memory.heapTotal * 100);
    var used = Math.round(memory.heapUsed / 1024 / 1024);
    var total = Math.round(memory.heapTotal / 1024 / 1024);

    console.log('memory usage: ' + percent + '% - ' + used + ' MB / ' + total + ' MB');
}