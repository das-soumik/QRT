<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $enrollment_no = $_POST['enrollment_no'];

    $sql = "SELECT * FROM students WHERE enrollment_no = '$enrollment_no'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        echo json_encode([
            'status' => 'success',
            'name' => $row['name'],
            'stream' => $row['stream'],
            'year' => $row['year']
        ]);
    } else {
        echo json_encode(['status' => 'fail', 'message' => 'Student not found']);
    }
}
?>
