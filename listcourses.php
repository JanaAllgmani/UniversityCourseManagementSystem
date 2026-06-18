<?php
session_start();
require "connect.php";

$stmt = $conn->prepare("SELECT * FROM courses");
$stmt->execute();
$courses = $stmt->fetchAll(PDO::FETCH_ASSOC);

$search = $_GET['search'] ?? '';
if ($search) {
    $stmt = $conn->prepare("
        SELECT * FROM courses 
        WHERE code LIKE ? OR title LIKE ? OR department LIKE ?
    ");
    $like = "%$search%";
    $stmt->execute([$like, $like, $like]);
    $courses = $stmt->fetchAll(PDO::FETCH_ASSOC);
}

$msg = $_GET['msg'] ?? '';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Course List</title>
    <style>
        body {
            font-family: Arial;
            background-color: #f0f0f0;
            padding: 20px;
        }
        h2 {
            text-align: center;
            color: #282727ff;
            padding: 10px 24px;
            border-radius: 8px;
            display: inline-block;
            width: auto;
            margin: 0 auto 15px auto;
            box-shadow: 2px 2px 10px rgba(0,0,0,0.25);
            font-weight: bold;
        }
        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
            background-color: #a5a5a5b1;
            border-radius: 6px;
            overflow: hidden;
            box-shadow: 2px 2px 10px rgba(0,0,0,0.2);
        }
        th, td {
            border: 1px solid #a5a5a5b1;
            padding: 8px;
            text-align: center;
        }
        th {
            background-color: #60398fb6;
            color: white;
            font-size: 16px;
        }
        .msg {
            text-align: center;
            color: green;
            font-weight: bold;
            margin-bottom: 15px;
        }
        button, .btn-enroll {
            width: 400px;
            padding: 10px 16px;
            font-size: 16px;
            background-color: #60398fb6;
            border: none;
            color: white;
            border-radius: 6px;
            cursor: pointer;
        }
        .btn-enroll {
            width: auto;
            padding: 6px 12px;
            font-size: 15px;
        }
        button:hover {
            opacity: 0.9;
        }
    </style>
</head>
<body>

<center><h2>Available Courses</h2></center>

<?php if ($msg == 'ok'): ?>
    <p class="msg">Student enrolled successfully </p>
<?php endif; ?>

<table>
    <tr>
        <th>Course ID</th>
        <th>Code</th>
        <th>Title</th>
        <th>Department</th>
        <th>Credits</th>
        <th>Capacity</th>
        <th>Enroll</th>
    </tr>

    <?php foreach ($courses as $course): ?>
        <tr>
            <td><?= htmlspecialchars($course['id']) ?></td>
            <td><?= htmlspecialchars($course['code']) ?></td>
            <td><?= htmlspecialchars($course['title']) ?></td>
            <td><?= htmlspecialchars($course['department']) ?></td>
            <td><?= htmlspecialchars($course['credits']) ?></td>
            <td><?= htmlspecialchars($course['capacity']) ?></td>
            <td>
                <form action="enroll.php" method="POST">
                    <input type="hidden" name="course_id" value="<?= $course['id'] ?>">
                    <button type="submit" class="btn-enroll">Enroll</button>
                </form>
            </td>
        </tr>
    <?php endforeach; ?>

</table>

<div style="text-align:center; margin:15px;">
<form method="GET">
    <input type="text" name="search" placeholder="Search courses..." 
        style="width:300px; padding:7px; border-radius:6px; border:1px solid #60398fb6;">
    <button type="submit" 
        style="padding:8px 14px; border-radius:6px; border:none; background:#60398fb6; color:white;">
    Search
    </button>
</form>
</div>


<div style="text-align:center; margin-top:15px;">
     <button onclick="window.location.href='student.html'">Back</button>
     <br><br>
     <button onclick="window.location.href='index.html'">Logout</button>
</div>

</body>
</html>

