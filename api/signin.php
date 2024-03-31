<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    http_response_code(200);
    exit;
}
require_once '../config/dbconfig.php';

//  POST data
$data = json_decode(file_get_contents("php://input"));
if (!empty($data->email) && !empty($data->password)) {
    $database = new Database();
    $conn = $database->getConnection();
    $query = "SELECT * FROM user WHERE email = :email AND password = :password";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':email', $data->email);
    $stmt->bindParam(':password', $data->password);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        http_response_code(200);
        echo json_encode(array("message" => "Login successful."));
    } else {
        http_response_code(401);
        echo json_encode(array("message" => "Login failed. Incorrect email or password."));
    }
} else {
    http_response_code(400);
    echo json_encode(array("message" => "Incomplete data."));
}
?>
