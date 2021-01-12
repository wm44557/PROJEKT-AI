<?php

declare(strict_types=1);

namespace app\controllers\invoices;

use app\models\Device;

class deviceController
{
    public function listDevice($router)
    {
        $device = new Device();
        $results = $device->list();
        $router->render("pages/components/deviceList", [
            'page' => 'list-device',
            'results' => $results]);
    }

}