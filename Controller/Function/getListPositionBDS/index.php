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

    $sql = "SELECT `posts`.id as id, tieude, mota, dientich, giatri, donvi, sophongngu,sotang, 
            giaytophaply, noithat, ngaydang, name, `lienhe`.email as email, sodienthoai, nguoiduoclienhe, 
            anh1, anh2, anh3, anh4, latitude, longitude FROM `posts` 
            INNER JOIN `batdongsan` ON `posts`.`idbatdongsan`=`batdongsan`.`id` 
            INNER JOIN `user` ON `posts`.`idnguoidang` = `user`.`id` 
            INNER JOIN `lienhe` ON `posts`.`idlienhe` = `lienhe`.`id` 
            INNER JOIN `danhsachhinhanh` ON `batdongsan`.idhinhanh = `danhsachhinhanh`.id;";
    $results = mysqli_query($con, $sql);
    $arr = array();
    if (mysqli_num_rows($results)>0) {
        # code...
        while($a=mysqli_fetch_array($results)){
            $arr[] = array(
                "id"=>$a['id'], 
                "tieude"=>$a['tieude'], 
                "mota"=>$a['mota'], 
                "dientich"=>$a['dientich'], 
                "giatri"=>$a['giatri'], 
                "donvi"=>$a['donvi'], 
                "sophongngu"=>$a['sophongngu'], 
                "sotang"=>$a['sotang'], 
                "giaytophaply"=>$a['giaytophaply'], 
                "noithat"=>$a['noithat'], 
                'ngaydang'=>$a['ngaydang'],
                'name'=>$a['name'],
                'email'=>$a['email'],
                'sodienthoai'=>$a['sodienthoai'],
                'nguoiduoclienhe'=>$a['nguoiduoclienhe'],
                'latitude'=>$a['latitude'],
                'longitude'=>$a['longitude'],
            );
        }
        echo json_encode($arr);
        // header("Content-Type: application/json");
    } else {
        # code...
        echo "No record";
    }
    
?>