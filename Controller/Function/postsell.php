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
        $sodienthoai = $content->sodienthoai;
        $email = $content->email;
        $sqlLienHe = "INSERT INTO lienhe(nguoiduoclienhe, sodienthoai, email) VALUES('$tenlienhe', '$sodienthoai', '$email')"
        $resLienHe = mysqli_query($con,$sqlLienHe);

        move_uploaded_file($_FILES["image"]["tmp_name"], "img/" . $_FILES["image"]["name"]);
        $f = $_FILES["image"]["name"];
        $sqlanh = "INSERT INTO `danhsachhinhanh` (`id`, `anh1`, `anh2`, `anh3`, `anh4`) VALUES (NULL, '$f', '$f', '$f', '$f')";
        $resanh = mysqli_query($con, $sqlanh);
        $slqbds = "INSERT INTO `batdongsan` (`id`, `dientich`, `giatri`, `donvi`, `idhinhanh`) 
        VALUES (NULL, '$dientich', '$giatri', '$donvi', ''select id from danhsachhinhanh where anh1 = $f'')"
        $resbatdongsan = mysqli_query($con, $slqbds);
        $sqlpost = "INSERT INTO `posts` (`id`, `tieude`, `mota`, `idnguoidang`, `idbatdongsan`, `idlienhe`) 
        VALUES (NULL, '$tieude', '$mota', ''select id from user where email = '$content->usermail''', ''select id from batdongsan where idhinhanh' = ('select id from danhsachhinhanh where anh1 = $f')', ''select id from lienhe where nguoiduoclienhe = '$tenlienhe''')";
        $respost = mysqli_query($con, $sqlpost);
        if ($resLienHe && $resanh && $resbatdongsan && $respost) {
                $response = array("status" => 1, "message" => 'Post succeed');
            } else {
                $response = array("status" => 0, "message" => 'Post failed');
            }
        header('Content-Type: application/json');
        echo json_encode($response);
    } else {
        $response = array("status" => 0, "message" => 'Invalid request');
        header('Content-Type: application/json');
        echo json_encode($response);
    }
 // $filePaths = [];
        // if (!empty($_FILES['file']['name'])) {
        //     $fileNames = $_FILES['file']['name'];
        //     $fileTmpNames = $_FILES['file']['tmp_name'];
        //     $fileError = $_FILES['file']['error'];
        //     $fileSize = $_FILES['file']['size'];
    
        //     foreach ($fileTmpNames as $key => $tmpName) {
        //         $fileName = $fileNames[$key];
        //         $filePath = 'uploads/' . $fileName; // Adjust the path as needed
        //         move_uploaded_file($tmpName, $filePath);
        //         $filePaths[] = $filePath;
        //     }
        // }
    
        // if (mysqli_num_rows($result) > 0) {
        //     while ($a = mysqli_fetch_array($result)) {
        //         $response = array("status" => 1, "message" => 'Authentication succeed', "username" => $a['email']);
        //     }
        // } else {
        //     $response = array("status" => 0, "message" => 'Authentication failed');
        // }
?>
