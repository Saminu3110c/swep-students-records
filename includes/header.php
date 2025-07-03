<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>SWEP Students Records</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

</head>
<body>
<div class="container mt-4">
    <?php if (isset($_SESSION['admin_username'])): ?>
    <div class="alert alert-primary d-flex justify-content-between align-items-center mb-3">
        <div>
            <i class="bi bi-person-circle"></i>
            Logged in as <strong><?= htmlspecialchars($_SESSION['admin_username']) ?></strong>
        </div>
        <div>
        <a href="register.php" class="btn btn-sm btn-secondary">
            <i class="bi bi-person-plus"></i> New User
        </a>
        <a href="change_password.php" class="btn btn-sm btn-secondary">
            <i class="bi bi-key"></i> Change Password
        </a>
        <a href="logout.php" class="btn btn-sm btn-danger">
            <i class="bi bi-box-arrow-right"></i> Logout
        </a>
        </div>
    </div>
    <?php endif; ?>

<h2 class="text-center mb-4">SWEP Students Records Management</h2>
