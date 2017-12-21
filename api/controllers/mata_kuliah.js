var express = require('express');
var path = require('path');

var sequelize = require('../connection');

var MataKuliah = sequelize.import(__dirname + '/../models/mata_kuliah');

function MataKuliahControllers() {
	this.getAll = function(req, res) {
		MataKuliah
			.findAll()
			.then((result) => {
				res.json({status: true, message: 'Ambil seluruh mata kuliah berhasil!', data: result});
			})
			.catch((err) => {
				res.json({status: false, message: 'Ambil seluruh mata kuliah gagal!', err: err});
			});
	}
}

module.exports = new MataKuliahControllers();