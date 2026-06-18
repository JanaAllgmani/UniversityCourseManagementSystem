<?php
class GradeDAO {

    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function addOrUpdateGrade($student_id, $course_id, $grade) {
        $stmt = $this->conn->prepare("
            INSERT INTO grades (student_id, course_id, grade)
            VALUES (?, ?, ?)
        ");
        return $stmt->execute([$student_id, $course_id, $grade]);
    }

    public function getGradesByCourse($course_id) {
        $stmt = $this->conn->prepare("SELECT student_id, course_id, grade FROM grades WHERE course_id = ?");
        $stmt->execute([$course_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
