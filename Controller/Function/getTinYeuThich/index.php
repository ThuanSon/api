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
    $id = $_REQUEST['id'];
    $sql = "SELECT tinyeuthich.id as id, posts.id as idpost, tieude , mota , ngaydang , loaitin , 
    idnguoidang , idbatdongsan, idlienhe , iduser , idpost , name , 
    email , mobile , updated_at, password , dientich, giatri , giachothue , 
    donvi, sophongngu , sophongtam , sotang , giaytophaply , noithat , diachi , 
    longitude , latitude , idhinhanh , loaibatdongsan, anh1, anh2, anh3, anh4 
    from posts JOIN tinyeuthich ON posts.id = tinyeuthich.idpost JOIN user 
    ON tinyeuthich.iduser = user.id JOIN batdongsan ON posts.idbatdongsan = batdongsan.id join danhsachhinhanh 
    on batdongsan.idhinhanh = danhsachhinhanh.id WHERE user.id = $id;";
    $results = mysqli_query($con, $sql);
    $arr = array();
    if (mysqli_num_rows($results)>0) {
        # code...
        while($a=mysqli_fetch_array($results)){
            $arr[] = array(
                "id"=>$a['id'], 
                "idpost"=>$a['idpost'], 
                "idnguoidang"=>$a['idnguoidang'], 
                // "emailnguoidang"=>$a['emailnguoidang'], 
                // "nguoidang"=>$a['nguoidang'], 
                "mobile"=>$a['mobile'], 
                "tieude"=>$a['tieude'], 
                "mota"=>$a['mota'], 
                "dientich"=>$a['dientich'], 
                "giatri"=>$a['giatri'], 
                "giachothue"=>$a['giachothue'], 
                "donvi"=>$a['donvi'], 
                "sophongngu"=>$a['sophongngu'],
                "sotang"=>$a['sotang'], 
                "giaytophaply"=>$a['giaytophaply'], 
                "noithat"=>$a['noithat'], 
                "ngaydang"=>$a['ngaydang'], 
                "name"=>$a['name'], 
                "email"=>$a['email'], 
                // "sodienthoai"=>$a['sodienthoai'], 
                // "nguoiduoclienhe"=>$a['nguoiduoclienhe'], 
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