var mysql = require('mysql');
var config = require('./config');
var pool  = mysql.createPool({
	user: config.sql.user,
	password: config.sql.password,
	database: config.sql.database
});
module.exports = pool;