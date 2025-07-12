<?php
session_start();
include 'config.php';

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>View Attendance</title>
    <link rel="stylesheet" href="style.css" />
</head>
<body>
    <h2>All Attendance Records</h2>
    <table border="1" cellpadding="8" cellspacing="0">
        <tr>
            <th>Name</th>
            <th>Enrollment No</th>
            <th>Session</th>
            <th>Date</th>
            <th>Marked By</th>
        </tr>
        <?php
        $sql = "SELECT a.name, a.enrollment_no, s.session_name, a.date, f.name AS faculty
                FROM attendance a
                JOIN sessions s ON s.id = a.session_id
                JOIN faculty f ON f.id = a.faculty_id
                ORDER BY a.date DESC";
        $result = $conn->query($sql);
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>{$row['name']}</td>
                    <td>{$row['enrollment_no']}</td>
                    <td>{$row['session_name']}</td>
                    <td>{$row['date']}</td>
                    <td>{$row['faculty']}</td>
                </tr>";
        }
        ?>
    </table>
    <a href="dashboard.php">Back to Dashboard</a>
</body>
</html>
