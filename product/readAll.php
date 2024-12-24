<?php

use objects\Clients;

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
include_once '../config/database.php';
include_once '../objects/Clients.php';
$database = new Database();
$db = $database->getConnection();
$clients = new Clients($db);
$stmt = $clients->readAll();
$num = $stmt->rowCount();
if ($num > 0) {
    $clients_arr = array();
    $clients_arr["records"] = array();
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        $clients_item = array(
            "clients_id" => $clients_id,
            "clients_name" => $clients_name,
            "clients_passports" => $clients_passports,
            "clients_address" => $clients_address,
            "clients_telephone" => $clients_telephone,
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