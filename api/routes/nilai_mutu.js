var express = require('express');
var router = express.Router();

var nilai_mutu = require('../controllers/nilai_mutu');

/* GET users listing. */
router.post('/sebaran', function(req, res) {
  nilai_mutu.sebaranNilaiMutu(req, res);
});

router.post('/create', function(req, res) {
  nilai_mutu.create(req, res);
});

router.post('/upload/', function(req, res) {
  nilai_mutu.upload(req, res);
});

module.exports = router;
