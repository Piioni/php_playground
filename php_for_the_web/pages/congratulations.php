<?php

$languages = [
    "en" => "English",
    "es" => "Spanish",
    "de" => "German"
];

$defaultLanguage = "en";
$selectedLanguage = $defaultLanguage;

// Comprobamos si el usuario ha seleccionado un idioma
if (isset($_GET["language"])) {
    $selectedLanguage = $_GET["language"];
} elseif (isset($_COOKIE["language"])) {
    $selectedLanguage = $_COOKIE["language"];
}

// Si el usuario selecciona un idioma diferente al que tenemos en el array, lo cambiamos al idioma por defecto
if (!isset($languages[$selectedLanguage])) {
    $selectedLanguage = $defaultLanguage;
}

setcookie("language", $selectedLanguage);

$messages = [
    "en" => "Welcome to our website!",
    "es" => "¡Bienvenido a nuestro sitio web!",
    "de" => "Willkommen auf unserer"
];


?>

<?php
$title = "Congratulations";
include(__DIR__ . '/../src/view/layouts/_header.php');
?>

<h1> Welcome!</h1>

<form method="get">
    <div>
        <label for="language">
            language:
        </label>
        <select name="language" id="language">
            <?php
            foreach ($languages as $code => $name) {
                ?>
                <option value="<?php
                echo htmlspecialchars($code, ENT_QUOTES); ?>"
                    <?php
                    if ($code === $selectedLanguage) {
                        ?> selected<?php
                    }
                    ?>>
                    <?php echo htmlspecialchars($name, ENT_QUOTES); ?>
                </option>
                <?php
            }
            ?>
        </select>

        <button type="submit">Submit</button>
    </div>


</form>

<p class="message">
    <?php
    echo $messages[$selectedLanguage];
    ?>
</p>

<?php
include(__DIR__ . '/../src/view/layouts/_footer.php');