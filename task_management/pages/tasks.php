<?php
include(__DIR__ . '/../src/config/bootstrap.php');

if (!isset($_SESSION["authenticated_user"])) {
    header('Location: login.php');
    exit;
}

$username = $_SESSION["authenticated_user"];
if (isset($_POST["task"]) && $_POST["task"] !== '') {
    $_SESSION["task"][$username][] = $_POST["task"];
    $_SESSION["message"] = "Task added successfully.";
}


$title = 'Tasks';
include(__DIR__ . '/../src/view/layouts/_header.php');
?>

    <h1>Manage Tasks</h1>
    <p>New task.</p>

    <form method="post">
        <div>
            <label for="task">
                Task:
            </label>
            <input type="text" name="task" id="task">
        </div>
        <div>
            <button type="submit">Submit</button>
        </div>
    </form>

    <h2>Tasks:</h2>

<?php
$allTasks = $_SESSION["task"][$username] ?? [];
?>
    <ul>
<?php foreach ($allTasks as $task): ?>
    <li><?php echo htmlspecialchars($task, ENT_QUOTES) ?></li>
<?php endforeach;
?>
    </ul>

    <p>
        <a href="./logout.php">Log out</a>
    </p>
<?php
include(__DIR__ . '/../src/view/layouts/_footer.php');




