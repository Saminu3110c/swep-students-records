<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>SWEP Students Records</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
    <?php if (isset($_SESSION['admin_username'])): ?>
    <div class="mb-3">
        Logged in as <strong><?= htmlspecialchars($_SESSION['admin_username']) ?></strong>
        <a href="logout.php" class="btn btn-sm btn-outline-danger ms-3">Logout</a>
    </div>
    <?php endif; ?>
<h2 class="text-center mb-4">SWEP Students Records Management</h2>
