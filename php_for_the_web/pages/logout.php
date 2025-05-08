<?php
include(__DIR__ . '/../src/config/bootstrap.php');
require_once __DIR__ . '/../src/config/config.php';


unset($_SESSION['authenticated_user']);

header('Location: '  . route('/pages/login.php'));
exit;