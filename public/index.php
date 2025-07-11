<?php
include '../config/db.php';
    session_start();
    if (!isset($_SESSION['admin_id'])) {
        header("Location: login.php");
        exit;
    }

include '../includes/header.php';

$search = $_GET['search'] ?? '';
$per_page = 10; // records per page
$page = $_GET['page'] ?? 1;
$start = ($page - 1) * $per_page;

$total_sql = "SELECT COUNT(*) FROM students WHERE 
        matric_no LIKE '%$search%' OR 
        name LIKE '%$search%' OR 
        department LIKE '%$search%' OR 
        level LIKE '%$search%' OR 
        session LIKE '%$search%'";
$total_result = mysqli_query($conn, $total_sql);
$total_row = mysqli_fetch_row($total_result);
$total_records = $total_row[0];
$total_pages = ceil($total_records / $per_page);

$sql = "SELECT * FROM students WHERE 
        matric_no LIKE '%$search%' OR 
        name LIKE '%$search%' OR 
        department LIKE '%$search%' OR 
        level LIKE '%$search%' OR 
        session LIKE '%$search%' 
        ORDER BY id DESC
        LIMIT $start, $per_page";

// $sql = "SELECT * FROM students WHERE 
//         matric_no LIKE '%$search%' OR 
//         name LIKE '%$search%' OR 
//         department LIKE '%$search%' OR 
//         level LIKE '%$search%' OR 
//         session LIKE '%$search%' 
//         ORDER BY id DESC";

$result = mysqli_query($conn, $sql);
?>

<form class="d-flex mb-3" method="GET">
    <input class="form-control me-2" type="search" name="search" placeholder="Search records..." value="<?= htmlspecialchars($search) ?>">
    <button class="btn btn-primary" type="submit">Search</button>
</form>

<a href="add.php" class="btn btn-success mb-3">Add New Student</a>
<a href="upload.php" class="btn btn-secondary mb-3">Upload CSV</a>
<a href="export.php" class="btn btn-info mb-3">Export CSV</a>


<table class="table table-bordered table-striped">
    <thead class="table-dark">
        <tr>
            <th>Matric No</th>
            <th>Name</th>
            <th>Department</th>
            <th>Level</th>
            <th>Session</th>
            <th>CA</th>
            <th>Exam</th>
            <th>Total</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
    <?php if (mysqli_num_rows($result) > 0): ?>
        <?php while($row = mysqli_fetch_assoc($result)): ?>
        <tr>
            <td><?= htmlspecialchars($row['matric_no']) ?></td>
            <td><?= htmlspecialchars($row['name']) ?></td>
            <td><?= htmlspecialchars($row['department']) ?></td>
            <td><?= htmlspecialchars($row['level']) ?></td>
            <td><?= htmlspecialchars($row['session']) ?></td>
            <td><?= $row['CA'] ?></td>
            <td><?= $row['exam'] ?></td>
            <td><?= $row['total'] ?></td>
            <td>
                <a href="edit.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-warning">Edit</a>
                <a href="delete.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Delete this student?')">Delete</a>
            </td>
        </tr>
        <?php endwhile; ?>
    <?php else: ?>
        <tr><td colspan="9" class="text-center">No records found</td></tr>
    <?php endif; ?>
    </tbody>
</table>
<nav>
  <ul class="pagination justify-content-center">
    <?php for ($i = 1; $i <= $total_pages; $i++): ?>
      <li class="page-item <?= ($i == $page) ? 'active' : '' ?>">
        <a class="page-link" href="?page=<?= $i ?>&search=<?= urlencode($search) ?>"><?= $i ?></a>
      </li>
    <?php endfor; ?>
  </ul>
</nav>


<?php include '../includes/footer.php'; ?>
