<?php
session_start();
require "connect.php";

if (!isset($_SESSION['teacher_id'])) {
    header("Location: login.php");
    exit;
}

$course_id = $_GET['course_id'];

$stmt = $conn->prepare("
    SELECT s.id, s.name, s.email
    FROM students s
    JOIN enrollment e ON s.id = e.student_id
    WHERE e.course_id = ?
");
$stmt->execute([$course_id]);
$students = $stmt->fetchAll(PDO::FETCH_ASSOC);

$msg = $_GET['msg'] ?? '';
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Course Students</title>

<style>
body {
    font-family: Arial, sans-serif;
    background-color: #e6e6e6;
    margin: 0;
    padding: 20px;
    text-align: center;
}

h2 {
    background-color: #7a6e8f;
    color: white;
    display: inline-block;
    padding: 12px 26px;
    border-radius: 8px;
    font-weight: bold;
    box-shadow: 2px 2px 8px rgba(0,0,0,0.3);
    margin-bottom: 15px;
}

table {
    width: 80%;
    margin: 25px auto;
    border-collapse: collapse;
    background-color: #c8c5cd;
    border-radius: 6px;
    overflow: hidden;
    box-shadow: 2px 2px 10px rgba(0,0,0,0.2);
}

th, td {
    border: 1px solid #b5b2bb;
    padding: 8px;
}

th {
    background-color: #6a5b7f;
    color: white;
    font-size: 16px;
}

td a {
    background-color: #7a6e8f;
    color: white;
    padding: 5px 12px;
    border-radius: 5px;
    text-decoration: none;
    font-weight: bold;
}

td a:hover {
    opacity: 0.85;
}

.nav-btn {
    width: 400px;
    padding: 10px 16px;
    font-size: 16px;
    background-color: #7a6e8f;
    border: none;
    color: white;
    border-radius: 6px;
    cursor: pointer;
    margin-top: 10px;
}

.nav-btn:hover {
    opacity: 0.9;
}
</style>

</head>
<body>

<h2>Students in Course #<?= htmlspecialchars($course_id) ?></h2>

<?php if ($msg === 'enrolled'): ?>
    <p style="color:green; font-weight:bold;">Course enrolled successfully ✅</p>
<?php endif; ?>

<table>
    <tr>
        <th>Student ID</th>
        <th>Name</th>
        <th>Email</th>
        <th>Action</th>
    </tr>

    <?php foreach ($students as $s): ?>
    <tr>
        <td><?= htmlspecialchars($s['id']) ?></td>
        <td><?= htmlspecialchars($s['name']) ?></td>
        <td><?= htmlspecialchars($s['email']) ?></td>
        <td>
            <a href="addgrade.php?student_id=<?= $s['id'] ?>&course_id=<?= $course_id ?>">Add Grade</a>
        </td>
    </tr>
    <?php endforeach; ?>

</table>

<div>
    <button class="nav-btn" onclick="window.location.href='dashboard.php'">Back</button>
</div>

<div>
    <button class="nav-btn" onclick="window.location.href='index.html'">Logout</button>
</div>

</body>
</html>
