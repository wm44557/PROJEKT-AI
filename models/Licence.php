<?php

declare(strict_types=1);

namespace app\models;

use app\utility\Database;

class Licence
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
                $queryRow = "AND l.serial_number LIKE '%$searchText%'";
                $searchRowInCount="serial_number";
                break;
            default:
                $queryRow = "AND l.sku LIKE '%$searchText%'";
                $searchRowInCount="sku";
        }

        $this->conn->query("
            SELECT COUNT($searchRowInCount) as 'countRecords' 
            FROM licences
            WHERE $searchRowInCount 
            LIKE '%$searchText%'"
        );

        $totalRecords = $this->conn->single();
        $startFrom = ($currentPage - 1) * $limit;
        $totalPages = ceil($totalRecords->countRecords / $limit);


        //Pobranie z bazy wszystkich licencji
        $this->conn->query(
            "SELECT l.sku, l.name, l.description, l.serial_number, l.buy_date, l.warranty_to, l.valid_to, l.price_netto, l.who_uses, i.invoice_number
                FROM licences as l, invoices as i
                WHERE i.id=l.invoice_id
                $queryRow
                GROUP BY l.id
                LIMIT $startFrom, $limit"
        );
        $records['elements'] = $this->conn->resultSet();
        $records['paginationInfo'] = $totalPages;
        return $records;

    }

}