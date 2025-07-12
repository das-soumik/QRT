<?php
include 'config.php';

$email = $_POST['email'];
$password = $_POST['password'];

$response = array();

$sql = "SELECT * FROM faculty WHERE email = '$email' AND password = '$password'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $faculty = $result->fetch_assoc();
    $response['status'] = 'success';
    $response['faculty_id'] = $faculty['id'];
    $response['name'] = $faculty['name'];
} else {
    $response['status'] = 'fail';
    $response['message'] = 'Invalid credentials';
}

echo json_encode($response);
?>
