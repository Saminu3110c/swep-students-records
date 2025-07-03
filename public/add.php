<?php
include '../config/db.php';
    session_start();
    if (!isset($_SESSION['admin_id'])) {
        header("Location: login.php");
        exit;
    }

include '../includes/header.php';

$errors = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $matric_no = $_POST['matric_no'];
    $name = $_POST['name'];
    $department = $_POST['department'];
    $level = $_POST['level'];
    $session = $_POST['session'];
    $CA = $_POST['CA'];
    $exam = $_POST['exam'];

    if (empty($matric_no) || empty($name)) {
        $errors[] = "Matric No and Name are required.";
    }

    if (empty($errors)) {
        $sql = "INSERT INTO students (matric_no, name, department, level, session, CA, exam)
                VALUES ('$matric_no', '$name', '$department', '$level', '$session', '$CA', '$exam')";
        if (mysqli_query($conn, $sql)) {
            header("Location: index.php");
            exit;
        } else {
            $errors[] = "Error: " . mysqli_error($conn);
        }
    }
}
?>

<h4>Add New Student</h4>

<?php if ($errors): ?>
    <div class="alert alert-danger"><?= implode('<br>', $errors) ?></div>
<?php endif; ?>

<form method="POST">
    <div class="mb-3">
        <label>Matric No</label>
        <input type="text" name="matric_no" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>Name</label>
        <input type="text" name="name" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>Department</label>
        <input type="text" name="department" class="form-control">
    </div>
    <div class="mb-3">
        <label>Level</label>
        <input type="text" name="level" class="form-control">
    </div>
    <div class="mb-3">
        <label>Session</label>
        <input type="text" name="session" class="form-control">
    </div>
    <div class="mb-3">
        <label>CA</label>
        <input type="number" name="CA" class="form-control" value="0">
    </div>
    <div class="mb-3">
        <label>Exam</label>
        <input type="number" name="exam" class="form-control" value="0">
    </div>
    <button class="btn btn-primary" type="submit">Add Student</button>
</form>

<?php include '../includes/footer.php'; ?>
