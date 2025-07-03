<?php
session_start();
include '../config/db.php';
include '../includes/header.php';

if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit;
}

$errors = [];
$success = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $current = $_POST['current'];
    $new = $_POST['new'];
    $confirm = $_POST['confirm'];

    $admin_id = $_SESSION['admin_id'];

    $sql = "SELECT password FROM admins WHERE id = $admin_id";
    $result = mysqli_query($conn, $sql);
    $admin = mysqli_fetch_assoc($result);

    if (!password_verify($current, $admin['password'])) {
        $errors[] = "Current password is incorrect.";
    } elseif ($new !== $confirm) {
        $errors[] = "New passwords do not match.";
    } else {
        $hash = password_hash($new, PASSWORD_DEFAULT);
        $update = "UPDATE admins SET password = '$hash' WHERE id = $admin_id";
        if (mysqli_query($conn, $update)) {
            $success = "Password changed successfully.";
            header("Location: index.php");
        } else {
            $errors[] = "Error updating password: " . mysqli_error($conn);
        }
    }
}
?>

<h4>Change Password</h4>

<?php if ($success): ?>
    <div class="alert alert-success"><?= $success ?></div>
<?php endif; ?>

<?php if ($errors): ?>
    <div class="alert alert-danger"><?= implode('<br>', $errors) ?></div>
<?php endif; ?>

<form method="POST">
    <div class="mb-3">
        <label>Current Password</label>
        <input type="password" name="current" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>New Password</label>
        <input type="password" name="new" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>Confirm New Password</label>
        <input type="password" name="confirm" class="form-control" required>
    </div>
    <button class="btn btn-primary" type="submit">Change Password</button>
    <a href="index.php" class="btn btn-secondary">Cancel</a>
</form>

<?php include '../includes/footer.php'; ?>
