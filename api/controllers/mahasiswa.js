var express = require('express');
var path = require('path');

var sequelize = require('../connection');

var Mahasiswa = sequelize.import(__dirname + '/../models/mahasiswa');

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
}

module.exports = new MahasiswaControllers();