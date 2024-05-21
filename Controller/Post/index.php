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

$mota = $c->mota;
$tieude = $c->tieude;
$donvi = $c->donvi;
$idnguoidang = $c->id;
$dientich = $c->dientich;
$sophongngu = $c->sophongngu;
$sophongtam = $c->sophongtam;
$giaytophaply = $c->giaytophaply;
$noithat = $c->noithat;
$nguoiduoclienhe = $c->nguoiduoclienhe;
$sodienthoai = $c->sodienthoai;
$email = $c->email;
$loaiTin = $c->loaiTin;
$idBDSResult = mysqli_query($con, 
    "SELECT id FROM `batdongsan` WHERE dientich = '$dientich' AND donvi = '$donvi' AND giaytophaply = '$giaytophaply' AND noithat = '$noithat'");
$idLHResult = mysqli_query($con, "SELECT id FROM `lienhe` WHERE nguoiduoclienhe = '$nguoiduoclienhe' AND sodienthoai = '$sodienthoai' AND email = '$email'");

if ($idBDSResult && $idLHResult) {
    $idBDSRow = mysqli_fetch_assoc($idBDSResult);
    $idLHRow = mysqli_fetch_assoc($idLHResult);

    $idBDS = $idBDSRow['id'];
    $idLH = $idLHRow['id'];

    $sql = "INSERT INTO `posts` (`tieude`, `mota`, `loaitin`,`idnguoidang`, `idbatdongsan`, `idlienhe`) 
            VALUES ('$tieude', '$mota', '$loaiTin', '$idnguoidang', '$idBDS', '$idLH')";
    $res = mysqli_query($con, $sql);

    if ($res) {
        $response = array("status" => 1, "message" => "Records successfully inserted!");
    } else {
        // Log the error message
        error_log("Error inserting records into `posts` table: " . mysqli_error($con));
        $response = array("status" => 0, "message" => "Failed to insert records!");
    }
} else {
    // Log the error message
    error_log("Error fetching IDs from `batdongsan` and `lienhe` tables: " . mysqli_error($con));
    $response = array("status" => 0, "message" => "Failed to fetch IDs from database!");
}

// Combine response variables into a single array for JSON encoding
$output = array("idBDS" => $idBDS, "idLH" => $idLH, "response" => $response);

// Encode the response array as JSON and echo it
echo json_encode($output);
echo var_dump($sql);
?>
