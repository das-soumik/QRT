<?php
include 'config.php';

$enrollment_no = $_POST['enrollment_no'];
$name = $_POST['name'];
$faculty_id = $_POST['faculty_id'];
$session_id = $_POST['session_id'];
$date = date("Y-m-d");

// ✅ Check if record already exists
$check = "SELECT * FROM attendance WHERE enrollment_no = '$enrollment_no' AND session_id = '$session_id' AND date = '$date'";
$result = $conn->query($check);

if ($result->num_rows > 0) {
    echo json_encode([
        "status" => "fail",
        "message" => "Already marked attendance today"
    ]);
} else {
    $insert = "INSERT INTO attendance (enrollment_no, name, faculty_id, session_id, date)
               VALUES ('$enrollment_no', '$name', '$faculty_id', '$session_id', '$date')";

    if ($conn->query($insert)) {
        echo json_encode([
            "status" => "success",
            "message" => "Attendance marked successfully"
        ]);
    } else {
        echo json_encode([
            "status" => "error",
            "message" => "Failed to mark attendance"
        ]);
    }
}
?>
