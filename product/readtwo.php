<?php

use objects\Deposit;

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
include_once '../config/database.php';
include_once '../objects/Deposit.php';
$database = new Database();
$db = $database->getConnection();
$clients = new Deposit($db);
$stmt = $clients->readtwo();
$num = $stmt->rowCount();
if ($num > 0) {
    $clients_arr = array();
    $clients_arr["records"] = array();
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        $clients_item = array(
            "deposit_id" => $deposit_id,
            "deposit_name" => $deposit_name,
            "deposit_time_months" => $deposit_time_months,
            "deposit_bid" => $deposit_bid,
        );
        $clients_arr["records"][] = $clients_item;
    }
    http_response_code(200);
    echo json_encode($clients_arr);
} else {
    http_response_code(404);
    echo json_encode(array("message" => "Клиент не найдены."),
        JSON_UNESCAPED_UNICODE);
}