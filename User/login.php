<?php
// Заголовки
use objects\Deposit;

header("Access-Control-Allow-Origin: http://authentication-jwt/");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// Файлы необходимые для соединения с БД
include_once "../config/database.php";
include_once "../objects/Deposit.php";

// Получаем соединение с базой данных
$database = new Database();
$db = $database->getConnection();

// Создание объекта "Deposit"
$user = new Deposit($db);

// Получаем данные
$data = json_decode(file_get_contents("php://input"));

// Устанавливаем значения
$user->email = $data->email;
$email_exists = $user->emailExists();