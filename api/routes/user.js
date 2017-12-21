var express = require('express');
var router = express.Router();

var user = require('../controllers/user');

/* GET users listing. */
router.get('/all', function(req, res) {
  user.getAll(req, res);
});

router.post('/create', function(req, res) {
  user.create(req, res);
});

router.post('/login', function(req, res) {
  user.login(req, res);
});

module.exports = router;
