<?php
include(__DIR__ . '/../../../config/bootstrap.php');

if (!isset($_SESSION['user_id'])) {
    $message = 'You must be logged in to access this page.';
    header('Location: ' . route('/pages/login'));
    exit();
}

$title = 'User Dashboard';
include(__DIR__ . '/../layouts/_header.php');
?>

<h1>User Dashboard</h1>
<div>
    <h2>Welcome, <?= htmlspecialchars($_SESSION['user_name']) ?>!</h2>
    <p>You are logged in as a <?= htmlspecialchars($_SESSION['user_role']) ?>.</p>
    <h3>Your Information</h3>
    <ul>
        <li><strong>Name:</strong> <?= htmlspecialchars($_SESSION['user_name']) ?></li>
        <li><strong>Email:</strong> <?= htmlspecialchars($_SESSION['user_email']) ?></li>
        <li><strong>Role:</strong> <?= htmlspecialchars($_SESSION['user_role']) ?></li>
    </ul>
    <h3>Actions</h3>
    <ul>
        <li><a href="<?= route('/pages/edit_profile') ?>">Edit Profile</a></li>
        <li><a href="<?= route('/pages/change_password') ?>">Change Password</a></li>
        <li><a href="<?= route('/pages/logout') ?>">Logout</a></li>
    </ul>
    <?php if ($_SESSION['user_role'] === 'admin'): ?>
        <h3>Admin Actions</h3>
        <ul>
            <li><a href="<?= route('/pages/admin_dashboard') ?>">Admin Dashboard</a></li>
            <li><a href="<?= route('/pages/manage_users') ?>">Manage Users</a></li>
        </ul>
    <?php endif; ?>
</div>

<?php
include(__DIR__ . '/../layouts/_footer.php');

