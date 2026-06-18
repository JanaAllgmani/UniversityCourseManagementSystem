<?php
session_start();
require "connect.php";

if (!isset($_SESSION['teacher_id'])) {
    header("Location: login.php");
    exit;
}

$student_id = $_GET['student_id'];
$course_id = $_GET['course_id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $grade = $_POST['grade'];

    $stmt = $conn->prepare("
        UPDATE enrollment
        SET grade = ?
        WHERE student_id = ? AND course_id = ?
    ");
    $stmt->execute([$grade, $student_id, $course_id]);

    $loginSuccess = true;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Add Grade</title>

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

form {
    width: 400px;
    margin: 20px auto;
    background-color: #c8c5cd;
    padding: 20px;
    border-radius: 6px;
    box-shadow: 2px 2px 10px rgba(0,0,0,0.2);
    text-align: left;
}

label {
    font-weight: bold;
    color: #333;
}

input[type="number"] {
    width: 95%;
    padding: 6px;
    margin-top: 5px;
    border-radius: 4px;
    border: 1px solid #60398fb6;
}

button {
    width: 100%;
    padding: 10px;
    background-color: #7a6e8f;
    border: none;
    color: white;
    border-radius: 6px;
    cursor: pointer;
    font-size: 16px;
}

button:hover {
    opacity: 0.9;
}

.success {
    color: green;
    font-weight: bold;
    margin-top: 10px;
}
</style>
</head>
<body>

<h2>Add Grade for Course #<?= htmlspecialchars($course_id) ?></h2>

<form method="POST" action="">
    <label>Grade:</label><br>
    <input type="number" name="grade" step="0.1" required><br><br>
    <button type="submit">Save</button>
</form>

<br><br>
<button onclick="window.history.back()" style="width:400px; padding:10px; background:#60398fb6; border:none; color:white; border-radius:6px; cursor:pointer;">
Back
</button>

<?php if (!empty($loginSuccess)): ?>
<p class="success">Grade saved successfully </p>
<?php endif; ?>

</body>
</html>

