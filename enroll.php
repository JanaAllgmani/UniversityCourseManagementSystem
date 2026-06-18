<?php
session_start();
require "connect.php";

$studentId = $_SESSION['student_id'] ?? 1;

$courseId = $_POST['course_id'] ?? null;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $courseId && $studentId) {
    $stmt = $conn->prepare("INSERT INTO enrollment (student_id, course_id) VALUES (?, ?)");
    $stmt->execute([$studentId, $courseId]);
    header("Location: listcourses.php?msg=ok");
    exit;
}
?>
