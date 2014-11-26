var fs = require('fs');
var morgan = require('morgan');
var moment = require('moment');
var stream = fs.createWriteStream('server.log', { flags: 'a' });
var format = ':method :url :status - :res[content-length] bytes - :response-time ms';
var logger = {
    write: function(message, encoding){
        var time = moment().format('DD. MMM YYYY / HH:mm:ss.SSS');
        
        stream.write(time + ' - ' + message, encoding);
    }
};

module.exports = {
    morgan: morgan(format, { stream: logger }),
    log: function(message){
        logger.write(message + '\r');   
    }
};