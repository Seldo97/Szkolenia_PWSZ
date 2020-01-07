<?php
namespace Models;

use PDO;

class ZapisSzkolenie extends Model
{
    public $lastID;
    public function __construct()
    {
        parent::__construct();

    }

    public function save($id_uczestnik, $idszkolenia, $obecnosc)
    {
        try
        {
            $query = "INSERT INTO `szkolenie_uczestnik` (`id_uczestnik`, `id_szkolenie`, `obecnosc`)
            VALUES (:id_uczestnik, :idszkolenia, :obecnosc)";

            $stmt = $this->pdo->prepare($query);
            $stmt->bindValue(':id_uczestnik', $id_uczestnik, PDO::PARAM_INT);
            $stmt->bindValue(':idszkolenia', $idszkolenia, PDO::PARAM_INT);
            $stmt->bindValue(':obecnosc', $obecnosc, PDO::PARAM_INT);
            $stmt->execute();
            $this->lastID = $this->pdo->lastInsertId();
            $stmt->closeCursor();
        }
        catch(\PDOException $e)
        {
            d($e);
            echo 'Błąd dodawania do tabeli szkolenie_uczestnik';
        }
    }


}
