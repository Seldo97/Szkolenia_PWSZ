<?php
namespace Tools;

class Router
{
    protected static $router = null;
    protected function __clone() {}
    protected function __construct() {}
    public static function getRouter()
    {
        if(!isset(self::$router) || self::$router === null) {

          self::$router = new \AltoRouter();
          self::$router->setBasePath('/'.\Config\Application\Config::$tab['path']);

           self::$router->map('GET','', array('controller' =>'Strona_glowna', 'action' => 'showView'), 'strona_glowna');
          //Tabela Cert
          self::$router->map('GET','certyfikat', array('controller' =>'Certyfikat', 'action' => 'showView'), 'certyfikatTabela');
          self::$router->map('GET','certyfikat/generuj/[i:id]', array('controller' =>'Certyfikat', 'action' => 'generujCert'), 'certyfikatGeneruj');

          //Tabela szkolenia
          self::$router->map('GET','szkolenia', array('controller' => 'Szkolenie', 'action' => 'showView'), 'szkolenieTabela');
          self::$router->map('GET','szkolenia/zapisz-sie/[i:id]/?', array('controller' => 'ZapisSzkolenie', 'action' => 'showView'), 'zapisSzkolenie');
          self::$router->map('GET','szkolenia/usun/[i:id]/?', array('controller' => 'Szkolenie', 'action' => 'delete'), 'usunSzkolenie');
          self::$router->map('GET','szkolenia/sprawdz_obecnosc/[i:id]/?', array('controller' => 'Szkolenie', 'action' => 'showPresence'), 'sprawdzObecnosc');
          self::$router->map('POST','szkolenia/save/?', array('controller' => 'ZapisSzkolenie', 'action' => 'zapisz_sie'), 'zapisSzkolenie_save');
          self::$router->map('POST','szkolenia/dodaj/?', array('controller' => 'Szkolenie', 'action' => 'insert'), 'szkolenie_dodaj');
          self::$router->map('POST','szkolenia/zapisz_obecnosc/?', array('controller' => 'Szkolenie', 'action' => 'zapiszObecnosc'), 'zapiszObecnosc');
          self::$router->map('GET','szkolenia/zmien_obecnosc_tak/[i:id]/?', array('controller' => 'Szkolenie', 'action' => 'zmienObecnoscTak'), 'zmienObecnoscTak');
          self::$router->map('GET','szkolenia/zmien_obecnosc_nie/[i:id]/?', array('controller' => 'Szkolenie', 'action' => 'zmienObecnoscNie'), 'zmienObecnoscNie');

          //Tabela uczestnik
          self::$router->map('GET','uczestnik', array('controller' => 'Uczestnik', 'action' => 'showView'), 'uczestnikTabela');
          self::$router->map('GET','uczestnik/edytuj/[i:id]/?', array('controller' => 'Uczestnik', 'action' => 'updateView'), 'uczestnik_edytuj');
          self::$router->map('POST','uczestnik/edit/[i:id]/?', array('controller' => 'Uczestnik', 'action' => 'update'), 'uczestnik_edit');

          //Tabela Platnosc
          self::$router->map('GET','platnosc', array('controller' =>'Platnosc', 'action' => 'showView'), 'platnoscTabela');
          self::$router->map('GET','platnosc/zaksieguj/[i:id]', array('controller' =>'Platnosc', 'action' => 'zaksiegujWplate'), 'platnoscZaksieguj');

          //Tabela Uzytkownik
          //self::$router->map('GET','logowanie', array('controller' => 'Uzytkownik', 'action' => 'zalogujForm'), 'zalogujForm');
          //self::$router->map('POST','logowanie/zaloguj', array('controller' => 'Uzytkownik', 'action' => 'zaloguj'), 'zaloguj');

          // Rejestracja
          self::$router->map('GET', 'rejestracja-uczestnika', array('controller' =>'Rejestracja', 'action' => 'showFormRegister'), 'pokarzFormularzRejestracjiUczestnika');
          self::$router->map('POST', 'rejestruj-uczestnika', array('controller' =>'Rejestracja', 'action' => 'registerParticipant'), 'rejestrujUczestnika');
          self::$router->map('GET', 'rejestracja-uczestnika-potwierdzenie', array('controller' =>'Rejestracja', 'action' => 'showRegisterConfirmation'), 'pokarzPotwierdzenieRejestracjiUczestnika');

          self::$router->map('GET','logowanie', array('controller' => 'Uzytkownik', 'action' => 'zalogujForm'), 'showLoginForm');
          self::$router->map('POST','logowanie/zaloguj', array('controller' => 'Uzytkownik', 'action' => 'login'), 'zaloguj');
          self::$router->map('GET','logowanie/wyloguj', array('controller' => 'Uzytkownik', 'action' => 'logout'), 'wyloguj');
        }
        return self::$router;

  }
}
