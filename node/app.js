var cluster = require('cluster');
var koala = require('koala');

koala(function(app){
    var cucumber = require('./routes/cucumber');
    app.proxy = true;

    app.use(require('./routes/lines-of-code'));
    app.use(cucumber.routes);

    app.on('server', function(server){
        var io = require('socket.io')(server);

        cucumber.socket(io);
    });
});

if(cluster.isMaster){
    require('./modules/stocks');
}