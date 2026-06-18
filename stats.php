<?php
require "connect.php";

$studentsCount = $conn->query("SELECT COUNT(*) FROM students")->fetchColumn();

$coursesCount = $conn->query("SELECT COUNT(*) FROM courses")->fetchColumn();

$instructorsCount = $conn->query("SELECT COUNT(*) FROM instructors")->fetchColumn();

$enrollCount = $conn->query("SELECT COUNT(*) FROM enrollment")->fetchColumn();



?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Statistics Dashboard</title>

<style>
body {
    background: #f6f6f6;
    font-family: Arial, sans-serif;
    padding: 20px;
    text-align: center;
}

h2 {
    background: #ffffff;
    color: #60398f;
    display: inline-block;
    padding: 12px 26px;
    border-radius: 8px;
    font-weight: bold;
    box-shadow: 2px 2px 8px rgba(0,0,0,0.3);
    margin-bottom: 20px;
}

.grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 20px;
    width: 90%;
    margin: auto;
}

.box {
    background: #ffffff;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 2px 2px 8px rgba(0,0,0,0.2);
}

.value {
    font-size: 32px;
    font-weight: bold;
    color: #60398f;
}

.label {
    font-size: 16px;
    color: #555;
    margin-top: 6px;
}

button {
    width: 400px;
    padding: 10px 16px;
    font-size: 16px;
    background: #60398f;
    border: none;
    color: white;
    border-radius: 6px;
    cursor: pointer;
    margin-top: 30px;
    box-shadow: 2px 2px 8px rgba(0,0,0,0.3);
}

button:hover {
    opacity: 0.9;
}
</style>

</head>
<body>

<h2>Statistics Dashboard</h2>

<div class="grid">

    <div class="box">
        <div class="value"><?= $studentsCount ?></div>
        <div class="label">Total Students</div>
    </div>

    <div class="box">
        <div class="value"><?= $coursesCount ?></div>
        <div class="label">Total Courses</div>
    </div>

    <div class="box">
        <div class="value"><?= $instructorsCount ?></div>
        <div class="label">Total Instructors</div>
    </div>

    <div class="box">
        <div class="value"><?= $enrollCount ?></div>
        <div class="label">Total Enrollments</div>
    </div>



</div>

<button onclick="window.location.href='teacher_dashboard.html'">Back</button>

</body>
</html>
