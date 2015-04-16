var log4js = require('log4js');
var format = ':method :url :status - :res[content-length] - :response-time ms';

log4js.configure({
    appenders: [
        { type: 'console' },
        {
            type: 'file',
            filename: 'logs/server.log',
            maxLogSize: 1000000,
            backups: 7
        }
    ],
    replaceConsole: true
});

module.exports = log4js.connectLogger(log4js.getLogger(), { format: format });