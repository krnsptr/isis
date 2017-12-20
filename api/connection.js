var Sequelize = require('sequelize');

module.exports = new Sequelize('isis', 'postgres', 'postgres', {
	host: 'localhost',
	dialect: 'postgres',
	pool: {
		max: 5,
		min: 0,
		acquire: 30000,
		idle: 10000
	},
	timezone: '+07:00'
});