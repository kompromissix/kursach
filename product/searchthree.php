<?php

use objects\Deposit;

header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    include_once '../config/database.php';
    include_once '../objects/Deposit.php';

    $database = new Database();
    $db = $database->getConnection();
    $product = new Deposit($db);
    $keywords = isset($_GET['s']) ? $_GET['s'] : "";
    $stmt = $product->searchthree($keywords);
    $num = $stmt->rowCount();
    if($num>0){
        $products_arr = array();
        $products_arr["records"] = array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $product_item = array(
                "deposit_name" => $deposit_name,
                "deposit_time_months" => $deposit_time_months,
                "deposit_bid" => $deposit_bid,
            );
            array_push($products_arr["records"], $product_item);
        }
        http_response_code(200);
        echo json_encode($products_arr);
    }
    else{
        http_response_code(404);
        echo json_encode(array("message" => "Товары не найдены."),JSON_UNESCAPED_UNICODE);
    }
