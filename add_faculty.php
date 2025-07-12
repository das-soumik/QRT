<?php
session_start();
include 'config.php';

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

$msg = '';

if (isset($_POST['submit'])) {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    if ($name === '' || $email === '' || $password === '') {
        $msg = "Please fill in all fields.";
    } else {
        $check = "SELECT * FROM faculty WHERE email = '$email'";
        $res = $conn->query($check);

        if ($res->num_rows > 0) {
            $msg = "Faculty with this email already exists.";
        } else {
            $sql = "INSERT INTO faculty (name, email, password) VALUES ('$name', '$email', '$password')";
            if ($conn->query($sql)) {
                $msg = "✅ Faculty added successfully!";
            } else {
                $msg = "❌ SQL Error: " . $conn->error;
            }
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Faculty</title>
    <link rel="stylesheet" href="style.css" />
</head>
<body>
    <h2>Add Faculty</h2>
    <?php if ($msg) echo "<p style='color:blue;'>$msg</p>"; ?>
    <form method="post">
        <input type="text" name="name" placeholder="Name" required><br>
        <input type="email" name="email" placeholder="Email" required><br>
        <input type="text" name="password" placeholder="Password" required><br>
        <button type="submit" name="submit">Add Faculty</button>
    </form>
    <a href="dashboard.php">← Back to Dashboard</a>
</body>
</html>
