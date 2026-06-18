<?php
require "connect.php";

$stmt = $conn->query("SELECT * FROM students");
$students = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Student list</title>
        <style>
        body {
            font-family: Arial;
            background-color: #f0f0f0;
            padding: 20px;
        }
        h2 {
            text-align: center;
            color: #333;
        }
        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
            background-color: #a5a5a5b1;
        }
        th, td {
            border: 1px solid #a5a5a5b1;
            padding: 8px;
            text-align: center;
        }
        th {
            background-color: #60398fb6;
            color: white;
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
           margin-top: 15px;
           box-shadow: 2px 2px 8px rgba(0,0,0,0.3);
        }
        
        button:hover {
          opacity: 0.9;
        }



    </style>
</head>
<body>

<h2>Student list</h2>

<table>
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Email</th>
        <th>Age</th>
        <th>Major</th>
    </tr>

    <?php foreach($students as $stud): ?>
    <tr>
        <td><?= $stud['id'] ?></td>
        <td><?= $stud['name'] ?></td>
        <td><?= $stud['email'] ?></td>
        <td><?= $stud['age'] ?></td>
        <td><?= $stud['major'] ?></td>
    </tr>
    <?php endforeach; ?>

</table>

    <div style="text-align:center; margin-top:10px;">
    <button type="button" onclick="window.location.href='teacher_Dashboard.html'">Back</button>
    </div>

</body>
</html>
