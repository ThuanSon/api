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
$c = json_decode(file_get_contents('php://input'));

$dientich = $c->dientich;
$giatri = $c->giatri ?? "";
$giachothue = $c->giachothue ?? "";
$donvi = $c->donvi;
$sophongngu = $c->sophongngu;
$sotang = $c->sotang;
$sophongtam = $c->sophongtam;
$giaytophaply = $c->giaytophaply;
$noithat = $c->noithat;
$province = $c->province;
$district = $c->district;
$ward = $c->ward;
$street = $c->street;
$diachi = $c->diachi;
$diachi = $diachi." ". $street .", ".$ward->WARDS_NAME.", ".$district->DISTRICT_NAME.", ".$province->PROVINCE_NAME;
$longitude = $c->longitude;
$latitude = $c->latitude;
$anh1 = $c->anh1;
$anh2 = $c->anh2;
$anh3 = $c->anh3;
$anh4 = $c->anh4;
$loaibatdongsan = $c->type->id;

// Prepare and execute query to get image ID
$anh_query = "SELECT id FROM danhsachhinhanh WHERE anh1 = '$anh1' AND anh2 = '$anh2' AND anh3 = '$anh3' AND anh4 = '$anh4'";
$id_result = mysqli_query($con, $anh_query);

// Fetch image ID
if ($id_result && mysqli_num_rows($id_result) > 0) {
    $row = mysqli_fetch_assoc($id_result);
    $idhinhanh = $row['id'];
    // Prepare SQL query
    $sql = "INSERT INTO `batdongsan` 
        (`id`, `dientich`, `giatri`,`giachothue`, `donvi`,`diachi`,`latitude`, `longitude`, `sophongngu`, `sophongtam`, `sotang`, `giaytophaply`, `noithat`, `idhinhanh`, `loaibatdongsan`) 
        VALUES (NULL, '$dientich', '$giatri', '$giachothue', '$donvi','$diachi','$latitude','$longitude', '$sophongngu', '$sophongtam', '$sotang', '$giaytophaply', '$noithat', '$idhinhanh', '$loaibatdongsan')";

    // Execute SQL query
    $result = mysqli_query($con, $sql);

    if ($result) {
        $response = array("status" => 1, "message" => 'Real estate records successfully inserted');
    } else {
        $response = array("status" => 0, "message" => 'Failed to insert real estate records');
    }
} else {
    $response = array("status" => 0, "message" => 'Failed to retrieve image ID');
}
echo json_encode($response);
?>
