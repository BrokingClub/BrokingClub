var koala = require('koala');
var cucumber = require('./routes/cucumber');

koala.once(function(){
    require('./modules/stocks');
});

koala.config(function(app){
    app.proxy = true;

    app.use(require('./routes/lines-of-code'));
    app.use(cucumber.routes);
});

koala.run(function(server){
    var io = require('socket.io')(server);

    cucumber.socket(io);
});