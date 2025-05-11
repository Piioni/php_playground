<?php
include(__DIR__ . '/../../../config/bootstrap.php');

$title = 'Homepage';
include(__DIR__ . '/../layouts/_header.php');
?>

    <h1>
        This is the homepage!
    </h1>
    <div>
        You are currently logged in as <?= htmlspecialchars($_SESSION['user_name']) ?>.
    </div>

<?php
include(__DIR__ . '/../layouts/_footer.php');
