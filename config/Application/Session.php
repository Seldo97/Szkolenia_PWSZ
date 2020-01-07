<?php
namespace Config\Application;

use Config\Config as Conf;

final class Session extends Conf
{
    public static $tab = null;

    public static $regenerateTime    = '';     // czas do regenracji sesji
    public static $regenerateRequest = '';     // ilość zapytań do regenracji sesji
    public static $sessionTime       = '';     // czas automatycznego wylogowania

    public static function setVariableValue()
    {
        foreach(self::$tab as $key => $value)
            self::$$key = $value;
    }
}

Session::wczytaj('Session');
Session::setVariableValue();
