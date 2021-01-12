<?php
declare(strict_types=1);

namespace app\models;

use app\utility\Database;

class Invoice
{
    public function addInvoice($dataPost): void
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

        //Dodanie licencji do bazy oraz przypisanie konkretnych licencji do faktury
        $counter=(int)$dataPost['licencesCount'];
        for($i=1; $i<=$counter; $i++){
            if (isset($dataPost['licenceSku-'.$i])){
                $this->conn->query(
                    "INSERT INTO 
                         `licences`(`sku`, `name`, `description`, `serial_number`, `buy_date`, `warranty_to`, `valid_to`, `price_netto`, `vat`,`price_brutto`, `who_uses`, `invoice_id`) 
                         VALUES (:sku,:name,:description,:serialNumber,:buyDate,:warranty,:valid,:priceNetto,:vat,:priceBrutto,:owner,:invoiceId)");
                $this->conn->bindValue('sku', $dataPost['licenceSku-'.$i]);
                $this->conn->bindValue("name", $dataPost['licenceName-'.$i]);
                $this->conn->bindValue("serialNumber", $dataPost['licenceSerial-'.$i]);
                $this->conn->bindValue("description", $dataPost['licenceDescription-'.$i]);
                $this->conn->bindValue("buyDate", $dataPost['licenceBuyDate-'.$i]);
                $this->conn->bindValue("warranty", $dataPost['licenceWarrantyDate-'.$i]);
                $this->conn->bindValue("valid", $dataPost['licenceValidTo-'.$i]);
                $this->conn->bindValue("priceNetto", $dataPost['licenceNetto-'.$i]);
                $this->conn->bindValue("vat", $dataPost['licenceVat-'.$i]);
                $this->conn->bindValue("priceBrutto", $dataPost['licenceBrutto-'.$i]);
                $this->conn->bindValue("owner", $dataPost['licenceWhoUses-'.$i]);
                $this->conn->bindValue("invoiceId", $invoiceId->id);
                $this->conn->execute();
            }
        }

    }

    public function listInvoice(): array
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

        //Ustalanie przedzialu czasowego
        $sinceDate = '0000-00-00';
        $toDate = date("Y-m-d", strtotime("+1 day"));

        $getSince = $_GET['since_date'] ?? '';
        $getTo = $_GET['to_date'] ?? '';

        if ($getSince != NULL)
            $sinceDate = $getSince;
        if ($getTo != NULL)
            $toDate = $getTo;

        $dateFiltr = "AND i.date_of_invoice >= '$sinceDate'
        AND i.date_of_invoice <= '$toDate'";

        //Wyszukanie po wybraniu jednej z opcji
        $searchSelect = $_GET['searchSelect'] ?? 'invoice_number';
        switch ($searchSelect) {
            case "id":
                $queryRow = "AND i.id LIKE '%$searchText%'";
                $searchRowInCount="i.id";
                break;
            case "name":
                $queryRow = "AND c.name LIKE '%$searchText%'";
                $searchRowInCount="c.name";
                break;
            case "vat_id":
                $queryRow = "AND c.vat_id LIKE '%$searchText%'";
                $searchRowInCount="c.vat_id";
                break;
            default:
                $queryRow = "AND i.invoice_number LIKE '%$searchText%'";
                $searchRowInCount="i.invoice_number";
        }

        $this->conn->query("
            SELECT COUNT($searchRowInCount) as 'countRecords' 
            FROM invoices as i
            LEFT JOIN contractors as c
            ON i.contractor_id=c.id
            WHERE $searchRowInCount
            LIKE '%$searchText%' 
            $dateFiltr"
        );


        $totalRecords = $this->conn->single();
        $startFrom = ($currentPage - 1) * $limit;
        $totalPages = ceil($totalRecords->countRecords / $limit);

        //Pobranie z bazy wszystkich faktur
        $this->conn->query(
            "SELECT i.ID, i.invoice_number, c.name, c.vat_id, i.date_of_invoice, i.sum_brutto
                FROM invoices AS i, contractors AS c
                WHERE i.contractor_id=c.id
                $queryRow
                $dateFiltr
                GROUP BY i.invoice_number
                LIMIT $startFrom, $limit"
        );
        $records['elements'] = $this->conn->resultSet();
        $records['paginationInfo'] = $totalPages;
        return $records;
    }

    public function showInvoice($invoiceId): array
    {
        $this->conn = new Database();
        $this->conn->query("
            SELECT i.id, i.invoice_number, c.name,c.vat_id, i.sum_netto, i.sum_vat,i.sum_brutto, i.date_of_invoice, i.type, i.dirpath, i.type
            FROM invoices as i, contractors as c
            WHERE i.contractor_id=c.id
            AND i.id=:invoiceId;
            ");
        $this->conn->bindValue("invoiceId", $invoiceId);
        $invoiceData['headerInvoice'] = $this->conn->resultSet();

        $this->conn->query("
            SELECT `id`, `sku`, `name`, `description`, `serial_number`, `buy_date`, `warranty_to`, `valid_to`, `price_netto`, `vat`,`price_brutto`, `who_uses`, `invoice_id` 
            FROM `licences` 
            WHERE invoice_id=:invoiceId
            ");
        $this->conn->bindValue("invoiceId", $invoiceId);
        $invoiceData['licenceData'] = $this->conn->resultSet();
        return $invoiceData;
    }

    public function getInvoiceDocuments($invoiceId):array
    {
        $this->conn = new Database();
        $this->conn->query("SELECT d.id, d.name, d.added_at, d.description FROM documents d WHERE invoice_id=:invoiceId");
        $this->conn->bindValue("invoiceId", $invoiceId);
        $res = $this->conn->resultSet();
        return $res;
    }

    public function addInvoiceDocument($invoiceId, $documentName, $description):void
    {
        $this->conn = new Database();
        $this->conn->query('INSERT INTO documents(name, description, invoice_id) 
                                VALUES (:name, :description, :invoiceId)');
        $this->conn->bindValue("name", $documentName);
        $this->conn->bindValue("description", $description);
        $this->conn->bindValue("invoiceId", $invoiceId);
        $this->conn->execute();
    }

    public function deleteInvoiceDocument($documentId):void
    {
        $this->conn = new Database();
        $this->conn->query('DELETE FROM documents WHERE id=:documentId');
        $this->conn->bindValue("documentId", $documentId);
        $this->conn->execute();
    }

    public function getOrCreateDirectory($invoiceId):string
    {
        $this->conn = new Database();
        $this->conn->query("SELECT dirpath FROM invoices WHERE id=:invoiceId");
        $this->conn->bindValue("invoiceId", $invoiceId);
        $res = $this->conn->single();
        if (!$res->dirpath){
            do{
                $dirpath = $this->generateRandomString();
            } while(!mkdir('./media/'.$dirpath));
            $this->conn->query("UPDATE invoices SET dirpath=:dirpath WHERE id=:invoiceId");
            $this->conn->bindValue("dirpath", $dirpath);
            $this->conn->bindValue("invoiceId", $invoiceId);
            $this->conn->execute();
            return $dirpath;
        } else {
            return $res->dirpath;
        }
    }

    private function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

}


