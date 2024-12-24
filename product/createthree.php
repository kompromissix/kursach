<?php

use objects\Account;

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
include_once '../config/database.php';
include_once '../objects/Clients.php';
$database = new Database();
$db = $database->getConnection();
$product = new Account($db);
$data = json_decode(file_get_contents("php://input"));
//    echo $data->product_name;
////    echo $data->description;
//    echo $data->price;
//    echo $data->category_id;
if(!empty($data->account_id)&&!empty($data->deposit_id)&&!empty($data->clients_id)
    &&!empty($data->account_date_start)&&!empty($data->account_money)) {
    $product->account_id = $data->account_id;
    $product->deposit_id = $data->deposit_id;
    $product->clients_id = $data->clients_id;
    $product->account_date_start = $data->account_date_start;
    $product->account_date_end = $data->account_date_end;
    $product->account_money = $data->account_money;

    if ($product->createthree()) {
        http_response_code(201);
        echo json_encode(array("message" => "Счёт был создан."),
            JSON_UNESCAPED_UNICODE);
    }
    else
    {
        http_response_code(503);
        echo json_encode(array("message" => "Невозможно создать счёт."),
            JSON_UNESCAPED_UNICODE);
    }
}
else
{
    http_response_code(400);
    echo json_encode(array("message" => "Невозможно создать счёт.Данные неполные",JSON_UNESCAPED_UNICODE));
}