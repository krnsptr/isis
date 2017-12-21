var express = require('express');
var path = require('path');
var spawn = require('child_process').spawn;
var PythonShell = require('python-shell');

var sequelize = require('../connection');

var Mahasiswa = sequelize.import(__dirname + '/../models/mahasiswa');
var NilaiMutu = sequelize.import(__dirname + '/../models/nilai_mutu');
var MataKuliah = sequelize.import(__dirname + '/../models/mata_kuliah');

Mahasiswa.hasMany(NilaiMutu, { foreignKey: 'mahasiswa_id' })
NilaiMutu.belongsTo(MataKuliah, { foreignKey: 'mata_kuliah_id' })
function MahasiswaControllers() {
	this.sebaranIpkAngkatan = function(req, res) {
		sebaran = {};
		angkatan = req.body.angkatan;
		Mahasiswa
			.findAll({
				where: {
					angkatan: angkatan
				},
				attributes: [
					'ipk'
				]
			})
			.then((result) => {
				result.forEach((item) => {
					if (item.ipk in sebaran) {
						sebaran[item.ipk] += 1;
					} else {
						sebaran[item.ipk] = 1;
					}
				});
			})
			.then(() => {
				res.json({status: true, message: 'Ambil semua IPK angkatan berhasil!', data: sebaran});
			})
			.catch((err) => {
				res.json({status: false, message: 'Ambil semua IPK angkatan gagal!', err: err});
			});
	}

	this.prediksiIpkAngkatan = function(req, res) {
		var angkatan = req.body.angkatan;
		var options = {
			mode: 'json',
			pythonPath: 'python',
			scriptPath: __dirname,
			args: [angkatan]
		};

		PythonShell.run('prediksiIPK.py', options, function (err, results) {
			if (err) {
				res.json({status: false, message: 'gagal!', err: err});
			} else {
				res.json({status: true, message: 'berhasil!', data: results});
			}
		});
	}

	this.prediksiKelulusanAngkatan = function(req, res) {
		var angkatan = req.body.angkatan;
		var options = {
			mode: 'json',
			pythonPath: 'python',
			scriptPath: __dirname,
			args: [angkatan]
		};

			PythonShell.run('prediksiKelulusan.py', options, function (err, results) {
				if (err) {
					res.json({status: false, message: 'gagal!', err: err});
				} else {
					res.json({status: true, message: 'berhasil!', data: results});
				}
			});
		
	}

	// this.create = function(req, res) {
	// 	var file = req.file
	// }
}

module.exports = new MahasiswaControllers();