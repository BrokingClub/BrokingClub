var mysql = require('mysql');
var config = require('./config');
module.exports = mysql.createPool({
	user: config.sql.user,
	password: config.sql.password,
	database: config.sql.database
});