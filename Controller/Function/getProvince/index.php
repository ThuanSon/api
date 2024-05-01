<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: *");
// function province(){
    $tinh_thanh = file_get_contents('https://partner.viettelpost.vn/v2/categories/listProvince');
    // $tinh_thanh = json_encode($tinh_thanh);\
    header("Content-Type: application/json");
    echo $tinh_thanh;
// }
?>