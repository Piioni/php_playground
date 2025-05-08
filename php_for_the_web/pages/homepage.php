<?php

include(__DIR__ . '/../src/config/bootstrap.php');

$title = 'Homepage';
include(__DIR__ . '/../src/view/layouts/_header.php');
?>
    <h1>This is the homepage</h1>
    <p><a href="<?php echo route("/pages/random.php") ?>">Get yourself a random number</a></p>

<?php
include(__DIR__ . '/../src/view/layouts/_footer.php');