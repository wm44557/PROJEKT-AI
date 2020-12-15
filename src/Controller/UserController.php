<?php

declare(strict_types=1);

namespace Application\Controller;

use Application\Exception\OperationException;

class UserController extends Controller
{

    public static function initConfiguration(array $configuration): void
    {
        self::$configuration = $configuration;
    }

    public function run(): void
    {
        try {
            switch ($this->action()) {

                case 'login':
                    $this->login();
                    break;
                case 'logout':
                    $this->logout();
                    break;
                case 'register':
                    $this->register();
                    break;
                case 'showRecord':
                    $this->showRecord();
                    break;
                case 'editRecord':
                    $this->editRecord();
                default:
                    $this->login();
                    break;
            }
        
            $this->logged();

            $this->view->render($this->page, $this->params);

        } catch (\Throwable $e) {
            throw new OperationException($e, 400);
        }
    }
    private function action(): string
    {
        return $this->request->requestGet('action', self::DEFAULT_ACTION);
    }
}

