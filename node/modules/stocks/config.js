module.exports = {
	sql: {
		user: process.env.DB_USER,
		password: process.env.DB_PASSWORD,
		database: process.env.DB_DATABASE
	},
	fetchDelaySec: 60,
    deleteOldStocksDelayHours: 1
};