module.exports = function(sequelize, DataType) {
	return sequelize.define('mahasiswa', {
		nama: DataType.STRING,
		kelamin: DataType.BOOLEAN,
		nim: { type: DataType.STRING(9), unique: true },
		ipk: { type: DataType.FLOAT, defaultValue: null },
		angkatan: DataType.INTEGER,
		status: { type: DataType.BOOLEAN, defaultValue: true },
	}, {
		timestamps: false
	});
}