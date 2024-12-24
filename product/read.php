<?php

use objects\Account;

header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    include_once '../config/database.php';
    include_once '../objects/Account.php';
    $database = new Database();
    $db = $database->getConnection();
    $product = new Account($db);
    $stmt=$product->read();
    $num = $stmt->rowCount();
    if($num>0){
        $product_arr=array();
        $product_arr["records"]=array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $product_item=array(
                "account_id"=>$account_id,
                "deposit_id"=>$deposit_id,
                "clients_id"=>$clients_id,
                "account_date_start"=>$account_date_start,
                "account_date_end"=>$account_date_end,
                "account_money"=>$account_money
            );
            $product_arr["records"][] = $product_item;
        }
        http_response_code(200);
        echo json_encode($product_arr);
    }
    else
    {
        http_response_code(404);
        echo json_encode(array("message" => "Товары не найдены."),
            JSON_UNESCAPED_UNICODE);
    }