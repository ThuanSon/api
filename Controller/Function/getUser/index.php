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
    // $id = $content->id;
    $id = $_REQUEST['idnguoidang'];
    // $sql = "SELECT `posts`.id as id, idnguoidang,`user`.`email` as emailnguoidang,`user`.`name` as nguoidang,mobile, tieude, mota, dientich, giatri, donvi, sophongngu,sotang, 
    //         giaytophaply, noithat, ngaydang, name, `lienhe`.email as email, sodienthoai, nguoiduoclienhe, 
    //         anh1, anh2, anh3, anh4, latitude, longitude FROM `posts` 
    //         INNER JOIN `batdongsan` ON `posts`.`idbatdongsan`=`batdongsan`.`id` 
    //         INNER JOIN `user` ON `posts`.`idnguoidang` = `user`.`id` 
    //         INNER JOIN `lienhe` ON `posts`.`idlienhe` = `lienhe`.`id` 
    //         INNER JOIN `danhsachhinhanh` ON `batdongsan`.idhinhanh = `danhsachhinhanh`.id
    //         WHERE `posts`.id = $id
    //         ;";
    $sql = "
    SELECT user.id as idnguoidang, posts.id as idpost, user.name, user.email, user.mobile,
     user.create_at, posts.tieude, posts.mota, posts.ngaydang,  batdongsan.id as idbatdongsan, 
     batdongsan.dientich, batdongsan.giatri, batdongsan.donvi, batdongsan.sophongngu, batdongsan.sophongtam, 
     batdongsan.sotang, batdongsan.giaytophaply, batdongsan.noithat, batdongsan.diachi, batdongsan.longitude, 
     batdongsan.latitude, batdongsan.idhinhanh, lienhe.id as idlienhe, lienhe.nguoiduoclienhe, lienhe.sodienthoai, 
     lienhe.email, danhsachhinhanh.id as idhinhanh, danhsachhinhanh.anh1, danhsachhinhanh.anh2, danhsachhinhanh.anh3, 
     danhsachhinhanh.anh4 from user JOIN posts ON user.id = posts.idnguoidang JOIN batdongsan
     ON batdongsan.id = posts.idbatdongsan JOIN lienhe ON lienhe.id = posts.idlienhe 
    JOIN danhsachhinhanh on danhsachhinhanh.id = batdongsan.idhinhanh WHERE user.id = $id
    ";
    $results = mysqli_query($con, $sql);
    $arr = array();
    if (mysqli_num_rows($results)>0) {
        # code...
        while($a=mysqli_fetch_array($results)){
            $arr[] = array(
                "idnguoidang"=>$a['idnguoidang'], 
                "idpost"=>$a['idpost'], 
                "name"=>$a['name'], 
                "email"=>$a['email'], 
                "tieude"=>$a['tieude'], 
                "mota"=>$a['mota'], 
                "dientich"=>$a['dientich'], 
                "giatri"=>$a['giatri'], 
                "donvi"=>$a['donvi'], 
                "sophongngu"=>$a['sophongngu'],
                "sotang"=>$a['sotang'], 
                "giaytophaply"=>$a['giaytophaply'], 
                "noithat"=>$a['noithat'], 
                "ngaydang"=>$a['ngaydang'], 
                "name"=>$a['name'], 
                "email"=>$a['email'], 
                "sodienthoai"=>$a['sodienthoai'], 
                "nguoiduoclienhe"=>$a['nguoiduoclienhe'], 
                // 'idhinhanh'=>$a['idhinhanh'],
                'anh1'=>$a['anh1'],
                'anh2'=>$a['anh2'],
                'anh3'=>$a['anh3'],
                'anh4'=>$a['anh4'],
                'latitude'=>$a['latitude'],
                'longitude'=>$a['longitude'],
            );
            // $arr[] = $a;
        }
        echo json_encode($arr);
        // header("Content-Type: application/json");
    } else {
        # code...
        echo "No record";
    }
    
?>