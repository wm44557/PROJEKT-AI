<?php

declare(strict_types=1);

namespace app\controllers\invoices;
use app\models\Invoice;

class invoiceController
{

    public function addInvoice($router)
    {
        $dataPost=$_POST;

        $invoice = new Invoice();
        $result = $invoice->addInvoice($dataPost);

    }


}