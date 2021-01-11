<?php

declare(strict_types=1);

namespace app\controllers\invoices;

use app\models\Statistics;
use app\utility\Redirect;
use app\utility\Permissions;

class statisticsController
{
    public function mainStatistics($router)
    {
        $stats = new Statistics();
        $results = $stats->mainStatistics();
        $router->render("pages/components/statsList", ['results' => $results]);
    }

}