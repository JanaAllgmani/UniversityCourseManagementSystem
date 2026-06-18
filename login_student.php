<?php
session_start();
require "connect.php";

$email = $_POST['email'] ?? null;
$password = $_POST['password'] ?? null;

$stmt = $conn->prepare("SELECT * FROM students WHERE email = ? LIMIT 1");
$stmt->execute([$email]);
$student = $stmt->fetch(PDO::FETCH_ASSOC);

if ($student && $password === $student['password']) {
    $_SESSION['student_id'] = $student['id'];
    header("Location: student.html");
    exit;
} else {
    echo "<p style='color:red; font-weight:bold'>Invalid login</p>";
}
?>

