<?php
session_start();
include '../config/db.php';

if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit;
}

header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=students_export.csv');

$output = fopen('php://output', 'w');
fputcsv($output, ['Matric No', 'Name', 'Department', 'Level', 'Session', 'CA', 'Exam', 'Total']);

$sql = "SELECT * FROM students ORDER BY id DESC";
$result = mysqli_query($conn, $sql);

while ($row = mysqli_fetch_assoc($result)) {
    fputcsv($output, [$row['matric_no'], $row['name'], $row['department'], $row['level'], $row['session'], $row['CA'], $row['exam'], $row['total']]);
}

fclose($output);
exit;
?>
