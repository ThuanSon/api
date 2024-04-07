<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: *");
include_once "../Service/Config/index.php";
$param = new conDB();
$param->connectDB($con);

$post = $_SERVER['REQUEST_METHOD'];
$user = json_decode(file_get_contents('php://input'));

// Check if the request method is POST
if ($post === 'POST' && isset($user->name, $user->email, $user->mobile, $user->password)) {
    // Sanitize user input
    $name = mysqli_real_escape_string($con, $user->name);
    $email = mysqli_real_escape_string($con, $user->email);
    $mobile = mysqli_real_escape_string($con, $user->mobile);
    $password = mysqli_real_escape_string($con, $user->password);
    $create_at = date('Y-m-d');

    // Insert user data using prepared statement
    $stmt = $con->prepare("INSERT INTO user (name, email, mobile, create_at, password) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $name, $email, $mobile, $create_at, $password);
    $result = $stmt->execute();

    if ($result) {
        $response = ['status' => 1, 'message' => 'Record created successfully.'];
    } else {
        $response = ['status' => 0, 'message' => 'Record creation failed.'];
    }
} else {
    // Handle invalid request method or missing parameters
    $response = ['status' => 0, 'message' => 'Invalid request.'];
}

// Return JSON response
header('Content-Type: application/json');
echo json_encode($response);
?>
