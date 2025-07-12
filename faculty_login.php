<?php
header("Content-Type: application/json");

// DB connection
$conn = new mysqli(getenv("HOST"), getenv("USER"), getenv("DB_PASSWORD"), "getenv("DB_PORT")");

if ($conn->connect_error) {
    echo json_encode(["status" => "fail", "message" => "Database connection failed"]);
    exit();
}

// Get POST data
$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';

if (empty($email) || empty($password)) {
    echo json_encode(["status" => "fail", "message" => "Missing email or password"]);
    exit();
}

// Check credentials
$sql = "SELECT id, name FROM faculty WHERE email = ? AND password = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $email, $password);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    echo json_encode([
        "status" => "success",
        "faculty_id" => $row['id'],
        "name" => $row['name']
    ]);
} else {
    echo json_encode(["status" => "fail", "message" => "Invalid credentials"]);
}

$conn->close();
?>
