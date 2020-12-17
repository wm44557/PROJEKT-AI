<?php


namespace app\models;

use app\utility\Database;


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
        $contractorId=$this->conn->single();

        //Dodanie faktury do bazy
        $this->conn->query(
            "INSERT INTO `invoices`(`invoice_number`, `price_netto`, `vat`, `date_of_invoice`, `type`,`contractor_id`) 
                    VALUES (:invoice_number,:price_netto,:vat,:data_of_invoice,:type,:contractor_id)");
        $this->conn->bindValue('invoice_number', $dataPost['invoiceNumber']);
        $this->conn->bindValue("price_netto", $dataPost['priceNetto']);
        $this->conn->bindValue("vat",  $dataPost['vat']);
        $this->conn->bindValue("data_of_invoice", $dataPost['dateInvoice']);
        $this->conn->bindValue("type", $dataPost['type']);
        $this->conn->bindValue("contractor_id", $contractorId->id);
        $this->conn->execute();
    }

    public function listInvoice()
    {

    }
}