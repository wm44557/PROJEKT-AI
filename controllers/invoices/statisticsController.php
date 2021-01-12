<?php


namespace app\controllers\invoices;


use app\models\Statistics;
use app\utility\Redirect;
use app\utility\Permissions;

class statisticsController
{
    public function showStats($router)
    {
        $stats = new Statistics();
        $results['countRecords']=$stats->countRecords();
        $results['sumCosts']=$stats->sumInv('sum_brutto','buy');
        $results['sumProceeds']=$stats->sumInv('sum_brutto','sale');

        $results['monthlyBiling']=$stats->monthlyBilling();
        $router->render("pages/user/panel", [
            'results' => $results]);
    }
}