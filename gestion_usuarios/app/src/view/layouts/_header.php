<?php
require_once(__DIR__ . '/../../../config/bootstrap.php');
require_once(__DIR__ . '/../../../config/config.php');

$title = "";

?>

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <title><?php echo htmlspecialchars($title, ENT_QUOTES) ?></title>
        <link rel="stylesheet" href="">
    </head>
<body>
<nav>
    <ul>
        <li>
            <a href="<?php echo route('/homepage') ?>">Home</a>
        </li>
        <li>
            <a href="<?php echo route('/login') ?>">Login</a>
        </li>
        <li>
            <a href="<?php echo route('/register') ?>">Register</a>
        </li>
    </ul>
</nav>



<?php
include __DIR__ . '/../partials/_alerts.php';

