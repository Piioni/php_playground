<?php
include (__DIR__ . '/../../../config/bootstrap.php');
require __DIR__ . '/../../controllers/AuthController.php';

$title = 'Logout';

$auth = new AuthController();
$auth->logout();


