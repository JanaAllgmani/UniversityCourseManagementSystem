<?php
session_start();
require "connect.php";

if (!isset($_SESSION['student_id'])) {
    header("Location: login_student.html");
    exit;
}

$studentId = $_SESSION['student_id'];

$stmt = $conn->prepare("
    SELECT c.id, c.code, c.title, c.credits, c.department, e.grade AS grade
    FROM enrollment e
    JOIN courses c ON c.id = e.course_id
    WHERE e.student_id = ?
");
$stmt->execute([$studentId]);

$courses = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Student Dashboard</title>
<style>
        body {
            font-family: Arial;
            background-color: #f0f0f0;
            padding: 20px;
            text-align: center;
        }
        
        h2 {
            background-color: white;
            color: #432c5aff;
            display: inline-block;
            padding: 12px 26px;
            border-radius: 8px;
            font-weight: bold;
            box-shadow: 2px 2px 8px rgba(0,0,0,0.3);
            margin-bottom: 15px;
            text-align: center;
        }

        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
            background-color: #a5a5a5b1;
        }
        th, td {
            border: 1px solid #a5a5a5b1;
            padding: 8px;
            text-align: center;
        }
        th {
            background-color: #60398fb6;
            color: white;
        }
        button {
            width: 400px;
            padding: 10px 16px;
            font-size: 16px;
            background-color: #60398fb6;
            border: none;
            color: white;
            border-radius: 6px;
            cursor: pointer;
            display: block;
            margin: 15px auto;
        }
        button:hover {
            opacity: 0.9;
        }
</style>
</head>
<body>

<h2>Student Dashboard</h2>

<table border="1">
<tr>
    <th>Course ID</th>
    <th>Code</th>
    <th>Title</th>
    <th>Credits</th>
    <th>Department</th>
    <th>Grade</th>
</tr>

<?php foreach ($courses as $c): ?>
<tr>
    <td><?= htmlspecialchars($c['id']) ?></td>
    <td><?= htmlspecialchars($c['code']) ?></td>
    <td><?= htmlspecialchars($c['title']) ?></td>
    <td><?= htmlspecialchars($c['credits']) ?></td>
    <td><?= htmlspecialchars($c['department']) ?></td>
    <td><?= htmlspecialchars($c['grade'] ?? "Not graded yet") ?></td>
</tr>
<?php endforeach; ?>
</table>

<button onclick="window.location.href='listcourses.php'">Enroll in a New Course</button>
<button onclick="window.location.href='student.html'">Back</button>
<button onclick="window.location.href='login_student.html'">Logout</button>

</body>
</html>
