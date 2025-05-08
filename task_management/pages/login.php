<?php
include(__DIR__ . '/../src/config/bootstrap.php');

$users = [
    'admin' => '$2y$10$pdcfm8V0lBESfNOZR9L2e.DTt13AxxwpeQ21MEzsRrfLE7xdPvflu',
    'user' => '$2y$10$9SiP5KpTdvh6ORIo5uNUZOaH4DT9qsHeIPYIuhH4wjdqVROIcP9Uy',
    'juan' => '$2y$10$any.SNFtMIFxD/ZWZP2nFO0ACXSALWFgewRwCpAK7mdAXqR.CbtdW',
];

if (isset($_POST["username"], $_POST["password"])) {
    if ( isset($users[$_POST["username"]])) {
        $expectedHash  = $users[$_POST["username"]];

        if (password_verify($_POST["password"], $expectedHash)) {
            $_SESSION["authenticated_user"] = $_POST["username"];
            $_SESSION["message"] = "Welcome back, " . htmlspecialchars($_POST["username"], ENT_QUOTES);
            header("Location: ./tasks.php");
            exit();
        } else {
            $_SESSION["message"] = "Invalid password";
        }
    }
}


$title = 'Login';
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
