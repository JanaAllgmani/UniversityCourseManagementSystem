<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    session_start();
    require "connect.php";

    $email = $_POST['username'] ?? null;
    $password = $_POST['password'] ?? null;

    $stmt = $conn->prepare("SELECT * FROM instructors WHERE email = ? LIMIT 1");
    $stmt->execute([$email]);
    $teacher = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($teacher && $password == $teacher['password']) {
        $_SESSION['teacher_id'] = $teacher['id'];
        header("Location: teacher_Dashboard.html");
        exit;
    } else {
        $loginError = true;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Teacher Login</title>
<style>
body {
    font-family: Arial;
    background-color: #f0f0f0;
    padding: 20px;
    margin: 0;
    text-align: center;
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

form {
    width: 400px;
    margin: 20px auto;
    background-color: #a5a5a5b1;
    padding: 20px;
    border-radius: 6px;
    box-shadow: 2px 2px 10px rgba(0,0,0,0.2);
}

label {
    font-weight: bold;
}

input[type="text"], input[type="password"] {
    width: 95%;
    padding: 6px;
    margin-top: 5px;
    border-radius: 4px;
    border: none;
}

button {
    margin-top: 14px;
    width: 80%;
    padding: 8px;
    background-color: #60398fb6;
    border: none;
    color: white;
    cursor: pointer;
    border-radius: 6px;
}

button:hover {
    opacity: 0.9;
}

.error {
    color: red;
    margin-top: 10px;
    font-weight: bold;
}
</style>
</head>
<body>

<h2>Teacher Login</h2>

<form action="login.php" method="POST">
    <label>Username (Email):</label><br>
    <input type="text" name="username" required><br><br>

    <label>Password:</label><br>
    <input type="password" name="password" required><br><br>

    <button type="submit">Login</button>
</form>

<?php if (!empty($loginError)): ?>
    <p class="error">Invalid login</p>
<?php endif; ?>

<button style="width: 75%; max-width:400px;" onclick="window.location.href='index.html'">Back</button>

</body>
</html>
