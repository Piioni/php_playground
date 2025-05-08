<?php
include (__DIR__ . '/../src/config/bootstrap.php');
$title = 'Homepage';
include (__DIR__ . '/../src/view/layouts/_header.php');
?>
    <h1>This is the homepage</h1>
    <p>You can save tasks by clicking on the button below:</p>
    <p><a href="../pages/tasks.php">Click me</a></p>

<?php
include (__DIR__ . '/../src/view/layouts/_footer.php');
