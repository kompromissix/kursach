<?php
use objects\Clients;
header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: PUT");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    include_once '../config/database.php';
    include_once '../objects/Clients.php';
    $database = new Database();
    $db = $database->getConnection();
    $product = new Clients($db);
    $data = json_decode(file_get_contents("php://input"));
    $product->clients_id = $data->clients_id;
    $product->clients_name = $data->clients_name;
    $product->clients_passports = $data->clients_passports;
    $product->clients_address = $data->clients_address;
    $product->clients_telephone = $data->clients_telephone;
    if($product->updatetwo()){
        http_response_code(200);
        echo json_encode(array("message" => "Товар обновлен."),
            JSON_UNESCAPED_UNICODE);
    }
    else
    {
        http_response_code(583);
        echo json_encode(array("message" => "Невозможно обновить товар."),
            JSON_UNESCAPED_UNICODE);
    }