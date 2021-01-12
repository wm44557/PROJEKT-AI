<?php

declare(strict_types=1);

namespace app\controllers\invoices;

use app\models\Licence;

class licenceController
{
    public function listLicence($router)
    {
        $licence = new Licence();
        $results = $licence->list();
        $router->render("pages/components/licenceList", [
            'page_name' => 'list-licence',
            'results' => $results]);
    }


}