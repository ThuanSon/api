<?php
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Headers: *");
    header("Access-Control-Allow-Methods: *");

    include 'DBconnect.php';
    $obj = new DBconnect();
    $conn = $obj->connect();
    $method = $_SERVER['REQUEST_METHOD'];
    switch ($method) {
        case 'POST':
            $user = json_decode(file_get_contents('php://input'));
            $sql = 'INSERT into user(id, name, email, mobile, create_at) 
                    values(null, :name, :email, :mobile, :create_at)';
            $create_at = date('Y-m-d');
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':name', $user->name);
            $stmt->bindParam(':email', $user->email);
            $stmt->bindParam(':mobile', $user->mobile);
            $stmt->bindParam(':create_at', $create_at);
            if($stmt->execute()){
                $response = ['status' => 1, 'message' => 'Record created successfully.'];
            }else{
                $response = ['status' => 0, 'message' => 'Record created fail.'];
            }
            break;
        case 'GET':
            $sql = 'SELECT email, mobile from user';
            // echo $_SERVER['REQUEST_URI']; exit;
            $path = explode('/', $_SERVER['REQUEST_URI']);
            // print_r($path[3]);
            if(isset($path[3]) && is_numeric($path[3])) {
                $sql .= ' WHERE id = :id';
                $stmt = $conn->prepare($sql);
                $stmt->bindParam(':id', $path[3]);
                $stmt->execute();
                $users = $stmt->fetch(PDO::FETCH_ASSOC);
            }else{
                $stmt = $conn->prepare($sql);
                $stmt->execute();
                $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
            }
            echo json_encode($users);
            break;
        case 'PUT':
            $user = json_decode(file_get_contents('php://input'));
            $sql = 'UPDATE user SET name =:name, email =:email, mobile =:mobile, updated_at =:updated_at WHERE id = :id';
            $updated_at = date('Y-m-d');
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':name', $user->name);
            $stmt->bindParam(':id', $user->id);
            $stmt->bindParam(':email', $user->email);
            $stmt->bindParam(':mobile', $user->mobile);
            $stmt->bindParam(':updated_at', $updated_at);
            if($stmt->execute()){
                $response = ['status' => 1, 'message' => 'Record updated successfully.'];
            }else{
                $response = ['status' => 0, 'message' => 'Record updated fail.'];
            }
            break;
        default:
            # code...
            break;
    }
?>