<?php


namespace app\models;

use app\utility\Database;



class Invoice
{
    public function addInvoice($dataPost)
    {
        $this->conn = new Database();

        //Dodanie do tabeli Contractors nazwy oraz vat ID
        $this->conn->query("INSERT INTO `contractors`(`name`,`vat_id`) VALUES (:name,:vat_id)");
        $this->conn->bindValue('name', $dataPost['contractor']);
        $this->conn->bindValue("vat_id", $dataPost['contractorVatId']);
        $this->conn->execute();

        //Pobranie z tabeli Contractors ID, aby przypisac do faktury
        $this->conn->query("SELECT id FROM contractors WHERE vat_id=:vat_id");
        $this->conn->bindValue("vat_id", $dataPost['contractorVatId']);
        $contractorId = $this->conn->single();

        //Dodanie faktury do bazy
        $this->conn->query(
            "INSERT INTO `invoices`(`invoice_number`, `sum_netto`, `sum_vat`,`sum_brutto`, `date_of_invoice`, `type`,`contractor_id`) 
                    VALUES (:invoice_number,:sum_netto,:sum_vat,:sum_brutto,:data_of_invoice,:type,:contractor_id)");
        $this->conn->bindValue('invoice_number', $dataPost['invoiceNumber']);
        $this->conn->bindValue("sum_netto", $dataPost['sumNetto']);
        $this->conn->bindValue("sum_vat", $dataPost['sumVAT']);
        $this->conn->bindValue("sum_brutto", $dataPost['sumBrutto']);
        $this->conn->bindValue("data_of_invoice", $dataPost['dateInvoice']);
        $this->conn->bindValue("type", $dataPost['type']);
        $this->conn->bindValue("contractor_id", $contractorId->id);
        $this->conn->execute();

        //Pobranie z tabeli Invoice ID, aby przypisac licencje do faktury
        $this->conn->query("SELECT id FROM invoices WHERE invoice_number=:invoice_number");
        $this->conn->bindValue("invoice_number", $dataPost['invoiceNumber']);
        $invoiceId = $this->conn->single();
        dump($invoiceId);

        //Dodanie licencji do bazy oraz przypisanie konkretnej licencji do faktury
        $this->conn->query(
            "INSERT INTO 
            `licences`(`sku`, `name`, `description`, `serial_number`, `buy_date`, `warranty_to`, `valid_to`, `price_netto`, `vat`,`price_brutto`, `who_uses`, `invoice_id`) 
            VALUES (:sku,:name,:description,:serialNumber,:buyDate,:warranty,:valid,:priceNetto,:vat,:priceBrutto,:owner,:invoiceId)");
        $this->conn->bindValue('sku', $dataPost['sku']);
        $this->conn->bindValue("name", $dataPost['name']);
        $this->conn->bindValue("serialNumber", $dataPost['serialNumber']);
        $this->conn->bindValue("description", $dataPost['description']);
        $this->conn->bindValue("buyDate", $dataPost['buyDate']);
        $this->conn->bindValue("warranty", $dataPost['warranty']);
        $this->conn->bindValue("valid", $dataPost['valid']);
        $this->conn->bindValue("priceNetto", $dataPost['priceNetto']);
        $this->conn->bindValue("vat", $dataPost['vat']);
        $this->conn->bindValue("priceBrutto", $dataPost['priceBrutto']);
        $this->conn->bindValue("owner", $dataPost['owner']);
        $this->conn->bindValue("invoiceId", $invoiceId->id);
        $this->conn->execute();

    }

//    [invoiceNumber] => dsa
//    [contractor] => ddas
//    [contractorVatId] => 12312
//    [dateInvoice] => 2020-12-18
//    [type] => sale
//    [sku] => 151
//    [name] => Windows 10
//    [description] => Licencja do windowsa 10
//    [buyDate] => 2020-12-17
//    [warranty] => 2020-12-18
//    [valid] => 2020-12-19
//    [priceNetto] => 800
//    [vat] => 23
//    [owner] => Andrzej



    public function listInvoice()
    {
        $this->conn = new Database();

        //$LIMIT słuzy do ustawiania ilosci rekordów na jednej stronie
        $limit = 5;
        if (isset($_GET["page"])) {
            $currentPage  = $_GET["page"];
        }
        else {
            $currentPage=1;
        };
        $searchText=$_GET['search'] ?? '';


        if($searchText=='') {
            $this->conn->query("SELECT COUNT(*) as 'countRecords' FROM invoices ");
        }
        else
        {
            $this->conn->query("SELECT COUNT(*) as 'countRecords' FROM invoices WHERE invoice_number LIKE '%$searchText%'");
        }

        $totalRecords = $this->conn->single();
        $startFrom = ($currentPage-1) * $limit;
        $totalPages = ceil($totalRecords->countRecords / $limit);

        //Pobranie z bazy wszystkich faktur ORDER BY i.date_of_invoice DESC
        $this->conn->query(
            "SELECT i.ID, i.invoice_number, c.name, c.vat_id, i.date_of_invoice, i.sum_brutto
                FROM invoices AS i, contractors AS c
                WHERE i.contractor_id=c.id
                AND i.invoice_number LIKE '%$searchText%'
                GROUP BY i.invoice_number
                LIMIT $startFrom, $limit"
        );
        $records['elements']=$this->conn->resultSet();
        $records['paginationInfo']=$totalPages;
        return $records;
    }

    public function showInvoice($dataPost)
    {
        $this->conn = new Database();
        $this->conn->query("
            SELECT i.id, i.invoice_number, c.name,c.vat_id, i.sum_netto, i.sum_vat,i.sum_brutto, i.date_of_invoice, i.type, i.dirpath, i.type
            FROM invoices as i, contractors as c
            WHERE i.contractor_id=c.id
            AND i.id=:invoiceId;
            ");
        $this->conn->bindValue("invoiceId", $dataPost['invoiceId']);
        $invoiceData['headerInvoice']= $this->conn->resultSet();

        $this->conn->query("
            SELECT `id`, `sku`, `name`, `description`, `serial_number`, `buy_date`, `warranty_to`, `valid_to`, `price_netto`, `vat`,`price_brutto`, `who_uses`, `invoice_id` 
            FROM `licences` 
            WHERE invoice_id=:invoiceId
            ");
        $this->conn->bindValue("invoiceId", $dataPost['invoiceId']);
        $invoiceData['licenceData']= $this->conn->resultSet();
        return $invoiceData;
    }
}


