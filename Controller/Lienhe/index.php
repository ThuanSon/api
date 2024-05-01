<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: POST");

include_once "../Service/Config/index.php";
$param = new conDB();
$param->connectDB($con);

$post = $_SERVER['REQUEST_METHOD'];
$c = json_decode(file_get_contents('php://input'));

// Extracting data from the JSON payload
$lienhe = $c->tenlienhe;
$sodienthoai = $c->sodienthoai;
$email = $c->email;

// Constructing SQL query
$sql = "INSERT INTO `lienhe` (`id`, `nguoiduoclienhe`, `sodienthoai`, `email`) VALUES (NULL, '$lienhe', '$sodienthoai', '$email');";

// Execute SQL query
$result = mysqli_query($con, $sql);

// Check if the insertion was successful
if ($result) {
    $response = ['status' => 1, 'message' => 'Record created successfully.'];
} else {
    $error_message = mysqli_error($con);
    $response = ['status' => 0, 'message' => 'Record creation failed. Error: ' . $error_message];
}

// Return JSON response
header('Content-Type: application/json');
echo json_encode($response);
?>
