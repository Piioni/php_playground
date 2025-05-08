<?php
include(__DIR__ . '/../src/config/bootstrap.php');

if (!isset($_SESSION["authenticated_user"])) {
    header("Location: login.php");
    exit;
}

include(__DIR__ . '/../src/view/layouts/_header.php');
?>

    <p>Here's something special for users who are logged in:</p>
    <p><img src="assets/images/elephpant.png" alt="An elephpant"></p>

<?php
include(__DIR__ . '/../src/view/layouts/_footer.php');