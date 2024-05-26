<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: *");

include_once "../../Service/Config/index.php";
$param = new conDB();
$param->connectDB($con);
    $idpost = $_REQUEST['idpost'];
    // $iduser = $_REQUEST['iduser'];
    // Prepare SQL query
    $sql = "DELETE FROM `posts` WHERE `posts`.`id` = '$idpost';";
    // Execute SQL query
    $result = mysqli_query($con, $sql);
    if ($result) {
        $response = array("status" => 1, "message" => 'Delete successfully');
    } else {
        $response = array("status" => 0, "message" => 'Failed to delete');
    }
echo json_encode($response);
?>
