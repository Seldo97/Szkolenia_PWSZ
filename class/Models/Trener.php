<?php
namespace Models;

use PDO;

class Trener extends Model{
    public function __construct()
    {
        parent::__construct();
    }

    public function showView()
    {
        $data = array();
        try
        {
            $query = "SELECT * FROM trener";
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
}