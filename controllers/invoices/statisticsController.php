<?php


namespace app\controllers\invoices;


use app\models\Statistics;
use app\utility\Redirect;
use app\utility\Permissions;

class statisticsController
{
    public function showStats($router): array
    {
        $stats = new Statistics();
        $results['countRecords']=$stats->countRecords();
        $results['sumBruttoInv']=$stats->sumInv('sum_brutto');
        $results['sumNettoInv']=$stats->sumInv('sum_netto');
        $router->render("pages/user/panel", [
            'results' => $results]);
    }
}