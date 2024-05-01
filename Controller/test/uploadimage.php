<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: *");
include_once "../Service/Config/index.php";
$param = new conDB();
$param->connectDB($con);
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $uploadDirectory = "img/"; // Directory to upload files

    if (!file_exists($uploadDirectory)) {
        mkdir($uploadDirectory, 0777, true);
    }

    if (isset($_FILES['image']) && !empty($_FILES['image']['name'])) {
        $files = $_FILES['image'];
        // Loop through all the uploaded files
        $anh = array();
        foreach ($files['tmp_name'] as $index => $tmp_name) {
            $fileName = basename($files['name'][$index]);
            $anh[] = $fileName;
            $uploadPath = $uploadDirectory . $fileName;
            // Move the uploaded file to the destination directory
            if (move_uploaded_file($tmp_name, $uploadPath)) {
                // File uploaded successfully
                echo "File uploaded: $uploadPath\n";
            } else {
                // Error occurred while uploading the file
                echo "Failed to upload file: $fileName\n";
            }
        }
        $sql = "INSERT INTO `danhsachhinhanh` (`id`, `anh1`, `anh2`, `anh3`, `anh4`) VALUES (NULL, '$anh[0]', '$anh[1]', '$anh[2]', '$anh[3]')";
        $res = mysqli_query($con, $sql);
        // echo $res;
        $response = array("status" => 1, "message" => 'upload successfully', "results"=>$res);

    } else {
        // No files uploaded
        // echo "No files uploaded.\n";
        $response = array("status" => 0, "message" => 'No files uploaded.\n', "results"=>0);

    }
} else {
    // Invalid request method
    // echo "Invalid request method.\n";
    $response = array("status" => 1, "message" => 'Invalid request method.\n', "results"=>0);

}
echo json_encode($res);
?>
