<?php
namespace Models;
use PDO;

class Rejestracja extends Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function registerParticipant()
    {
        try
        {
            // Tabela Uzytkownik
            $data_1 = [
                'id_uzytkownik' => NULL,
                'login' => $_POST['login'],
                'haslo' => password_hash($_POST['haslo'], PASSWORD_DEFAULT),
                'email' => $_POST['email'],
                'id_uprawnienia' => 1
            ];

            $query_1 = "
                INSERT INTO uzytkownik
                (id_uzytkownik, login, haslo, email, id_uprawnienia)
                VALUES (:id_uzytkownik, :login, :haslo, :email, :id_uprawnienia);
            ";

            // Tabela Uczestnik
            $data_2 = [
                'id_uczestnik' => 'NULL',
                'imie' => $_POST['imie'],
                'drugie_imie' => $_POST['drugie_imie'],
                'nazwisko' => $_POST['nazwisko'],
                'data_urodzenia' => $_POST['data_urodzenia'],
                'email' => $_POST['email'],
                'telefon' => $_POST['telefon'],
                'id_wyksztalcenie' => $_POST['id_wyksztalcenie']
            ];

            $query_2 = "
                INSERT INTO uczestnik
                (`id_uczestnik`, `imie`, `drugie_imie`, `nazwisko`, `data_urodzenia`, `email`, `telefon`, `id_wyksztalcenie`)
                VALUES (:id_uczestnik, :imie, :drugie_imie, :nazwisko, :data_urodzenia, :email, :telefon, :id_wyksztalcenie);
            ";

            $pdo = \Handles\MySQL::getHandle();
            $pdo->query("SET autocommit = 0");
            $pdo->beginTransaction();

            $stmt = $pdo->prepare($query_1);
            $stmt->execute($data_1);

            $stmt = $pdo->prepare($query_2);
            $stmt->execute($data_2);

            $pdo->commit();
            // $stmt->closeCursor();
            return 1;
        }
        catch(\PDOException $e)
        {
            $pdo->rollback();
            echo 'Błąd zapytania: ' . $e->getMessage();
            d($e);
        }
    }
}
