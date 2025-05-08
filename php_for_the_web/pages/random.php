<?php
include(__DIR__ . '/../src/config/bootstrap.php');
include(__DIR__ . '/../src/view/layouts/_header.php');

$random_int = random_int(1, 10);
?>

    <h1>Your lucky number is: <?php echo $random_int ?>  </h1>

<?php if ($random_int > 5): ?>
    <h2> Nice!, <?php
        if (isset($_SESSION['name'])) {
            echo htmlspecialchars($_SESSION['name'], ENT_QUOTES);
        } else {
            echo "stranger";
        }
        ?>
    </h2>
<?php else: ?>
    <h2> Bad luck! </h2>
<?php endif; ?>

    <form method="get" action="pictures.php">
        <input type="hidden" name="number" value="<?php
        echo $random_int
        ?>">
        <button type="submit">
            Now show me <?php echo $random_int; ?> Kittens!
        </button>
    </form>

<?php
include(__DIR__ . '/../src/view/layouts/_footer.php');