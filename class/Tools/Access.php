<?php
namespace Tools;
use PhpRbac\Rbac;

/**
 * Klasa do obsługi sesji z logowaniem
 */
class Access extends Session
{
	// klucze sesji
	public  static 	$login 		= 'login';
	public  static 	$id 		= 'id';
	public  static 	$email 		= 'email';
	public  static 	$id_uprawnienia = 'id_uprawnienia';
	private static 	$loginTime 	= 'loginTime';
	// czas, po którym nastapi wylogowanie [sek]
	private static  $sessionTime = 10;

    private function __construct() {}

	public static function init()
    {
		self::$sessionTime = \Config\Application\Session::$sessionTime;
	}

	/**
	 * Logowanie
	 * @param  string $login 				login użytkownika
	 * @param  string $name  				nazwisko użytkownika
	 * @param  int $id    					identyfikator użytkownika
	 * @param  string $email    			mail użytkownika
	 * @param  int $id_uprawnienia    		id_uprawnienia użytkownika
	 */
	public static function login($login, $id, $email, $id_uprawnienia)
    {
		// sprawdzenie istniejącej sesji
		if(parent::check() === true)
		{  // zmieniając poziom dostępu regenerujemy sesję
			parent::regenerate();
			parent::set(self::$login,     $login);
			parent::set(self::$id,        $id);
			parent::set(self::$email,        $email);
			parent::set(self::$id_uprawnienia,        $id_uprawnienia);
			parent::set(self::$loginTime, time());
		}
	}

	// wyloguj
	public static function logout()
    {
		parent::clear(self::$login);
		parent::clear(self::$id);
		parent::clear(self::$email);
		parent::clear(self::$id_uprawnienia);
		parent::clear(self::$loginTime);
		parent::regenerate();
	}

	// sprawdź czy jest zalogowany
	public static function islogin()
    {
		if(parent::is(self::$login) === true)
        {
			if(time() > parent::get(self::$loginTime) + self::$sessionTime)
            {   // przekroczono czas sesji, wyloguj
				self::logout();
				return false;
			}
			parent::set(self::$loginTime, time());
			return true;
		}
		return false;
	}
}

Access::init();
