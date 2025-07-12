<?php
session_start();
include 'config.php';

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

if (isset($_POST['submit'])) {
    $session_name = $_POST['session_name'];

    $check = "SELECT * FROM sessions WHERE session_name = '$session_name'";
    $res = $conn->query($check);

    if ($res->num_rows > 0) {
        $msg = "Session already exists!";
    } else {
        $sql = "INSERT INTO sessions (session_name) VALUES ('$session_name')";
        $conn->query($sql);
        $msg = "Session added!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Session</title>
    <link rel="stylesheet" href="style.css" />
</head>
<body>
    <h2>Add Session</h2>
    <?php if (isset($msg)) echo "<p>$msg</p>"; ?>
    <form method="post">
        <input type="text" name="session_name" placeholder="Session Name (e.g., Lunch)" required><br>
        <button type="submit" name="submit">Add Session</button>
    </form>
    <a href="dashboard.php">Back to Dashboard</a>
</body>
</html>
