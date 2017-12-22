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
	this.getAngkatan = function(req, res) {
		var angkatan = req.params.angkatan
		Mahasiswa
			.findAll({
				where: {
					angkatan: angkatan
				}
			})
			.then((result) => {
				res.json({status: true, message: 'Ambil angkatan mahasiswa berhasil!', data: result});
			})
			.catch((err) => {
				res.json({status: false, message: 'Ambil angkatan mahasiswa gagal!', err: err});
			});
	}

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
				],
				order: [
					['ipk', 'ASC']
				]
			})
			.then((result) => {
				result.forEach((item) => {
					var ipk = item.ipk.toFixed(2);
					if (ipk in sebaran) {
						sebaran[ipk] += 1;
					} else {
						sebaran[ipk] = 1;
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
			pythonPath: 'python3',
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
			pythonPath: 'python3',
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
}

module.exports = new MahasiswaControllers();