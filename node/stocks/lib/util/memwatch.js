var fiveMinutes = 5 * 60 * 1000;

module.exports = function(){
    memwatch();
    setInterval(memwatch, fiveMinutes);
};

function memwatch(){
    var memory = process.memoryUsage();
    var rss = Math.round(memory.rss / 1024 / 1024);
    var used = Math.round(memory.heapUsed / 1024 / 1024);
    var total = Math.round(memory.heapTotal / 1024 / 1024);

    console.log('Resident set size: ' + rss + ' MB - V8 Heap: ' + used + ' MB / ' + total + ' MB');
}