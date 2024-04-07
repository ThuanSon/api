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
    $content = json_decode(file_get_contents('php://input'));
    //http://localhost:3006/create/post?type=&province=&district=&ward=&street=
    // &diachi=&tieude=&mota=&dientich=&giatri=&donvi=&file-upload=&tenlienhe=&sodienthoai=&email=


    if ($post === 'POST' && isset($user->email)) {
        $type = $content->type;
        $province = $content->province;
        $district = $content->district;
        $street = $content->street;
        $diachi = $content->diachi;
        $tieude = $content->tieude;
        $mota = $content->mota;
        $dientich = $content->dientich;
        $giatri = $content->giatri;
        $donvi = $content->donvi;
        $file = $content->file;
        $tenlienhe = $content->tenlienhe;
        $email = $content->email;
        // $sql = "SELECT * FROM user WHERE email = '$email' and password = '$pass'";
        // $result = mysqli_query($con, $sql);
        

        if (mysqli_num_rows($result) > 0) {
            while ($a = mysqli_fetch_array($result)) {
                $response = array("status" => 1, "message" => 'Authentication succeed', "username" => $a['email']);
            }
        } else {
            $response = array("status" => 0, "message" => 'Authentication failed');
        }
    
        header('Content-Type: application/json');
        echo json_encode($response);
    } else {
        // Handle invalid request method or missing email parameter
        $response = array("status" => 0, "message" => 'Invalid request');
        // header('Content-Type: application/json');
        echo json_encode($response);
    }

?>