var mysql = require('mysql');
var config = require.main.require('./modules/config');
module.exports = mysql.createPool({
	user: config.sql.user,
	password: config.sql.password,
	database: config.sql.database
});