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
    // $sql = "SELECT `posts`.id as id, idnguoidang,`user`.`email` as emailnguoidang,`user`.`name` as nguoidang,mobile, tieude, mota, dientich, giatri, donvi, sophongngu,sotang, 
    //         giaytophaply, noithat, ngaydang, name, `lienhe`.email as email, sodienthoai, nguoiduoclienhe, 
    //         anh1, anh2, anh3, anh4, latitude, longitude FROM `posts` 
    //         INNER JOIN `batdongsan` ON `posts`.`idbatdongsan`=`batdongsan`.`id` 
    //         INNER JOIN `user` ON `posts`.`idnguoidang` = `user`.`id` 
    //         INNER JOIN `lienhe` ON `posts`.`idlienhe` = `lienhe`.`id` 
    //         INNER JOIN `danhsachhinhanh` ON `batdongsan`.idhinhanh = `danhsachhinhanh`.id
    //         WHERE `posts`.id = $id
    //         ;";
    $sql = "SELECT * FROM `user` where `user`.id = $id";
    $results = mysqli_query($con, $sql);
    $arr = array();
    if (mysqli_num_rows($results)>0) {
        # code...
        while($a=mysqli_fetch_array($results)){
            $arr[] = array(
                "id"=>$a['id'],
                "email"=>$a['email'],
                "mobile"=>$a['mobile'],
                "name"=>$a['name'],
                "password"=>$a['password'],
                "updated_at"=>$a['updated_at'],
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