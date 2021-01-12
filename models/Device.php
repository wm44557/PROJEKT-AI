<?php

declare(strict_types=1);

namespace app\models;

use app\utility\Database;

class Device
{
    public function list()
    {
        $this->conn = new Database();
        //dump($_GET);
        //$LIMIT słuzy do ustawiania ilosci rekordów na jednej stronie
        $limit = 5;
        if (isset($_GET["page"])) {
            $currentPage = $_GET["page"];
        } else {
            $currentPage = 1;
        };
        $searchText = $_GET['search'] ?? '';

        //Wyszukanie po wybraniu jednej z opcji
        $searchSelect = $_GET['searchSelect'] ?? 'sku';
        switch ($searchSelect) {
            case "serial_number":
                $queryRow = "AND e.serial_number LIKE '%$searchText%'";
                $searchRowInCount="serial_number";
                break;
            default:
                $queryRow = "AND e.sku LIKE '%$searchText%'";
                $searchRowInCount="sku";
        }

        $this->conn->query("
            SELECT COUNT($searchRowInCount) as 'countRecords' 
            FROM equipement
            WHERE $searchRowInCount 
            LIKE '%$searchText%'"
        );

        $totalRecords = $this->conn->single();
        $startFrom = ($currentPage - 1) * $limit;
        $totalPages = ceil($totalRecords->countRecords / $limit);


        //Pobranie z bazy wszystkich urządzeń
        $this->conn->query(
            "SELECT e.sku, e.name, e.description, e.serial_number, e.buy_date, e.warranty_to, e.price_netto, e.who_uses, i.invoice_number
                FROM equipement as e, invoices as i
                WHERE i.id=e.invoice_id
                $queryRow
                GROUP BY e.sku
                LIMIT $startFrom, $limit"
        );
        $records['elements'] = $this->conn->resultSet();
        $records['paginationInfo'] = $totalPages;
        return $records;
    }
}