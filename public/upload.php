<?php
include '../config/db.php';
    session_start();
    if (!isset($_SESSION['admin_id'])) {
        header("Location: login.php");
        exit;
    }

include '../includes/header.php';

$success = "";
$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_FILES['csv_file']) && $_FILES['csv_file']['error'] === UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['csv_file']['tmp_name'];
        $handle = fopen($fileTmpPath, 'r');

        if ($handle !== FALSE) {
            $row = 0;
            while (($data = fgetcsv($handle, 1000, ',')) !== FALSE) {
                $row++;
                if ($row == 1) continue; // Skip header

                $matric_no = mysqli_real_escape_string($conn, trim($data[0]));
                $name = mysqli_real_escape_string($conn, trim($data[1]));
                $department = mysqli_real_escape_string($conn, trim($data[2]));
                $level = mysqli_real_escape_string($conn, trim($data[3]));
                $session = mysqli_real_escape_string($conn, trim($data[4]));
                $CA = (int) $data[5];
                $exam = (int) $data[6];

                if (empty($matric_no) || empty($name)) {
                    $errors[] = "Row $row: Matric No and Name are required.";
                    continue;
                }

                // Check for duplicates
                $check = mysqli_query($conn, "SELECT id FROM students WHERE matric_no = '$matric_no'");
                if (mysqli_num_rows($check) > 0) {
                    $errors[] = "Row $row: Matric No '$matric_no' already exists.";
                    continue;
                }

                // Insert
                $sql = "INSERT INTO students (matric_no, name, department, level, session, CA, exam)
                        VALUES ('$matric_no', '$name', '$department', '$level', '$session', '$CA', '$exam')";

                if (!mysqli_query($conn, $sql)) {
                    $errors[] = "Row $row: Failed to insert - " . mysqli_error($conn);
                }
            }
            fclose($handle);

            if (empty($errors)) {
                $success = "CSV uploaded and records inserted successfully.";
            }
        } else {
            $errors[] = "Failed to open the uploaded CSV file.";
        }
    } else {
        $errors[] = "Please upload a valid CSV file.";
    }
}
?>

<h4>Upload Students CSV</h4>

<?php if ($success): ?>
    <div class="alert alert-success"><?= $success ?></div>
<?php endif; ?>

<?php if ($errors): ?>
    <div class="alert alert-danger"><?= implode('<br>', $errors) ?></div>
<?php endif; ?>

<form method="POST" enctype="multipart/form-data">
    <div class="mb-3">
        <label>Select CSV File</label>
        <input type="file" name="csv_file" class="form-control" accept=".csv" required>
    </div>
    <button class="btn btn-primary" type="submit">Upload CSV</button>
    <a href="index.php" class="btn btn-secondary">Back</a>
</form>

<div class="mt-4">
    <h6>Sample CSV Format:</h6>
    <pre>matric_no,name,department,level,session,CA,exam
22SCI001,John Doe,Computer Science,300,2024/2025,15,70
22SCI002,Jane Smith,Mathematics,200,2024/2025,18,65</pre>
</div>

<?php include '../includes/footer.php'; ?>
