<?php
include 'config.php';

if (isset($_POST['from_date']) && isset($_POST['to_date']) && isset($_POST['session_id'])) {
    $from = $_POST['from_date'];
    $to = $_POST['to_date'];
    $session_id = $_POST['session_id'];

    header("Content-Type: text/csv");
    header("Content-Disposition: attachment; filename=attendance_$from-to-$to.csv");

    $output = fopen("php://output", "w");
    fputcsv($output, array('Name', 'Enrollment No', 'Date'));

    $sql = "SELECT name, enrollment_no, date FROM attendance
            WHERE session_id = '$session_id' AND date BETWEEN '$from' AND '$to'
            ORDER BY date ASC";

    $result = $conn->query($sql);

    while ($row = $result->fetch_assoc()) {
        fputcsv($output, $row);
    }

    fclose($output);
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Download Attendance CSV</title>
    <link rel="stylesheet" href="style.css" />
</head>
<body>
    <h2>Export Attendance</h2>
    <form method="post">
        <label>From Date:</label><br>
        <input type="date" name="from_date" required><br>
        <label>To Date:</label><br>
        <input type="date" name="to_date" required><br>

        <label>Session:</label><br>
        <select name="session_id" required>
            <?php
            // fetch session options
            $sql = "SELECT * FROM sessions";
            $result = $conn->query($sql);
            while ($row = $result->fetch_assoc()) {
                echo "<option value='{$row['id']}'>{$row['session_name']}</option>";
            }
            ?>
        </select><br><br>

        <button type="submit">Download CSV</button>
    </form>
    <a href="dashboard.php">Back to Dashboard</a>
</body>
</html>
