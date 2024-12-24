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
   function create()
   {

       // Запрос для добавления нового пользователя в БД
       $query = "INSERT INTO " . $this->table_name . " (deposit_id, deposit_name,deposit_time_months,deposit_bid) values (:deposit_id, :deposit_name,:deposit_time_months,:deposit_bid)";

       // Подготовка запроса
       $stmt = $this->conn->prepare($query);

       // Инъекция
       $this->deposit_id = htmlspecialchars(strip_tags($this->deposit_id));
       $this->deposit_name = htmlspecialchars(strip_tags($this->deposit_name));
       $this->deposit_time_months = htmlspecialchars(strip_tags($this->deposit_time_months));
       $this->deposit_bid = htmlspecialchars(strip_tags($this->deposit_bid));

       // Привязываем значения
       $stmt->bindParam(":deposit_id", $this->deposit_id);
       $stmt->bindParam(":deposit_name", $this->deposit_name);
       $stmt->bindParam(":deposit_time_months", $this->deposit_time_months);
       $stmt->bindParam(":deposit_bid", $this->deposit_bid);

       // Выполняем запрос
       // Если выполнение успешно, то информация о пользователе будет сохранена в базе данных
       if ($stmt->execute()) {
           return true;
       }

       return false;
   }
   
   function deletethree()
   {
       $query = "delete from ".$this->table_name." where deposit_id=:deposit_id";
       $stmt = $this->conn->prepare($query);
       $this->deposit_id = htmlspecialchars(strip_tags($this->deposit_id));
       $stmt->bindParam(':deposit_id',$this->deposit_id);
       if($stmt->execute()){
           return true;
       }
       return false;
   }
   public function readtwo()
   {
       $query = "SELECT
               deposit_id, deposit_name, deposit_time_months, deposit_bid
           FROM
               " . $this->table_name . "
           ORDER BY
               deposit_name";

       $stmt = $this->conn->prepare($query);
       $stmt->execute();

       return $stmt;
   }
   function  searchthree($keyword)
   {
       $query="select deposit_name, deposit_time_months, deposit_bid
              FROM " . $this->table_name . "
              WHERE deposit_name LIKE ?
                 OR CAST(deposit_time_months AS TEXT) LIKE ?
                 OR deposit_bid LIKE ?";

       $stmt = $this->conn->prepare($query);
       $keyword=htmlspecialchars(strip_tags($keyword));
       $keyword="%$keyword%";
       $stmt->bindParam(1,$keyword);
       $stmt->bindParam(2,$keyword);
       $stmt->bindParam(3,$keyword);
       $stmt->execute();
       return $stmt;
   }
   function updatethree()
   {
       $query = "update " . $this->table_name . " set deposit_name=:deposit_name,
                                                deposit_time_months=:deposit_time_months,
                                                deposit_bid=:deposit_bid
                                                where deposit_id=:deposit_id";
       $stmt = $this->conn->prepare($query);
       $this->deposit_name = htmlspecialchars(strip_tags($this->deposit_name));
       $this->deposit_time_months = htmlspecialchars(strip_tags($this->deposit_time_months));
       $this->deposit_bid = htmlspecialchars(strip_tags($this->deposit_bid));
       $this->deposit_id = htmlspecialchars(strip_tags($this->deposit_id));

       $stmt->bindParam(':deposit_name',$this->deposit_name);
       $stmt->bindParam(':deposit_time_months',$this->deposit_time_months);
       $stmt->bindParam(':deposit_bid',$this->deposit_bid);
       $stmt->bindParam(':deposit_id',$this->deposit_id);

       if($stmt->execute()){
           return true;
       }
       return false;
   }
}
