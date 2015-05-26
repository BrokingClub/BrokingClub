var cluster = require('cluster');
var koala = require('koala');

koala(function(app){
    app.proxy = true;
    var io = require('socket.io')(server);

    app.use(require('./routes/cucumber'));
    app.use(require('./routes/lines-of-code'));
});

if(cluster.isMaster){
    require('./modules/stocks');
}