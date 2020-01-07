<?php
namespace Models;

use PDO;

class Szkolenie extends Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function showView()
    {
        $data = array();
        try
        {
            $query = "SELECT id_szkolenie, szkolenie.nazwa, data, godzina, nr_sali, trener.imie AS imieTrener, trener.nazwisko AS nazwiskoTrener,
            status.nazwa AS Status, cena, trener.email AS trenerEmail, szkolenie.opis FROM szkolenie
                      INNER JOIN trener
                      ON trener.id_trener = szkolenie.id_trener
                      	INNER JOIN status
                      	ON status.id_status = szkolenie.id_status
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

            $query = 'SELECT id_szkolenie, szkolenie.nazwa, data, godzina, nr_sali, trener.imie AS imieTrener, trener.nazwisko AS nazwiskoTrener,
            status.nazwa AS Status, cena, szkolenie.opis FROM szkolenie
                      INNER JOIN trener
                      ON trener.id_trener = szkolenie.id_trener
                      	INNER JOIN status
                      	ON status.id_status = szkolenie.id_status
            WHERE id_szkolenie = :id';
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

    public function insert($nazwa, $data, $godzina, $nr_sali, $id_trener, $id_status, $cena, $opis)
    {
        try	{
            $stmt = $this->pdo -> prepare('INSERT INTO `szkolenie` (`nazwa`, `data`, `godzina`, `nr_sali`, `id_trener`, `id_status`, `cena`, `opis`)
                                        VALUES(:nazwa, :data, :godzina, :nr_sali, :id_trener, :id_status, :cena, :opis)');
            $stmt->bindValue(':nazwa', $nazwa, PDO::PARAM_STR);
            $stmt->bindValue(':data', $data, PDO::PARAM_STR);
            $stmt->bindValue(':godzina', $godzina, PDO::PARAM_STR);
            $stmt->bindValue(':nr_sali', $nr_sali, PDO::PARAM_STR);
            $stmt->bindValue(':id_trener', $id_trener, PDO::PARAM_INT);
            $stmt->bindValue(':id_status', $id_status, PDO::PARAM_INT);
            $stmt->bindValue(':cena', $cena, PDO::PARAM_STR);
            $stmt->bindValue(':opis', $opis, PDO::PARAM_STR);
            $stmt->execute();
        } catch(\PDOException $e) {
            d($e);
            echo "Blad dodawania do tabeli szkolenie";
        }
    }

    public function showPresence($id)
    {
        $data = array();
        try
        {
            $query = "SELECT * FROM `szkolenie_uczestnik`
	                    INNER JOIN uczestnik
                            ON uczestnik.id_uczestnik = szkolenie_uczestnik.id_uczestnik
                            INNER JOIN szkolenie
                                ON szkolenie.id_szkolenie = szkolenie_uczestnik.id_szkolenie
                                    WHERE szkolenie_uczestnik.id_szkolenie = '$id'
        	";

            $stmt = $this->pdo->query($query);
            //d($stmt);
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

    public function zapiszObecnosc($id_szkolenie_uczestnik, $obecnosc)
    {
        try	{
            $q = 'UPDATE szkolenie_uczestnik SET `obecnosc` =:obecnosc
                WHERE `id_szkolenie_uczestnik` =:id_szkolenie_uczestnik ';
            $stmt = $this->pdo->prepare($q);
            //$stmt = $this->pdo->prepare('UPDATE szkolenie_uczestnik SET obecnosc =:obecnosc WHERE id_szkolenie_uczestnik =:id_szkolenie_uczestnik ');
            $stmt->bindValue(':id_szkolenie_uczestnik', $id_szkolenie_uczestnik, PDO::PARAM_INT);
            $stmt->bindValue(':obecnosc', $obecnosc, PDO::PARAM_INT);
            $stmt->execute();
        } catch(\PDOException $e) {
            d($e);
            echo "Blad dodawania do tabeli szkolenie";
        }
    }

    public function zmienObecnosc($id, $obecnosc)
    {
        try	{
            $q = 'UPDATE szkolenie_uczestnik SET `obecnosc` =:obecnosc
                WHERE `id_szkolenie_uczestnik` =:id ';
            $stmt = $this->pdo->prepare($q);
            //$stmt = $this->pdo->prepare('UPDATE szkolenie_uczestnik SET obecnosc =:obecnosc WHERE id_szkolenie_uczestnik =:id_szkolenie_uczestnik ');
            $stmt->bindValue(':id', $id, PDO::PARAM_INT);
            $stmt->bindValue(':obecnosc', $obecnosc, PDO::PARAM_INT);
            //d($obecnosc);
            $stmt->execute();
        } catch(\PDOException $e) {
            d($e);
            echo "Blad dodawania do tabeli szkolenie";
        }
    }
}
