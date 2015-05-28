var koala = require('koala');
var cucumber = require('./routes/cucumber');
var memwatch = require('./modules/memwatch');

koala.once(function(){
    require('./modules/stocks');
    memwatch();
});

koala.config(function(app){
    app.proxy = true;

    app.use(require('./routes/lines-of-code'));
    app.use(cucumber.routes);
    memwatch();
});

koala.run(function(server){
    var io = require('socket.io')(server);

    cucumber.socket(io);
});