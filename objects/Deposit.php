<?php

namespace objects;

class Deposit
{
    private $conn;
    private $table_name = "deposit";

    // Свойства
    public $deposit_id;
    public $deposit_name;
    public $deposit_time_months;
    public $deposit_bid;

    // Конструктор класса Deposit
    public function __construct($db)
    {
        $this->conn = $db;
    }

    // Метод для создания нового пользователя
//    function create()
//    {
//
//        // Запрос для добавления нового пользователя в БД
//        $query = "INSERT INTO " . $this->table_name . " (deposit_name,deposit_time_months,deposit_bid) values (:deposit_name,:deposit_time_months,:deposit_bid)";
//
//        // Подготовка запроса
//        $stmt = $this->conn->prepare($query);
//
//        // Инъекция
//        $this->deposit_name = htmlspecialchars(strip_tags($this->deposit_name));
//        $this->deposit_time_months = htmlspecialchars(strip_tags($this->deposit_time_months));
//        $this->deposit_bid = htmlspecialchars(strip_tags($this->deposit_bid));
//
//        // Привязываем значения
//        $stmt->bindParam(":deposit_name", $this->deposit_name);
//        $stmt->bindParam(":deposit_time_months", $this->deposit_time_months);
//        $stmt->bindParam(":deposit_bid", $this->deposit_bid);
//
//        // Выполняем запрос
//        // Если выполнение успешно, то информация о пользователе будет сохранена в базе данных
//        if ($stmt->execute()) {
//            return true;
//        }
//
//        return false;
//    }
}