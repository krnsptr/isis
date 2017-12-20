var sequelize = require('../connection');
var Mahasiswa = sequelize.import(__dirname + '/../models/mahasiswa');
var MataKuliah = sequelize.import(__dirname + '/../models/mata_kuliah');

module.exports = function(sequelize, DataType) {
	return sequelize.define('nilai_mutu', {
		mahasiswa_id: { type: DataType.INTEGER, references: { model: Mahasiswa, key: 'id' } },
		mata_kuliah_id: { type: DataType.INTEGER, references: { model: MataKuliah, key: 'id' } },
		semester: DataType.INTEGER,
		tahun: DataType.INTEGER,
		nilai: DataType.ENUM('A', 'AB', 'B', 'BC', 'C', 'D', 'E')
	}, {
		timestamps: false
	});
}