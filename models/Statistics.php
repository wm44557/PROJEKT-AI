<?php


namespace app\models;

use app\utility\Database;

class Statistics
{

    public function countRecords(): object
    {
        $this->conn = new Database();
        $this->conn->query("
            SELECT COUNT(*) as 'countRecords' 
            FROM invoices as i"
        );
        return $this->conn->single();
    }

    public function sumInv($typeTax): object
    {
        $this->conn = new Database();
        $this->conn->query("
            SELECT SUM($typeTax) as $typeTax
            FROM invoices as i"
        );
        return $this->conn->single();
    }

}