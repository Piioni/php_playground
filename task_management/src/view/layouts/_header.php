<?php
require_once __DIR__ . '/../../config/config.php';

$title = $title ?? 'Task management application';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title> <?php echo htmlspecialchars($title, ENT_QUOTES) ?> </title>
</head>
<body>
<div>
    <nav>
        <ul>
            <li>
                <a href="<?php echo route("/pages/homepage.php"); ?>">Home</a>
            </li>
            <li>
                <a href="<?php echo route('/pages/tasks.php'); ?>">Tasks</a>
            </li>

            <?php
            if (isset($_SESSION["authenticated_user"])) :
                ?>
                <li>
                    you are logged in as
                    <?php echo htmlspecialchars($_SESSION["authenticated_user"], ENT_QUOTES) ?>
                </li>
                <li>
                    <a href="<?php echo route('/pages/logout.php'); ?>">Log out</a>
                </li>
            <?php else : ?>
                <li>
                    <a href="<?php echo route('/pages/login.php'); ?>">Log in</a>
                </li>
            <?php endif; ?>
        </ul>
    </nav>