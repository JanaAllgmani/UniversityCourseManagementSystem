<?php
session_start();
require "connect.php";

if (!isset($_SESSION['teacher_id'])) {
    header("Location: login.php");
    exit;
}

$stmt = $conn->prepare("SELECT * FROM courses");
$stmt->execute();
$courses = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Course Management</title>

    <style>
    body {
        font-family: Arial;
        background-color: #f0f0f0;
        padding: 20px;
        margin: 0;
        text-align: center;
    }
    header, h2 {
        text-align: center;
        margin-bottom: 10px;
    }
    h2 {
        color: #282727ff;
        background: rgba(67,37,29,0.0);
        padding: 10px 24px;
        border-radius: 8px;
        display: inline-block;
        width:auto;
        margin: 0 auto;
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
    td a {
        color: #43251d;
        font-weight: bold;
        text-decoration: none;
    }
    td a:hover {
        text-decoration: underline;
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
    }
    button:hover {
        opacity: 0.9;
    }
    </style>
</head>
<body>

<header>
    <h2>University Course Management System</h2>
</header>

<h2>Your Courses</h2>

<table border="1">
    <tr>
        <th>Course ID</th>
        <th>Course Code</th>
        <th>Course Title</th>
        <th>Department</th>
        <th>Credits</th>
        <th>Capacity</th>
        <th>Action</th>
    </tr>

    <?php foreach ($courses as $c): ?>
        <tr>
            <td><?= htmlspecialchars($c['id']) ?></td>
            <td><?= htmlspecialchars($c['code']) ?></td>
            <td><?= htmlspecialchars($c['title']) ?></td>
            <td><?= htmlspecialchars($c['department']) ?></td>
            <td><?= htmlspecialchars($c['credits']) ?></td>
            <td><?= htmlspecialchars($c['capacity']) ?></td>
            <td>
                <a href="students.php?course_id=<?= $c['id'] ?>">View Students</a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>


<div style="text-align:center; margin-top:10px;">
    <button type="button" onclick="window.location.href='teacher_Dashboard.html'">Back</button>
    <br><br>
    <button type="button" onclick="window.location.href='index.html'">Logout</button>
</div>

</body>
</html>
