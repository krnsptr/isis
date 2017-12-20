var express = require('express');
var router = express.Router();

var mahasiswa = require('../controllers/mahasiswa');

/* GET users listing. */
router.post('/ipk/sebaran', function(req, res) {
  mahasiswa.sebaranIpkAngkatan(req, res);
});

router.post('/create', function(req, res) {
  mahasiswa.create(req, res);
});

module.exports = router;
