<?php
include(__DIR__ . '/../../../config/bootstrap.php');

$title = 'Login';
include(__DIR__ . '/../layouts/_header.php');
?>

<h1>Login</h1>
<div>
    <form method="post">
        <div>
            <label for="email">
                Email:
            </label>
            <input type="email" id="email" name="email">
        </div>
        <div>
            <label for="password">
                Password:
            </label>
            <input type="password" id="password" name="password">
        </div>
        <button type="submit">Login</button>
    </form>
    <p> Don't have an account? <a href="register.php">Register here!</a></p>
</div>

<?php
include(__DIR__ . '/../layouts/_footer.php');