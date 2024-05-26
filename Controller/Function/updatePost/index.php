<?php
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Headers: *");
    header("Access-Control-Allow-Methods: *");
    include_once "../../Service/Config/index.php";
    $param = new conDB();
    $param->connectDB($con);

    // mysqli_query($con, "set names utf8");
    $post = $_SERVER['REQUEST_METHOD'];
    $content = json_decode(file_get_contents('php://input'));
    // $userid = $_REQUEST['userid'];
    $id = $content->id;
    $idbds = $content->idbds;
    $dientich = $content->dientich;
    $donvi = $content->donvi;
    $email = $content->email;
    $giatri = $content->giatri;
    $giaytophaply = $content->giaytophaply;
    $mota = $content->mota;
    $tieude = $content->tieude;
    $sodienthoai = $content->sodienthoai;
    $sophongngu = $content->sophongngu;
    $sotang = $content->sotang;
    $nguoiduoclienhe = $content->nguoiduoclienhe;
    $idlienhe = $content->idlienhe;
    $name = $content->name;

    $sql = "UPDATE `posts` SET `tieude` = '$tieude', `mota` = '$mota'       
    WHERE `posts`.`id` = '$id';";
    // var_dump($sql);
    $results = mysqli_query($con, $sql);
    $sql1 = "UPDATE `batdongsan` SET `dientich` = '$dientich',
    `giatri` = '$giatri', `donvi` = '$donvi', `sophongngu` = '$sophongngu',
    `sotang` = '$sotang'
     WHERE `batdongsan`.`id` = '$idbds'";
    // $arr = array();
    $results1 = mysqli_query($con, $sql1);
    $sql2 = "UPDATE `lienhe` SET `email` = '$email', `nguoiduoclienhe` = '$nguoiduoclienhe', `sodienthoai` = '$sodienthoai' WHERE `lienhe`.`id` = $idlienhe";
    // $arr = array();
    var_dump($sql2);
    $results2 = mysqli_query($con, $sql2);
    if ($results && $results1 && $results2) {
        echo "Chỉnh sửa thành công";
    } else {
        # code...
        echo "Chỉnh sửa thất bại";
    }
//     string(130) "UPDATE `lienhe` SET `email` = 'sonminh.ecorp@gmail.com', `name` = 'Thuan', `sodienthoai` = '9421541444' WHERE `lienhe`.`id` = '77'"
// Chỉnh sửa thất bại

    
    
?>