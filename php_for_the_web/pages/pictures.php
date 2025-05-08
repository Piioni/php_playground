<?php
include(__DIR__ . '/../src/config/bootstrap.php');
include(__DIR__ . '/../src/view/layouts/_header.php');
?>

    <h1>Here are your kittens!</h1>

    <form>
        <!-- Input para seleccionar la imagen -->
        <div>
            <?php
            $pictures = [
                'cat.jpg' => 'Cat',
                'uglycat.jpg' => 'Ugly cat',
                'butterdog.jpeg' => 'Butter dog',
            ];
            ?>

            <label for="picture"> Picture? </label>
            <select name="picture" id="picture">
                <?php foreach ($pictures as $filename => $description) {
                    ?>
                    <option value="<?php
                    echo htmlspecialchars($filename, ENT_QUOTES);
                    ?>"<?php
                    if (isset($_GET['picture']) && $_GET['picture'] === $filename) {
                        ?> selected<?php
                    }
                    ?>>
                        <?php echo htmlspecialchars($description, ENT_QUOTES); ?>
                    </option>
                    <?php
                } ?>
            </select>
        </div>

        <!-- Input para seleccionar cuantas images quieres mostrar  -->
        <div>
            <label for="number">
                Number of kittens to show:
            </label>
            <input name="number" id="number"
                   value="<?php
                   if (isset($_GET["number"])) {
                       echo htmlspecialchars($_GET["number"], ENT_QUOTES);
                   } ?>"
        </div>
        <div>
            <button type="submit">Submit</button>
        </div>
    </form>


<?php
$numberOfPictures = isset($_GET['number']) ? (int)$_GET['number'] : 1;
if ($numberOfPictures < 1) {
    $numberOfPictures = 1;
}

$picture = $_GET["picture"] ?? "cat.jpg";

echo $picture . "<br>";

for ($i = 1; $i <= $numberOfPictures; $i++) {
    ?>
    <?php echo $pictures[$picture], $i; ?>:
    <img src="./assets/images/<?php echo $picture ?>" alt="Picture <?php echo $i; ?>">
    <br>
    <?php
}

$nombre = "pepe";
$nombre = "juan";

echo "<br>" . "El mamawebo en cueston es: " . $nombre . "<br>";

?>
    <p>
        <a href="random.php">
            Back to random number
        </a>
    </p>

<?php
include(__DIR__ . '/../src/view/layouts/_footer.php');