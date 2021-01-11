<?php

declare(strict_types=1);

namespace app\models;

use app\utility\Database;

class Statistics
{
    public function mainStatistics()
    {
        $this->conn = new Database();

        $this->conn->query("
            SELECT COUNT(*) as 'countRecords' 
            FROM invoices"
        );
        return $this->conn->single();
    }
}