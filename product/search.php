<?php

use objects\Account;

header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    include_once '../config/database.php';
    include_once '../objects/Account.php';

    $database = new Database();
    $db = $database->getConnection();
    $product = new Account($db);
    $keywords = isset($_GET['s']) ? $_GET['s'] : "";
    $stmt = $product->search($keywords);
    $num = $stmt->rowCount();
    if($num>0){
        $products_arr = array();
        $products_arr["records"] = array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $product_item = array(
                "account_date_start" => $account_date_start,
                "account_date_end" => $account_date_end,
                "account_money" => $account_money
            );
            array_push($products_arr["records"], $product_item);
        }
        http_response_code(200);
        echo json_encode($products_arr);
    }
    else{
        http_response_code(404);
        echo json_encode(array("message" => "Счёт не найден."),JSON_UNESCAPED_UNICODE);
    }
