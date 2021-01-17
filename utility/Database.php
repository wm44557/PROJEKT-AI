<?php

namespace app\utility;

use PDO;

class Database{

    public $pdo;
    private $statement;
    private $error;

    public function __construct(){
        $DB_HOST=DB_HOST;
        $DB_NAME=DB_NAME;
        $DB_USER=DB_USER;
        $DB_PASS=DB_PASS;
        $this->pdo = new PDO("mysql:host={$DB_HOST};port=3306;dbname={$DB_NAME}", $DB_USER, $DB_PASS);
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function query($sql){
        $this->statement = $this->pdo->prepare($sql);
    }

    public function bindValue($param, $value){
        $this->statement->bindValue($param, $value);
    }

    public function execute(){
        return $this->statement->execute();
    }

    public function resultSet(){
        $this->execute();
        return $this->statement->fetchAll(PDO::FETCH_OBJ);
    }

    public function resultAll(){
        $this->execute();
        return $this->statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function single(){
        $this->execute();
        return $this->statement->fetch(PDO::FETCH_OBJ);
    }

    public function rowCount(){
        return $this->statement->rowCount();
    }
}


