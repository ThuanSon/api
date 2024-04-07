<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: *");

include 'DBconnect.php';
$obj = new DBconnect();
$conn = $obj->connect();
$method = $_SERVER['REQUEST_METHOD'];

// switch ($method) {
//     case 'POST':
        $user = json_decode(file_get_contents('php://input'));
        // $email = $user->email;
        $sql = 'SELECT * FROM USER WHERE email = :email';
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':email', $email);
        if ($stmt->execute()) {
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($user) {
                $response = array("status" => 1, "message" => 'Authentication succeed', "username" => $user['email']);
            } else {
                $response = array("status" => 0, "message" => 'Fail to authenticate');
            }
        } else {
            $response = array("status" => 0, "message" => 'Fail to authenticate');
        }
        echo json_encode($response);
    //     break;

    // default:
    //     # code...
    //     break;
// }
?>
