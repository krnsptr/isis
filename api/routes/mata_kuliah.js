var express = require('express');
var router = express.Router();

var mata_kuliah = require('../controllers/mata_kuliah');

/* GET users listing. */
router.get('/all', function(req, res) {
  mata_kuliah.getAll(req, res);
});

module.exports = router;
