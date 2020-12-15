<?php

declare(strict_types=1);

namespace Application;

use Application\Exception\ConfigurationException;
use Application\Exception\ConnectionException;
use Application\Exception\ApplicationException;
use Application\Exception\OperationException;
use PDOException;
use Throwable;
use PDO;
use Application\Request;

class Database
{
    private PDO $connection;
    public function __construct(array $config)
    {
        try {
            $this->validateConfg($config);
            $this->createConnection($config);
        } catch (PDOException $e) {
            dump($e);
            throw new ConnectionException('Connection Error');
        }
    }

    public function register($login, $password, $email): void
    {
        $query = $this->connection->prepare("
            INSERT INTO osoba(userName, pass, email)
            VALUES(:login,:password,:email)
            ");
        $query->bindParam(':login', $login);
        $query->bindParam(':password', $password);
        $query->bindParam(':email', $email);
        $query->execute();
    }
    public function listUsers(): array
    {
        $query = "SELECT * from osoba";
        $result = $this->connection->query($query);
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getRecord($id): array
    {
        $query = $this->connection->prepare("SELECT * FROM osoba WHERE id=:id");
        $query->bindParam(':id', $id);
        $query->execute();
        return $query->fetch();;
    }

    public function editUser($password, $email, $id): void
    {
        $query = $this->connection->prepare("UPDATE osoba SET pass = :password,email=:email WHERE id= :id");
        $query->bindParam(':password', $password);
        $query->bindParam(':email', $email);
        $query->bindParam(':id', $id);
        $query->execute();
    }

    public function loginPassword($login, $password = null)
    {
        $checkPassword = $password === null ? false : true;

        if ($checkPassword == false) {
            $query = $this->connection->prepare("SELECT * FROM osoba WHERE userName=:login");
        } else {
            $query = $this->connection->prepare("SELECT * FROM osoba WHERE userName=:login AND pass=:password");
            $query->bindParam(':password', $password);
        }
        $query->bindParam(':login', $login);
        $query->execute();

        if ($checkPassword == false) {
            return $query->fetch() === false ? false : true;
        } else {
            return $query->fetch();
        }
    }

    private function createConnection(array $config): void
    {
        $dsn = "mysql:host={$config['host']};dbname={$config['database']}";
        // $dsn = 'mysql:host=mysql.ct8.pl;dbname=m19244_ai';
        $this->connection = new PDO(
            $dsn,
            $config['user'],
            $config['password'],
            [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
        );
    }
    private function validateConfg(array $config): void
    {
        if (
            empty($config['database'])
            || empty($config['host'])
            || empty($config['user'])
        ) {
            throw new ConfigurationException('Storage configuration error');
        };
    }
}
