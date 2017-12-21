var express = require('express');
var router = express.Router();

var mahasiswa = require('../controllers/mahasiswa');

/* GET users listing. */
router.post('/ipk/sebaran', function(req, res) {
  mahasiswa.sebaranIpkAngkatan(req, res);
});

router.post('/ipk/prediksi', function(req, res) {
  mahasiswa.prediksiIpkAngkatan(req, res);
});

router.post('/kelulusan/prediksi', function(req, res) {
  mahasiswa.prediksiKelulusanAngkatan(req, res);
});

module.exports = router;
