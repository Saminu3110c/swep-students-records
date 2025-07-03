<?php
include '../config/db.php';

$id = $_GET['id'] ?? null;

if (!$id) {
    header("Location: index.php");
    exit;
}

// Delete the student record
$sql = "DELETE FROM students WHERE id = $id";

if (mysqli_query($conn, $sql)) {
    header("Location: index.php");
    exit;
} else {
    echo "Error deleting record: " . mysqli_error($conn);
}
?>
