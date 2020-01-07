<?php
namespace Models;

use PDO;

class Uczestnik extends Model
{

    public function __construct()
    {
        $this->table = 'uczestnik';
        parent::__construct();
    }

    public function showView()
    {
        $data = array();
        try
        {
            $query = "SELECT `id_uczestnik`, `imie`, `drugie_imie`, `nazwisko`, `data_urodzenia`, `email`, `telefon`,
            wyksztalcenie.id_wyksztalcenie AS wyksztalcenie, wyksztalcenie.nazwa AS nazwa
            FROM `uczestnik`
                INNER JOIN wyksztalcenie
                ON wyksztalcenie.id_wyksztalcenie = uczestnik.id_wyksztalcenie
            ";
            $stmt = $this->pdo->query($query);

            foreach($stmt as $row) {
                $data[] = $row;
            }

            $stmt->closeCursor();

        } catch(\PDOException $e) {
            echo 'Błąd zapytania: ' . $e->getMessage();
            d($e);
        }
        //d($data);
        return $data;
    }

    public function selectOneById($id)
    {
        $data = array();
        try	{

            $query = 'SELECT `id_uczestnik`, `imie`, `drugie_imie`, `nazwisko`, `data_urodzenia`, `email`, `telefon`,
            wyksztalcenie.id_wyksztalcenie AS wyksztalcenie, wyksztalcenie.nazwa AS nazwa
            FROM `uczestnik`
                    INNER JOIN wyksztalcenie
                    ON wyksztalcenie.id_wyksztalcenie = uczestnik.id_wyksztalcenie
            WHERE id_uczestnik = :id';
            $stmt = $this->pdo->prepare($query);
            $stmt->bindValue(':id', $id, PDO::PARAM_INT);

            if($stmt->execute()) {
                $data = $stmt->fetchAll();
            }

            $stmt->closeCursor();

        } catch(\PDOException $e) {
            echo 'Połączenie nie mogło zostać utworzone: ' . $e->getMessage();
            d($e);
        }
        //d($data);
        return $data;
    }

    public function update($Id, $imie, $drugie_imie, $nazwisko, $data_urodzenia, $email, $telefon, $wyksztalcenie)
    {
        try
        {
            $query = 'UPDATE `'.$this->table.'`
            SET `imie` = :imie,
                `drugie_imie` = :drugie_imie,
                `nazwisko` = :nazwisko,
                `data_urodzenia` = :data_urodzenia,
                `email` = :email,
                `telefon` = :telefon,
                `id_wyksztalcenie` = :wyksztalcenie
            WHERE `id_uczestnik` = :Id ';
            $stmt = $this->pdo->prepare($query);
            $stmt->bindValue(':Id', $Id, PDO::PARAM_INT);
            $stmt->bindValue(':imie', $imie, PDO::PARAM_STR);
            $stmt->bindValue(':drugie_imie', $drugie_imie, PDO::PARAM_STR);
            $stmt->bindValue(':nazwisko', $nazwisko, PDO::PARAM_STR);
            $stmt->bindValue(':data_urodzenia', $data_urodzenia, PDO::PARAM_STR);
            $stmt->bindValue(':email', $email, PDO::PARAM_STR);
            $stmt->bindValue(':telefon', $telefon, PDO::PARAM_STR);
            $stmt->bindValue(':wyksztalcenie', $wyksztalcenie, PDO::PARAM_INT);
            $stmt->execute();
            $stmt->closeCursor();
        }
        catch(\PDOException $e)
        {
            echo 'coś nie działa';
            //throw new \Exceptions\Query($e);
        }
    }



}
