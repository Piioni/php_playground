<?php
include(__DIR__ . '/../../src/config/bootstrap.php');
require_once __DIR__ . '/../../src/config/config.php';

$toursJsonFile = __DIR__ . '/../../data/tours.json';
if (file_exists($toursJsonFile)) {
    $jsonData = file_get_contents($toursJsonFile);
    $toursData = json_decode($jsonData, true);
} else {
    $toursData = [];
}

$formErrors = [];

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $normalizedData = [
        "destination" =>
            isset($_POST["destination"])
                ? (string)$_POST['destination']
                : "",
        "number_of_tickets_available" =>
            isset($_POST["number_of_tickets_available"])
                ? (int)$_POST["number_of_tickets_available"]
                : 0,
        "is_accessible" =>
            isset($_POST["is_accessible"])
    ];

    // Validate the form data
    if ($normalizedData["destination"] === "") {
        $formErrors["destination"] = "Destination is required.";
    }
    if ($normalizedData["number_of_tickets_available"] <= 0) {
        $formErrors["number_of_tickets_available"] = "Number of tickets available must be greater than 0.";
    }

    // If there are no errors, save the data
    if (empty($formErrors)) {
        $toursData[] = $normalizedData;
        $jsonData = json_encode($toursData, JSON_PRETTY_PRINT);
        file_put_contents($toursJsonFile, $jsonData);

        $_SESSION['message'] = 'The new tour was saved successfully';
        header('Location: ' . route('/pages/tours/create_tour.php'));
        exit;
    }
}


include(__DIR__ . '/../../src/view/layouts/_header.php');
?>

    <h1>Create a tour!</h1>
    <form method="post">
        <div>
            <label for="destination">
                Destination:
            </label>
            <input type="text" id="destination" name="destination" value="<?php
            echo isset($normalizedData['destination'])
                ? htmlspecialchars($normalizedData['destination'], ENT_QUOTES)
                : '';
            ?>">

            <?php
            if (isset($formErrors['destination'])) :
                ?>
                <strong>
                    <?php
                    echo $formErrors['destination'];
                    ?>
                </strong>
            <?php
            endif
            ?>
        </div>
        <div>
            <label for="number_of_tickets_available">
                Number of tickets available:
            </label>
            <input type="number" id="number_of_tickets_available" name="number_of_tickets_available" value="<?php
            echo isset($normalizedData['number_of_tickets_available'])
                ? htmlspecialchars($normalizedData['number_of_tickets_available'], ENT_QUOTES)
                : '';
            ?>">

            <?php
            if (isset($formErrors['number_of_tickets_available'])) :
                ?>
                <strong>
                    <?php
                    echo $formErrors['number_of_tickets_available'];
                    ?>
                </strong>
            <?php
            endif
            ?>
        </div>
        <div>
            <label for="is_accessible">
                Is accessible:
            </label>
            <input type="checkbox" id="is_accessible" name="is_accessible" value="yes"<?php
                if (isset($normalizedData['is_accessible']) && $normalizedData['is_accessible']) :
                ?> checked<?php
            endif
            ?>
        </div>
        <div>
            <button type="submit">Create Tour</button>
        </div>
    </form>
<?php
include(__DIR__ . '/../../src/view/layouts/_footer.php');

