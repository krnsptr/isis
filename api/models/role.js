module.exports = function(sequelize, DataType) {
	return sequelize.define('role', {
		nama: DataType.STRING
	}, {
		timestamps: false
	});
}