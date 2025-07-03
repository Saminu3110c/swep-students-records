<?php
include '../config/db.php';
    session_start();
    if (!isset($_SESSION['admin_id'])) {
        header("Location: login.php");
        exit;
    }

include '../includes/header.php';

$id = $_GET['id'] ?? null;

if (!$id) {
    header("Location: index.php");
    exit;
}

// Fetch current student data
$sql = "SELECT * FROM students WHERE id = $id";
$result = mysqli_query($conn, $sql);
$student = mysqli_fetch_assoc($result);

if (!$student) {
    echo "<div class='alert alert-danger'>Student not found.</div>";
    include '../includes/footer.php';
    exit;
}

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
        $sql = "UPDATE students SET 
                    matric_no = '$matric_no',
                    name = '$name',
                    department = '$department',
                    level = '$level',
                    session = '$session',
                    CA = '$CA',
                    exam = '$exam'
                WHERE id = $id";
        if (mysqli_query($conn, $sql)) {
            header("Location: index.php");
            exit;
        } else {
            $errors[] = "Error updating record: " . mysqli_error($conn);
        }
    }
}
?>

<h4>Edit Student Record</h4>

<?php if ($errors): ?>
    <div class="alert alert-danger"><?= implode('<br>', $errors) ?></div>
<?php endif; ?>

<form method="POST">
    <div class="mb-3">
        <label>Matric No</label>
        <input type="text" name="matric_no" class="form-control" value="<?= htmlspecialchars($student['matric_no']) ?>" required>
    </div>
    <div class="mb-3">
        <label>Name</label>
        <input type="text" name="name" class="form-control" value="<?= htmlspecialchars($student['name']) ?>" required>
    </div>
    <div class="mb-3">
        <label>Department</label>
        <input type="text" name="department" class="form-control" value="<?= htmlspecialchars($student['department']) ?>">
    </div>
    <div class="mb-3">
        <label>Level</label>
        <input type="text" name="level" class="form-control" value="<?= htmlspecialchars($student['level']) ?>">
    </div>
    <div class="mb-3">
        <label>Session</label>
        <input type="text" name="session" class="form-control" value="<?= htmlspecialchars($student['session']) ?>">
    </div>
    <div class="mb-3">
        <label>CA</label>
        <input type="number" name="CA" class="form-control" value="<?= htmlspecialchars($student['CA']) ?>">
    </div>
    <div class="mb-3">
        <label>Exam</label>
        <input type="number" name="exam" class="form-control" value="<?= htmlspecialchars($student['exam']) ?>">
    </div>
    <button class="btn btn-primary" type="submit">Update Student</button>
    <a href="index.php" class="btn btn-secondary">Cancel</a>
</form>

<?php include '../includes/footer.php'; ?>
