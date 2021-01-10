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
        if ($_POST) {
            $dataPost = $_POST;
            $invoice = new Invoice();
            $results = $invoice->showInvoice($dataPost);
            $files = $invoice->getInvoiceDocuments($dataPost['invoiceId']);
            dump($_POST);
            $router->render("pages/components/invoiceShow", [
                'page' => 'list-invoice',
                'results' => $results,
                'invoiceId' => $dataPost['invoiceId']]);
        }
    }

    public function addFile(){
        dump($_POST);
        dump($_FILES);
        $invoice = new Invoice();
        $dirpath = $invoice->getOrCreateDirectory($_POST['invoiceId']);
        $dir = "media/".$dirpath.'/'.$_FILES['file']['name'];
        move_uploaded_file( $_FILES['file']['tmp_name'], $dir) or die("Cos nei dziala");
    }

}