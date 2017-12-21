var express = require('express');
var path = require('path');
var multer = require('multer');
var fs = require('fs');
var XLSX = require('xlsx');

var sequelize = require('../connection');

var NilaiMutu = sequelize.import(__dirname + '/../models/nilai_mutu');
var Mahasiswa = sequelize.import(__dirname + '/../models/mahasiswa');
var MataKuliah = sequelize.import(__dirname + '/../models/mata_kuliah');

NilaiMutu.belongsTo(MataKuliah, { foreignKey: 'mata_kuliah_id' });
NilaiMutu.belongsTo(Mahasiswa, { foreignKey: 'mahasiswa_id' });

function NilaiMutuControllers() {
	this.sebaranNilaiMutu = function(req, res) {
		var mata_kuliah_id = req.body.mata_kuliah_id;
		var tahun = req.body.tahun;
		var semester = req.body.semester;
		var sebaran = {
			A:0,
			AB:0,
			B:0,
			BC:0,
			C:0,
			D:0,
			E:0
		};
		NilaiMutu
			.findAll({
				where: {
					mata_kuliah_id: mata_kuliah_id,
					tahun: tahun,
					semester: semester
				},
				attributes: [
					'nilai'
				]
			})
			.then((result) => {
				result.forEach((item) => {
					if (item.nilai == 'A') {
					 	sebaran.A += 1;
					} else if (item.nilai == 'AB') {
					 	sebaran.AB += 1;
					} else if (item.nilai == 'B') {
					 	sebaran.B += 1;
					} else if (item.nilai == 'BC') {
					 	sebaran.BC += 1;
					} else if (item.nilai == 'C') {
					 	sebaran.C += 1;
					} else if (item.nilai == 'D') {
					 	sebaran.D += 1;
					} else {
						sebaran.E += 1;
					}
				})
			})
			.then((result) => {
				res.json({status: true, message: 'Ambil sebaran nilai mutu mata kuliah berhasil!', data: sebaran});
			})
			.catch((err) => {
				res.json({status: false, message: 'Ambil sebaran nilai mutu mata kuliah gagal!', err: err});
			});
	}

	this.uploadLearning = function(req, res) {
		var destination = 'public/uploads/';
		var dir = '/../';
		var filename = '';

		var upload = multer({
			storage: multer.diskStorage({
				destination: function (req, file, cb) {
			    	cb(null, __dirname + dir + destination);
			  	},
				filename: function (req, file, cb) {
					filename = file.fieldname + '-' + Date.now() + '.xlsx'
			      	cb(null, filename);
			  	}
			})
		}).any();

		upload(req, res, function(err) {
			if (err) {
				res.json({status: false, message: 'Upload xlsx gagal!', err: err});
			} else {
				var file = fs.readFile(__dirname + dir + destination + '/' + filename, (err, data) => {
					if (err) {

					} else {
						wa = XLSX.utils.sheet_to_json(data)
						res.json({data: wa});
					}
				})
				// res.json({status: true, message: 'Upload xlsx berhasil!', data: filename});
			}
		});
	}
}

module.exports = new NilaiMutuControllers();