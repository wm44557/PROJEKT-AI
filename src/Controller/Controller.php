<?php

declare(strict_types=1);

namespace Application\Controller;

use Application\Exception\ConfigurationException;
use Application\Database;
use Application\View;
use Application\debug;
use Application\Exception\OperationException;
use Application\Request;

class Controller
{
    protected const DEFAULT_ACTION = 'login';
    protected static $configuration = [];
    protected Database $database;
    protected Request $request;
    protected View $view;
    protected string $action;
    protected string $page;
    protected array $params = [];


    public function __construct(Request $request)
    {
        if (empty(self::$configuration['db'])) {
            throw new ConfigurationException('Configuration error');
        }
        
        $this->database = new Database(self::$configuration['db']);
        $this->request = $request;
        $this->view = new View();
    }

    public function login(): void
    {

        if (!empty($this->request->requestPost('login'))) {
            $result = $this->database->loginPassword($this->request->requestPost('login'), $this->request->requestPost('haslo'));
        }
        if (!empty($result)) {
            if ($result['userName'] == 'admin') {
                $_SESSION['zalogowany'] = 2;
                $this->page = 'panelAdmin';
            } else {
                $_SESSION['zalogowany'] = 1;
                $_SESSION['id'] = $result['id'];
                $_SESSION['user'] = $result['userName'];
                $_SESSION['pass'] = $result['pass'];
                $_SESSION['email'] = $result['email'];
                $this->params = ['login' => $_SESSION['user'], 'email' => $_SESSION['email']];
                $this->page = 'pageUser';
                dump($_POST);

            }
        } else {
         
            $this->params['login'] = 'fail';
            $this->page = 'login';
        }
    }

    public function logged(): void
    {
        if (isset($_SESSION['zalogowany'])) {
            if ($_SESSION['zalogowany'] == 1) {
                $result = $this->database->loginPassword($_SESSION['user'], $_SESSION['pass']);
                $login = $result['userName'];
                $pass = $result['pass'];
                $email = $result['email'];
                $this->params = ['login' => $login, 'email' => $email];
                $this->page = 'pageUser';
            } else if ($_SESSION['zalogowany'] == 2) {
                $this->params['tableUsers'] = $this->database->listUsers();
                $this->page = 'panelAdmin';
            } else {
            }
        }
    }

    public function logout(): void
    {
        session_unset();
        header("Location: /PROJEKT-AI/");
    }

    public function register(): void
    {
        $this->page = 'register';

        if (!empty($_POST)) {
            $login = $this->request->requestPost('login2');
            $haslo = $this->request->requestPost('haslo2');
            $email = $this->request->requestPost('email2');

            $checkLogin = $this->database->loginPassword($login);

            if (empty($login) || empty($haslo) || empty($email)) {
                $this->params['infoRegister'] = 'two';
            } else if ($checkLogin === true) {
                $this->params['infoRegister'] = 'one';
            } else {
                $this->database->register($login, $haslo, $email);
                $this->params['registerInfo'] = 'done';
                $register = 'true';
            }
            if (isset($register)) {
                $this->view->render('login', $this->params);
            } else {
                $this->view->render('register', $this->params);
            }
        }
    }

    public function showRecord(): void
    {
        $this->params['recordOne'] = $this->database->getRecord($this->request->requestGet('id'));
        $this->view->render('showRecord', $this->params);
    }

    public function editRecord(): void
    {
        $editLogin = $this->request->requestPost('userPassEdit');
        $editPass = $this->request->requestPost('userPassEdit');
        $editEmail = $this->request->requestPost('userEmailEdit');
        $requestId = $this->request->requestGet('id');

        $this->params['recordOne'] = $this->database->getRecord($requestId);

        if ((!empty($editLogin)) ||
            (!empty($editPass)) ||
            (!empty($editEmail))
        ) {
            $this->database->editUser($editPass, $editEmail, $requestId);
            $_SESSION['pass'] = $editPass;
            $this->params['recordOne'] = $this->database->getRecord($this->request->requestGet('id'));
        }
        $this->view->render('editRecord', $this->params);
    }
  
}
