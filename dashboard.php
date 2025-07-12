<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="style.css" />
</head>
<body>
    <h2>Welcome Super Admin</h2>
    <ul>
        <li><a href="add_faculty.php">Add Faculty</a></li>
        <li><a href="add_student.php">Add Student</a></li>
        <li><a href="add_session.php">Add Session</a></li>
        <li><a href="view_attendance.php">View Attendance</a></li>
        <li><a href="export_csv.php">Download Attendance</a></li>
        <li><a href="logout.php">Logout</a></li>
    </ul>
</body>
</html>

