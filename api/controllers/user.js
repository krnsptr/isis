var express = require('express');
var path = require('path');
var jwt = require('jsonwebtoken');
var crypto = require('crypto');

var sequelize = require('../connection');

var User = sequelize.import(__dirname + '/../models/user');
var Role = sequelize.import(__dirname + '/../models/role');
User.belongsTo(Role, { foreignKey: 'role_id' });

var validateEmail = function(email) {
	var regex = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
	return email.match(regex);
}

function UserControllers() {
	this.getAll = function(req, res) {
		User
			.findAll({
				include: [{
					model: Role
				}],
				attributes: [
					'nama',
					'email',
					'status',
				]
			})
			.then((result) => {
				res.json({status: true, message: 'Ambil semua user berhasil!', data: result});
			})
			.catch((err) => {
				res.json({status: false, message: 'Ambil semua user gagal!', err: err});
			});
	}

	this.create = function(req, res) {
		var nama = req.body.nama;
		var email = req.body.email;
		var password = req.body.password;
		var password_konfirmasi = req.body.password_konfirmasi;
		var role_id = req.body.role_id;

		if (!nama || !email || !password || !password_konfirmasi || !role_id) {
			res.json({status: false, message: "Request tidak lengkap!", err_code: 400});
		} else if (password !== password_konfirmasi) {
			res.json({status: false, message: "Password berbeda dengan password konfirmasi!", err_code: 400});
		} else if(password.length < 6) {
			res.json({status: false, message: "Password kurang panjang (minimal 6 karakter)!", err_code: 400});
		} else if (!validateEmail(email)) {
			res.json({status: false, message: "Format email salah!", err_code: 400});
		} else {
			User
				.create({
					nama: nama,
					email: email,
					password: crypto.createHash('sha256').update(password).digest('hex'),
					role_id: role_id
				})
				.then(() => {
					res.json({status: true, message: 'Tambah user berhasil!'});
				})
				.catch((err) => {
					res.json({status: false, message: 'Tambah user gagal!', err_code: 400, err: err});
				});
		}
	}

	this.login = function(req, res){
		var email = req.body.email;
		var password = req.body.password;
		var remember_me = req.body.remember_me;

		if (!email || !password ) {
			res.json({status: false, message: 'Nama atau password user masih kosong!', err_code: 400});
		} else {
			User
				.findAll({
					where: {
						email: email,
						password: crypto.createHash('sha256').update(password).digest('hex'),
						status: true
					},
					attributes: [
						'nama',
						'email',
						'role_id',
						'status'
					]
				})
				.then((result) => {
			      	if (result == null) {
				        res.json({status: false, message:'User tidak ditemukan!', err_code: 400});
			      	} else {
			        	var signInTime = Math.floor(Date.now() / 1000);
			        	if (remember_me == true) {
			          		var expireTime = signInTime + 99999999999;
			        	} else {
			          		var expireTime = signInTime + (2 * 60 * 60);
			        	}
			        	var data = { id: result[0].id, role: result[0].role_id, email: result[0].email, iat: signInTime, exp: expireTime };
			        	var token = jwt.sign(data, "YOUR_KEY_HERE");
			        	res.json({status: true, message: 'Login berhasil!', token: token});
			      	}
		    	})
		    	.catch((err) => {
		    		res.json({status: false, message: 'Login gagal!', err_code: 400, err: err});
		    	});
		}
	}
}

module.exports = new UserControllers();