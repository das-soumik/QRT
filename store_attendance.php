<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include 'config.php';

$enrollment_no = $_POST['enrollment_no'] ?? '';
$name = $_POST['name'] ?? '';
$faculty_id = $_POST['faculty_id'] ?? '';
$session_id = $_POST['session_id'] ?? '';
$date = date("Y-m-d");

// ❗ Check for missing input
if (!$enrollment_no || !$name || !$faculty_id || !$session_id) {
    echo json_encode([
        "status" => "error",
        "message" => "Missing required parameters"
    ]);
    exit;
}

// ✅ Check if already marked
$check_sql = "SELECT * FROM attendance WHERE enrollment_no = ? AND session_id = ? AND date = ?";
$check_stmt = $conn->prepare($check_sql);
$check_stmt->bind_param("sis", $enrollment_no, $session_id, $date);
$check_stmt->execute();
$result = $check_stmt->get_result();

if ($result->num_rows > 0) {
    echo json_encode([
        "status" => "fail",
        "message" => "Already marked attendance today"
    ]);
} else {
    $insert_sql = "INSERT INTO attendance (enrollment_no, name, faculty_id, session_id, date)
                   VALUES (?, ?, ?, ?, ?)";
    $insert_stmt = $conn->prepare($insert_sql);
    $insert_stmt->bind_param("ssiss", $enrollment_no, $name, $faculty_id, $session_id, $date);

    if ($insert_stmt->execute()) {
        echo json_encode([
            "status" => "success",
            "message" => "Attendance marked successfully"
        ]);
    } else {
        echo json_encode([
            "status" => "error",
            "message" => "Failed to mark attendance: " . $conn->error
        ]);
    }
}
?>
