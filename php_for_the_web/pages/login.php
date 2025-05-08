<?php
include(__DIR__ . '/../src/config/bootstrap.php');

$users = [
    "juan" => "$2y$10\$any.SNFtMIFxD/ZWZP2nFO0ACXSALWFgewRwCpAK7mdAXqR.CbtdW"
];

if (isset($_POST["username"], $_POST["password"])) {
    if (isset($users[$_POST["username"]])) {
        $expectedHash = $users[$_POST["username"]];

        if (password_verify($_POST["password"], $expectedHash)) {
            $_SESSION["authenticated_user"] = $_POST["username"];
            $_SESSION["message"] = "Welcome back, " . htmlspecialchars($_POST["username"], ENT_QUOTES);
            header("Location: secret.php");
            exit();
        } else {
            $_SESSION["message"] = "Invalid password";
        }
    }
}

include(__DIR__ . '/../src/view/layouts/_header.php');
?>
    <form method="post">
        <div>
            <label for="username">
                Username:
            </label>
            <input type="text" name="username" id="username">
        </div>
        <div>
            <label for="password">
                Password:
            </label>
            <input type="password" name="password" id="password">
        </div>
        <div>
            <button type="submit">Submit</button>
        </div>
    </form>

<?php
include(__DIR__ . '/../src/view/layouts/_footer.php');