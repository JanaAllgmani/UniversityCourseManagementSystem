<?php

function getAllCourses($conn) {
    $sql = "SELECT * FROM courses";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function insertCourse($conn, $code, $title, $credits, $department, $capacity) {
    $sql = "INSERT INTO courses (code, title, credits, department, capacity)
            VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$code, $title, $credits, $department, $capacity]);
}
?>

