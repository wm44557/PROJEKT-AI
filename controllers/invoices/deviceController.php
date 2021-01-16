<?php

declare(strict_types=1);

namespace app\controllers\invoices;

use app\models\Device;
use app\utility\Permissions;

class deviceController
{
    public function listDevice($router)
    {
        Permissions::check(['admin', 'user', 'auditor']);
        $device = new Device();
        $results = $device->list();
        $router->render("pages/components/deviceList", [
            'page_name' => 'list-device',
            'results' => $results]);
    }

}