<?php
use objects\Account;
header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: PUT");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    include_once '../config/database.php';
    include_once '../objects/Account.php';
    $database = new Database();
    $db = $database->getConnection();
    $product = new Account($db);
    $data = json_decode(file_get_contents("php://input"));
    $product->account_id = $data->account_id;
    $product->deposit_id = $data->deposit_id;
    $product->clients_id = $data->clients_id;
    $product->account_date_start = $data->account_date_start;
    $product->account_date_end = $data->account_date_end;
    $product->account_money = $data->account_money;
    if($product->update()){
        http_response_code(200);
        echo json_encode(array("message" => "Счёт обновлен."),
            JSON_UNESCAPED_UNICODE);
    }
    else
    {
        http_response_code(583);
        echo json_encode(array("message" => "Невозможно обновить счёт."),
            JSON_UNESCAPED_UNICODE);
    }