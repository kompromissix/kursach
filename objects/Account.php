<?php

namespace objects;

//use PDO;

class Account
{
    private $conn;
    private $table_name = 'account';
    public $account_id;
    public $deposit_id;
    public $clients_id;
    public $account_date_start;
    public $account_date_end;
    public $account_money;
    public function __construct($db){
        $this->conn = $db;
    }

    function createthree()
    {

        // Запрос для добавления нового пользователя в БД
        $query = "INSERT INTO " . $this->table_name . " (account_id, deposit_id, clients_id, account_date_start, account_date_end, account_money) values (:account_id, :deposit_id, :clients_id, :account_date_start, :account_date_end, :account_money)";

        // Подготовка запроса
        $stmt = $this->conn->prepare($query);

        // Инъекция
        $this->account_id = htmlspecialchars(strip_tags($this->account_id));
        $this->deposit_id = htmlspecialchars(strip_tags($this->deposit_id));
        $this->clients_id = htmlspecialchars(strip_tags($this->clients_id));
        $this->account_date_start = htmlspecialchars(strip_tags($this->account_date_start));
        $this->account_date_end = htmlspecialchars(strip_tags($this->account_date_end));
        $this->account_money = htmlspecialchars(strip_tags($this->account_money));

        // Привязываем значения
        $stmt->bindParam(":account_id", $this->account_id);
        $stmt->bindParam(":deposit_id", $this->deposit_id);
        $stmt->bindParam(":clients_id", $this->clients_id);
        $stmt->bindParam(":account_date_start", $this->account_date_start);
        $stmt->bindParam(":account_date_end", $this->account_date_end);
        $stmt->bindParam(":account_money", $this->account_money);

        // Выполняем запрос
        // Если выполнение успешно, то информация о пользователе будет сохранена в базе данных
        if ($stmt->execute()) {
            return true;
        }

        return false;
    }
    public function read()
    {
        $query = "SELECT
                account_id, deposit_id, clients_id, account_date_start, account_date_end, account_money
            FROM
                " . $this->table_name . "
            ORDER BY
                account_date_start";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }

   function update()
   {
       $query = "update " . $this->table_name . " set deposit_id=:deposit_id,
                                                clients_id=:clients_id,
                                                account_date_start=:account_date_start,
                                                account_date_end=:account_date_end,
                                                account_money=:account_money
                                                where account_id=:account_id";
       $stmt = $this->conn->prepare($query);
       $this->deposit_id = htmlspecialchars(strip_tags($this->deposit_id));
       $this->clients_id = htmlspecialchars(strip_tags($this->clients_id));
       $this->account_date_start = htmlspecialchars(strip_tags($this->account_date_start));
       $this->account_date_end = htmlspecialchars(strip_tags($this->account_date_end));
       $this->account_money = htmlspecialchars(strip_tags($this->account_money));
       $this->account_id = htmlspecialchars(strip_tags($this->account_id));

       $stmt->bindParam(':deposit_id',$this->deposit_id);
       $stmt->bindParam(':clients_id',$this->clients_id);
       $stmt->bindParam(':account_date_start',$this->account_date_start);
       $stmt->bindParam(':account_date_end',$this->account_date_end);
       $stmt->bindParam(':account_money',$this->account_money);
       $stmt->bindParam(':account_id',$this->account_id);

       if($stmt->execute()){
           return true;
       }
       return false;
   }
   function delete()
   {
       $query = "delete from ".$this->table_name." where account_id=:account_id";
       $stmt = $this->conn->prepare($query);
       $this->account_id = htmlspecialchars(strip_tags($this->account_id));
       $stmt->bindParam(':account_id',$this->account_id);
       if($stmt->execute()){
           return true;
       }
       return false;
   }
   function  search($keyword)
   {
       $query="select account_date_start, account_date_end, account_money
               from ".$this->table_name." WHERE CAST(account_date_start AS TEXT) LIKE ?
                 OR CAST(account_date_end AS TEXT) LIKE ?
                 OR CAST(account_money AS TEXT) LIKE ?";

       $stmt = $this->conn->prepare($query);
       $keyword=htmlspecialchars(strip_tags($keyword));
       $keyword="%$keyword%";
       $stmt->bindParam(1,$keyword);
       $stmt->bindParam(2,$keyword);
       $stmt->bindParam(3,$keyword);
       $stmt->execute();
       return $stmt;
   }
}