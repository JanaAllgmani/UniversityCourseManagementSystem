
<?php
require "connect.php";

$student_id = $_GET['id'];

$stmt = $conn->prepare("SELECT * FROM students WHERE id = ?");
$stmt->execute([$student_id]);
$student = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Student Profile</title>
</head>
<body>

<h2>Welcome, <?= htmlspecialchars($student['name']) ?></h2>

<p><strong>Email:</strong> <?= htmlspecialchars($student['email']) ?></p>
<p><strong>Major:</strong> <?= htmlspecialchars($student['major']) ?></p>
<p><strong>Age:</strong> <?= htmlspecialchars($student['age']) ?></p>

<hr>

<h3>Menu</h3>
<ul>
    <li><a href="student_courses.php?id=<?= $student['id'] ?>">My Courses</a></li>
    <li><a href="student_grades.php?id=<?= $student['id'] ?>">My Grades</a></li>
    <li><a href="student_search.php?id=<?= $student['id'] ?>">Search Courses</a></li>
</ul>

</body>
</html>