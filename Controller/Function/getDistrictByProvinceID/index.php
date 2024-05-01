<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: *");

// Retrieve province ID from request parameters
if(isset($_GET['provinceId'])) {
    $provinceId = $_GET['provinceId'];
    
    // Fetch district data based on province ID
    $tinh_thanh = file_get_contents("https://partner.viettelpost.vn/v2/categories/listDistrict?provinceId=$provinceId");

    // Set the response content type to JSON
    header("Content-Type: application/json");

    // Output the district data
    echo $tinh_thanh;
} else {
    // Handle the case when province ID is not provided
    echo json_encode(array("error" => "Province ID is not provided"));
}
?>

