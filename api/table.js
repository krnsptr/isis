var sequelize = require('./connection');

var Mahasiswa = sequelize.import(__dirname + '/models/mahasiswa');
var MataKuliah = sequelize.import(__dirname + '/models/mata_kuliah');
var NilaiMutu = sequelize.import(__dirname + '/models/nilai_mutu');
var Role = sequelize.import(__dirname + '/models/role');
var User = sequelize.import(__dirname + '/models/user');

Mahasiswa.sync({force: true}).then(() => {
	MataKuliah.sync({force: true}).then(() => {
		NilaiMutu.sync({force: true});
	});
});
Role.sync({force: true}).then(() => {
	User.sync({force: true});
});
