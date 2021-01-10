<?php

declare(strict_types=1);

namespace app\controllers\invoices;

use app\models\Invoice;
use app\utility\Redirect;
use app\utility\Permissions;

class invoiceController
{

    public function addInvoice($router)
    {
        if ($_POST) {
            $dataPost = $_POST;
            $invoice = new Invoice();
            $invoice->addInvoice($dataPost);
            Redirect::to("/");
        }
    }

    public function listInvoice($router)
    {
        $invoice = new Invoice();
        $results = $invoice->listInvoice();
        $router->render("pages/components/invoiceList", [
            'page' => 'list-invoice',
            'results' => $results]);
    }

    public function showInvoice($router)
    {
        $invoiceId = $_GET['invoiceId'];
        $invoice = new Invoice();
        $results = $invoice->showInvoice($invoiceId);
        $files = $invoice->getInvoiceDocuments($invoiceId);
        $router->render("pages/components/invoiceShow", [
            'page' => 'list-invoice',
            'results' => $results,
            'invoiceId' => $invoiceId,
            'files' => $files]);

    }

    public function addFile(){
        dump($_POST);
        dump($_FILES);
        $invoiceId = $_POST['invoiceId'];
        $invoice = new Invoice();
        $dirpath = $invoice->getOrCreateDirectory($invoiceId);
        $dir = "media/".$dirpath.'/'.$_FILES['file']['name'];
        if (move_uploaded_file( $_FILES['file']['tmp_name'], $dir)){
            $invoice->addInvoiceDocument($invoiceId, $_FILES['file']['name'], $_POST['description']);
        }
    }

}