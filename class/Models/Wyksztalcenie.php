<?php
namespace Models;

use PDO;

class Wyksztalcenie extends Model
{

    public function __construct()
    {
        $this->table = 'wyksztalcenie';
        parent::__construct();
    }

    public function showView()
    {
        $data = array();
        try
        {
            $query = "SELECT * FROM " .$this->table;
            $stmt = $this->pdo->prepare($query);
            if($stmt->execute())
            {
                $data = $stmt->fetchAll();
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

            $query = 'SELECT * FROM '.$this->table. 'WHERE id_wyksztalcenie = :id';
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

    public function selectAllRecords()
    {
        try
        {
            $query = "SELECT * FROM Wyksztalcenie;";
            $stmt = $this->pdo->query($query);
            foreach($stmt as $row)
                $data[] = $row;
            $stmt->closeCursor();
            return $data;
        }
        catch(\PDOException $e)
        {
            echo 'Błąd zapytania: ' . $e->getMessage();
            d($e);
        }
        return array();
    }
}
