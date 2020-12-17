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
        $dataPost=$_POST;

        $invoice = new Invoice();
        $result = $invoice->addInvoice($dataPost);
        Redirect::to("/");

    }

    public function listInvoice($router)
    {
        $invoice = new Invoice();

        $results=$invoice->listInvoice();
        $router->render("pages/components/invoiceList",['results'=>$results]);
    }

}