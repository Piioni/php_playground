<?php
require_once __DIR__ . '/../../config/config.php';
$pageTitle = $pageTitle ?? 'PHP for the Web';
?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <title><?php echo htmlspecialchars($pageTitle, ENT_QUOTES); ?></title>
        <link rel="stylesheet" href="../../pages/assets/bootstrap.min.css">
    </head>
<body>
<div class="container">
    <nav class="navbar navbar-expand-lg bg-light">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="<?php echo route('/'); ?>">HomePage</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo route('/name'); ?>">Name</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo route('/random'); ?>">Random</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo route('/secret'); ?>">Secret</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo route('/pictures'); ?>">Pictures</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo route('/create_tour'); ?>">Tours</a>
            </li>

            <?php
            if (isset($_SESSION["authenticated_user"])) {
                ?>
                <li class="navbar-text">
                    You are logged in as
                    <?php echo htmlspecialchars($_SESSION["authenticated_user"], ENT_QUOTES); ?>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo route('/logout'); ?>"> Log out </a>
                </li>
            <?php } else {
                ?>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo route('/login'); ?>"> Log in </a>
                </li>
                <?php
            }
            ?>
        </ul>
    </nav>

<?php
include __DIR__ . '/_flash_message.php';
?>