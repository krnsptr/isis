var express = require('express');
var path = require('path');
var multer = require('multer');
var ps = require('python-shell');

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

	this.uploadPrediksi = function(req, res) {
		var destination = 'public/uploads/prediksi';
		var dir = '/../';
		var angkatan = req.params.angkatan;

		var upload = multer({
			storage: multer.diskStorage({
				destination: function (req, file, cb) {
			    	cb(null, __dirname + dir + destination);
			  	},
				filename: function (req, file, cb) {
			      	filename = angkatan + '.xlsx';
			      	cb(null, filename);
			  	}
			})
		}).any();

		upload(req, res, function(err) {
			// var bitmap = fs.readFileSync(__dirname + dir + destination + '/' + angkatan).toString('hex', 0, 4);
			if (err) {
				res.json({status: false, message: 'Upload data prediksi gagal!', err: err});
			} else {
				res.json({status: true, message: 'Upload data prediksi berhasil!'});
			}
		});
	}

	this.uploadLearning = function(req, res) {
		var destination = 'public/uploads/learning';
		var dir = '/../';
		var angkatan = req.params.angkatan;

		var upload = multer({
			storage: multer.diskStorage({
				destination: function (req, file, cb) {
			    	cb(null, __dirname + dir + destination);
			  	},
				filename: function (req, file, cb) {
			      	filename = angkatan + '.xlsx';
			      	cb(null, filename);
			  	}
			})
		}).any();

		upload(req, res, function(err) {
			// var bitmap = fs.readFileSync(__dirname + dir + destination + '/' + angkatan).toString('hex', 0, 4);
			if (err) {
				res.json({status: false, message: 'Upload data prediksi gagal!', err: err});
			} else {
				res.json({status: true, message: 'Upload data prediksi berhasil!'});
			}
		});
	}
}

module.exports = new NilaiMutuControllers();