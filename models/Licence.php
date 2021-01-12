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

        $this->conn->query("
            SELECT COUNT(*) as 'countRecords' 
            FROM invoices as i 
            WHERE i.invoice_number 
            LIKE '%$searchText%'"
        );

        $totalRecords = $this->conn->single();
        $startFrom = ($currentPage - 1) * $limit;
        $totalPages = ceil($totalRecords->countRecords / $limit);


        //Wyszukanie po wybraniu jednej z opcji
        $searchSelect = $_GET['searchSelect'] ?? 'invoice_number';
        switch ($searchSelect) {
            case "id":
                $queryRow = "AND i.id LIKE '%$searchText%'";
                break;
            case "name":
                $queryRow = "AND c.name LIKE '%$searchText%'";
                break;
        }

        //Pobranie z bazy wszystkich faktur
        $this->conn->query(
            "SELECT i.ID, i.invoice_number, c.name, c.vat_id, i.date_of_invoice, i.sum_brutto
                FROM invoices AS i, contractors AS c
                WHERE i.contractor_id=c.id
                $queryRow
                GROUP BY i.invoice_number
                LIMIT $startFrom, $limit"
        );
        $records['elements'] = $this->conn->resultSet();
        $records['paginationInfo'] = $totalPages;
        return $records;

    }

}