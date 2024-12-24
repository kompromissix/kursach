<?php

namespace objects;

class Clients
{
    // соединение с БД и таблицей "categories"
    private $conn;
    private $table_name = "clients";

    // свойства объекта
    public $clients_id;
    public $clients_name;
    public $clients_passports;
    public $clients_address;
    public $clients_telephone;

    public function __construct($db)
    {
        $this->conn = $db;
    }
    public function readAll()
    {
        $query = "SELECT
                clients_id, clients_name, clients_passports,clients_address, clients_telephone
            FROM
                " . $this->table_name . "
            ORDER BY
                clients_name";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }
    function createtwo()
    {

        // Запрос для добавления нового пользователя в БД
        $query = "INSERT INTO " . $this->table_name . " (clients_id, clients_name,clients_passports,clients_address, clients_telephone) values (:clients_id, :clients_name,:clients_passports,:clients_address, :clients_telephone)";

        // Подготовка запроса
        $stmt = $this->conn->prepare($query);

        // Инъекция
        $this->clients_id = htmlspecialchars(strip_tags($this->clients_id));
        $this->clients_name = htmlspecialchars(strip_tags($this->clients_name));
        $this->clients_passports = htmlspecialchars(strip_tags($this->clients_passports));
        $this->clients_address = htmlspecialchars(strip_tags($this->clients_address));
        $this->clients_telephone = htmlspecialchars(strip_tags($this->clients_telephone));

        // Привязываем значения
        $stmt->bindParam(":clients_id", $this->clients_id);
        $stmt->bindParam(":clients_name", $this->clients_name);
        $stmt->bindParam(":clients_passports", $this->clients_passports);
        $stmt->bindParam(":clients_address", $this->clients_address);
        $stmt->bindParam(":clients_telephone", $this->clients_telephone);

        // Выполняем запрос
        // Если выполнение успешно, то информация о пользователе будет сохранена в базе данных
        if ($stmt->execute()) {
            return true;
        }

        return false;
    }
    
   function deletetwo()
   {
       $query = "delete from ".$this->table_name." where clients_id=:clients_id";
       $stmt = $this->conn->prepare($query);
       $this->clients_id = htmlspecialchars(strip_tags($this->clients_id));
       $stmt->bindParam(':clients_id',$this->clients_id);
       if($stmt->execute()){
           return true;
       }
       return false;
   }
    function  searchtwo($keyword)
    {
        $query="select clients_name, clients_passports, clients_address, clients_telephone
              FROM " . $this->table_name . "
              WHERE clients_name LIKE ?
                 OR clients_passports LIKE ?
                 OR clients_address LIKE ?
                 OR clients_telephone LIKE ?";

        $stmt = $this->conn->prepare($query);
        $keyword=htmlspecialchars(strip_tags($keyword));
        $keyword="%$keyword%";
        $stmt->bindParam(1,$keyword);
        $stmt->bindParam(2,$keyword);
        $stmt->bindParam(3,$keyword);
        $stmt->bindParam(4,$keyword);
        $stmt->execute();
        return $stmt;
    }
   function updatetwo()
   {
       $query = "update " . $this->table_name . " set clients_name=:clients_name,
                                                clients_passports=:clients_passports,
                                                clients_address=:clients_address,
                                                clients_telephone=:clients_telephone
                                                where clients_id=:clients_id";
       $stmt = $this->conn->prepare($query);
       $this->clients_name = htmlspecialchars(strip_tags($this->clients_name));
       $this->clients_passports = htmlspecialchars(strip_tags($this->clients_passports));
       $this->clients_address = htmlspecialchars(strip_tags($this->clients_address));
       $this->clients_telephone = htmlspecialchars(strip_tags($this->clients_telephone));
       $this->clients_id = htmlspecialchars(strip_tags($this->clients_id));

       $stmt->bindParam(':clients_name',$this->clients_name);
       $stmt->bindParam(':clients_passports',$this->clients_passports);
       $stmt->bindParam(':clients_address',$this->clients_address);
       $stmt->bindParam(':clients_telephone',$this->clients_telephone);
       $stmt->bindParam(':clients_id',$this->clients_id);

       if($stmt->execute()){
           return true;
       }
       return false;
   }
}