<?php
use objects\Deposit;
header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: PUT");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    include_once '../config/database.php';
    include_once '../objects/Deposit.php';
    $database = new Database();
    $db = $database->getConnection();
    $product = new Deposit($db);
    $data = json_decode(file_get_contents("php://input"));
    $product->deposit_id = $data->deposit_id;
    $product->deposit_name = $data->deposit_name;
    $product->deposit_time_months = $data->deposit_time_months;
    $product->deposit_bid = $data->deposit_bid;
    if($product->updatethree()){
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