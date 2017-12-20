var sequelize = require('../connection');
var Role = sequelize.import(__dirname + '/../models/role');

module.exports = function(sequelize, DataType) {
	return sequelize.define('user', {
		nama: DataType.STRING,
		email: { type: DataType.STRING, unique: true, isEmail: true },
		password: DataType.STRING,
		role_id: { type: DataType.INTEGER, references: { model: Role, key: 'id' } },
		status: { type:DataType.BOOLEAN, defaultValue: true }
	}, {
		timestamps: false
	});
}