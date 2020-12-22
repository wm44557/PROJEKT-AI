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
            $router->render("pages/components/invoiceShow", [
                'page' => 'list-invoice',
                'results' => $results]);
        }
    }

}