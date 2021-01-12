<?php


namespace app\models;

use app\utility\Database;

class Statistics
{
    public $since;
    public $to;

    public function __construct()
    {
        $this->since='0000-00-00';
        $this->to=date("Y-m-d");
    }

    public function countRecords(): object
    {
        $this->conn = new Database();
        $this->conn->query("
            SELECT COUNT(*) as 'countRecords' 
            FROM invoices as i"
        );
        return $this->conn->single();
    }

    public function sumInv($typeTax,$typeInv): object
    {
        $this->conn = new Database();
        $this->conn->query("
            SELECT SUM($typeTax) as $typeTax
            FROM invoices as i
            WHERE type='$typeInv'
            AND i.date_of_invoice >= '$this->since'
            AND i.date_of_invoice <= '$this->to'"
        );
        return $this->conn->single();
    }

    public function monthlyBilling()
    {
        $this->conn = new Database();

        $this->conn->query("
            SELECT YEAR(date_of_invoice) as Rok, 
                   MONTHNAME(date_of_invoice) as Miesiac,
                   SUM(`sum_brutto`) AS Suma_miesiaca
            FROM   invoices
            WHERE  DATE(date_of_invoice) BETWEEN CURRENT_DATE - INTERVAL 13 month AND CURRENT_DATE
            AND type='sale'
            GROUP  BY YEAR(date_of_invoice),
                      MONTH(date_of_invoice)
            ORDER  BY YEAR(date_of_invoice) DESC,
                      MONTH(date_of_invoice) DESC
        ");
        $results['sale'] = $this->conn->resultSet();

        return $results;
    }

}