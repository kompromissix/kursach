<?php

use objects\Clients;

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
include_once '../config/database.php';
include_once '../objects/Clients.php';
$database = new Database();
$db = $database->getConnection();
$product = new Clients($db);
$data = json_decode(file_get_contents("php://input"));
//    echo $data->product_name;
////    echo $data->description;
//    echo $data->price;
//    echo $data->category_id;
if(!empty($data->clients_id)&&!empty($data->clients_name)&&!empty($data->clients_passports)
    &&!empty($data->clients_address)&&!empty($data->clients_telephone)) {
    $product->clients_id = $data->clients_id;
    $product->clients_name = $data->clients_name;
    $product->clients_passports = $data->clients_passports;
    $product->clients_address = $data->clients_address;
    $product->clients_telephone = $data->clients_telephone;

    if ($product->createtwo()) {
        http_response_code(201);
        echo json_encode(array("message" => "Клиент был создан."),
            JSON_UNESCAPED_UNICODE);
    }
    else
    {
        http_response_code(503);
        echo json_encode(array("message" => "Невозможно создать клиента."),
            JSON_UNESCAPED_UNICODE);
    }
}
else
{
    http_response_code(400);
    echo json_encode(array("message" => "Невозможно создать клиента.Данные неполные",JSON_UNESCAPED_UNICODE));
}