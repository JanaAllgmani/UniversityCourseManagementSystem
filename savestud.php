<?php
require "connect.php";

$name  = $_POST['name'];
$email = $_POST['email'];
$age   = $_POST['age'];
$major = $_POST['major'];

$stmt = $conn->prepare("INSERT INTO students (name, email, age, major) VALUES (?, ?, ?, ?)");
$stmt->execute([$name, $email, $age, $major]);

header("Location: liststud.php");
exit;
?>
