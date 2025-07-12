<?php
session_start();
include 'config.php';

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $enrollment_no = $_POST['enrollment_no'];

    $check = "SELECT * FROM students WHERE enrollment_no = '$enrollment_no'";
    $res = $conn->query($check);

    if ($res->num_rows > 0) {
        $msg = "Enrollment already exists!";
    } else {
        $sql = "INSERT INTO students (name, enrollment_no) VALUES ('$name', '$enrollment_no')";
        $conn->query($sql);
        $msg = "Student added successfully!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Student</title>
    <link rel="stylesheet" href="style.css" />
</head>
<body>
    <h2>Add Student</h2>
    <?php if (isset($msg)) echo "<p>$msg</p>"; ?>
    <form method="post">
        <input type="text" name="name" placeholder="Student Name" required><br>
        <input type="text" name="enrollment_no" placeholder="Enrollment No" required><br>
        <button type="submit" name="submit">Add Student</button>
    </form>
    <a href="dashboard.php">Back to Dashboard</a>
</body>
</html>
