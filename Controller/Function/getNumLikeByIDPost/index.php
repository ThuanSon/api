<?php
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Headers: *");
    header("Access-Control-Allow-Methods: *");
    include_once "../../Service/Config/index.php";
    $param = new conDB();
    $param->connectDB($con);

    $idpost = $_REQUEST['idpost'];
    $sql = "SELECT idpost, count(id) as totallike FROM `tinyeuthich` WHERE idpost = '$idpost' GROUP BY idpost;";
    $results = mysqli_query($con, $sql);
    $arr = array();
    if (mysqli_num_rows($results)>0) {
        # code...
        while($a=mysqli_fetch_array($results)){
            $res = $a['totallike'];
        }
        echo json_encode($res);
    } else {
        echo "No record";
    }
    
?>