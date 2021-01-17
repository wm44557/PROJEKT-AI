<?php

namespace app\models;

use app\utility\Database;

class User
{
    private $login;
    private $password;
    private $email;
    private $role;

    public function __construct()
    {
        $this->conn = new Database();
        $this->conn->query("SELECT * FROM users");
        $result = $this->conn->resultSet();
    }

    public function getUser($id)
    {
        $this->conn = new Database();
        $this->conn->query('SELECT * FROM users WHERE id=:id;');
        $this->conn->bindValue("id", $id);
        $result = $this->conn->single();
        return $result;
    }

    public function registerUser($dataRegister)
    {
        $this->conn = new Database();
        $this->conn->query("INSERT INTO `users`(`email`, `login`, `password`, `role`) VALUES (:email,:login,:password,:permission)");
        $this->conn->bindValue("email", $dataRegister['email']);
        $this->conn->bindValue("login", $dataRegister['login']);
        $this->conn->bindValue("password", $dataRegister['password']);
        $this->conn->bindValue("permission", $dataRegister['permission']);
        $this->conn->execute();
    }

    public function listUsers()
    {
        $this->conn = new Database();
        $this->conn->query("SELECT * FROM users");
        $result = $this->conn->resultSet();
        return $result;
    }

    public function authenticate($login, $password)
    {
        $this->conn->query('SELECT * FROM users WHERE login=:login AND password=:password;');
        $this->conn->bindValue("login", $login);
        $this->conn->bindValue("password", $password);
        return $this->conn->single();;
    }
}
