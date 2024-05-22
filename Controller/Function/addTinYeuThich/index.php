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
    $iduser = $_REQUEST['iduser'];
    // Prepare SQL query
    $sql = "INSERT INTO `tinyeuthich` (`id`, `iduser`, `idpost`, `create_at`) VALUES (NULL, '$iduser', '$idpost', current_timestamp())";
    // Execute SQL query
    $result = mysqli_query($con, $sql);
    if ($result) {
        $response = array("status" => 1, "message" => 'Real estate records successfully inserted');
    } else {
        $response = array("status" => 0, "message" => 'Failed to insert real estate records');
    }
echo json_encode($response);
?>
