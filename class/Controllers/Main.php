<?php

namespace Controllers;

use PDO;
use Handles\Handle;
use AltoRouter;

final class Main extends Controller
{

    public function __construct(){
        try {
            // Inicjalizacja sesji anonimowej
            \Tools\Session::initialize();

            //ustawienie routera (wszytskie adnotacje w klasie Tools/Router)
            $router = \Tools\Router::getRouter();
            $match = $router->match();
            //!d($match);

            // te nulle są specjalnie
            // gdy cos nie trybi to zależy mi żeby sypało błędami
            $controller = isset($match['target']['controller'])  ? $match['target']['controller'] : null;
            $action     = isset($match['target']['action'])      ? $match['target']['action']     : null;
            $id         = isset($match['params']['id'])          ? $match['params']['id']         : null;

            // Dodanie do nazwy kontrolera przestrzeni nazw
            $fullController = 'Controllers\\'.$controller;
            // Utworzenie kontrolera (jeśli istnieje)
            if (!class_exists($fullController)) {
                throw new \Exceptions\Application();
            }
            $appController = new $fullController();

            if (\Tools\Access::islogin() !== true)
            {   // Logowanie do systemu lub rejestracja
                if ($this->isAccessible($controller,$action))
                {
                    $showPage = $appController->$action();
                }
                else
                {
                    $this->redirect('logowanie');
                    //$showPage = $appController->$action($id);
                }
            }
            else
            {   // Sprawdzamy, czy akcja kontrolera istnieje
                if (!\method_exists($appController, $action))
                    throw new \Exceptions\Application();
                // Uruchamiamy akcję kontrolera
                $showPage = $appController->$action($id);
            }


            //Wyświetlenie strony
            echo $showPage;

            // !d($_SESSION);
            // !d($_COOKIE);

        } catch(\Exception $e) {
            $this->redirect('404.html');
            //d($e);
        }

    }

    private function isAccessible($controller, $action)
    {
        $allowed_controllers = array(
            'Access', 'Uzytkownik', 'Rejestracja', 'Strona_glowna', 'Szkolenie'
        );

        $allowed_actions = array(
            'login', 'add', 'regForm', 'zalogujForm', 'showView', 'selectOneById',
            // Kontroler Rejestracja
            'showFormRegister', 'registerParticipant', 'showRegisterConfirmation'
        );

        return in_array($controller, $allowed_controllers) && in_array($action, $allowed_actions);
    }
}
