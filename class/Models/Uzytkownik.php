<?php
namespace Models;
use PDO;

class Uzytkownik extends Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function login($login, $password)
    {
        // pobranbie hasha z bazy
        $pdo = \Handles\MySQL::getHandle();
        $query = 'SELECT * FROM uzytkownik WHERE login = :login';
        $stmt = $pdo->prepare($query);
        $stmt->bindValue(':login', $login, PDO::PARAM_STR);
        $stmt->execute();
        $user_data = $stmt->fetch(PDO::FETCH_ASSOC);
        // !d($user_data);

        if(isset($user_data['login']))
        {   // Poprawne zalogowanie się użytkownika
            if($this->checkPassword($password, $user_data['haslo']))
            {   //zainicjalizowanie sesji
                \Tools\Access::login(
                    $login,
                    $user_data['id'],
                    $user_data['email'],
                    $user_data['id_uprawnienia']
                );
                return true;
            }
        }
        return false;
    }
    /**
     * Sprawdza zgodność hasła i jego powtórzenia
     */
    public function checkPassword($input, $hash)
    {
        return password_verify($input, $hash);
    }

    /**
     * Wylogowanie użytkownika z systemu
     */
    public function logout()
    {
        \Tools\Access::logout();
    }


}
