module.exports = function(sequelize, DataType) {
	return sequelize.define('mata_kuliah', {
		nama: DataType.STRING,
		kode: { type: DataType.STRING(6), unique: true },
		sks: DataType.INTEGER
	}, {
		timestamps: false
	});
}