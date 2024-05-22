<?php
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Headers: *");
    header("Access-Control-Allow-Methods: *");
    include_once "../../Service/Config/index.php";
    $param = new conDB();
    $param->connectDB($con);

    $iduser = $_REQUEST['iduser'];
    $sql = "SELECT idpost FROM `tinyeuthich`
            WHERE `tinyeuthich`.iduser = '$iduser'
            ";
    $results = mysqli_query($con, $sql);
    $arr = array();
    if (mysqli_num_rows($results)>0) {
        # code...
        while($a=mysqli_fetch_array($results)){
            $arr[] = array(
                "idpost"=>$a['idpost'], 
            );
        }
        echo json_encode($arr);
    } else {
        echo "No record";
    }
    
?>