<?php
namespace Tools;

class Session
{
    private static $active 	         = 'active';
    private static $session_name     = 'session_name';
    private static $session_id 	     = 'session_id';
	private static $ip 	             = 'ip';
	private static $browser          = 'browser';
	private static $startTime        = 'time';
	private static $reqCount         = 'request';

	// czas, po którym nastapi regeneracji identyfikatora sesji [sek]
	private static $regenerateTime = 10;
	// licznik zapytań, po którym nastąpi regeneracja identyfikatora sesji
	private static $regenerateRequest = 10;

    private function __construct() {}

    public static function init()
    {
    	self::$regenerateTime = \Config\Application\Session::$regenerateTime;
    	self::$regenerateRequest = \Config\Application\Session::$regenerateRequest;
    }

    //rozpoczęcie lub odtworzenie sesji
	public static function initialize()
    {
		self::start();
		if(self::is(self::$active) === true)
        {
			self::set(self::$reqCount, self::get(self::$reqCount) + 1);
			self::check();
		}
		else
        {
			self::set(self::$active,         	true);
            self::set(self::$session_name, 	    self::name());
            self::set(self::$session_id, 	    session_id());
        	self::set(self::$ip, 	        	$_SERVER['REMOTE_ADDR']);
			self::set(self::$browser,        	$_SERVER['HTTP_USER_AGENT']);
			self::set(self::$startTime,         time());
			self::set(self::$reqCount, 	        1);
		}
	}

    //rozpoczęcie lub odtworzenie sesji
	public static function start()
    {
		session_set_cookie_params(
            0,                                                      // lifetime
            '/'.\Config\Application\Config::getValue('path')        // path
        );
		session_start();
	}

    //sprawdzenie stanu sesji
	public static function check()
    {
		$error = false;
		//adres IP
		if(self::get(self::$ip) !== $_SERVER['REMOTE_ADDR'])
			$error = true;
		//user-agent przeglądraki
		if(self::get(self::$browser) !== $_SERVER['HTTP_USER_AGENT'])
			$error = true;
		//inne ewentualne testy
		if($error === true)
        {
			self::destroy();
			//die('Proba przejecia sesji!');
			return false;
		}
		$now = time();
		if ($now > self::get(self::$startTime) + self::$regenerateTime
		          || self::get(self::$reqCount) > self::$regenerateRequest)
		{
            self::regenerate();
		}
		return true;
	}

    //zniszczenie sesji
	public static function destroy()
    {
		self::clearAll();
		if (self::is($_COOKIE[session_name()]))
			setcookie(session_name(), '', time()-42000, '/');
		session_destroy();
	}

    //nadanie nazwy sesji, domyślnie jest to PHPSESSID
	public static function name($name = null)
    {
		if($name !== null)
			return session_name($name);
		else
			return session_name();
	}

    //zmiana identyfikatora sesji
	public static function regenerate()
    {
		session_regenerate_id();
        self::set(self::$session_name, 	    self::name());
        self::set(self::$session_id, 	    session_id());
		self::set(self::$startTime,         time());
		self::set(self::$reqCount,          1);
	}

    //ustawienie zmiennej sesyjnej
	public static function set($name, $value)
    {
		$_SESSION[$name] = $value;
	}

    //pobranie zmiennej sesyjnej
	public static function get($name)
    {
		if(self::is($name))
			return $_SESSION[$name];
		else
			return null;
	}

    //sprawdzenie czy zmienna sesyjna jest ustawiona
	public static function is($name)
    {
		return isset($_SESSION[$name]);
	}

    //wyczyszczenie zmiennej sesyjnej
	public static function clear($name)
    {
		unset($_SESSION[$name]);
	}

    //wyczyszczenie	zmiennych w sesji
	public static function clearAll()
    {
		$_SESSION = array();
	}
}

Session::init();
