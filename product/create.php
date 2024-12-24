<?php

use objects\Deposit;

    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    include_once '../config/database.php';
    include_once '../objects/Deposit.php';
    $database = new Database();
    $db = $database->getConnection();
    $product = new Deposit($db);
    $data = json_decode(file_get_contents("php://input"));
//    echo $data->product_name;
////    echo $data->description;
//    echo $data->price;
//    echo $data->category_id;
    if(!empty($data->deposit_id)&&!empty($data->deposit_name)
        &&!empty($data->deposit_time_months)&&!empty($data->deposit_bid)) {
        $product->deposit_id = $data->deposit_id;
        $product->deposit_name = $data->deposit_name;
        $product->deposit_time_months = $data->deposit_time_months;
        $product->deposit_bid = $data->deposit_bid;

        if ($product->create()) {
            http_response_code(201);
            echo json_encode(array("message" => "Депозит был создан."),
                JSON_UNESCAPED_UNICODE);
        }
        else
        {
            http_response_code(503);
            echo json_encode(array("message" => "Невозможно создать депозит."),
            JSON_UNESCAPED_UNICODE);
        }
    }
    else
    {
        http_response_code(400);
        echo json_encode(array("message" => "Невозможно создать депозит.Данные неполные",JSON_UNESCAPED_UNICODE));
    }