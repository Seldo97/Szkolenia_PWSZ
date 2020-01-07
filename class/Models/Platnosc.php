<?php
namespace Models;

use PDO;

class Platnosc extends Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function showView($id = null)
    {
        $data = array();
        try	{

            $query = "SELECT id_platnosc, CONCAT(U.imie,' ',U.drugie_imie,' ',U.nazwisko) AS uczestnik,
                            S.nazwa AS szkolenie, termin_platnosci AS termin, kwota, zaksiegowano, data_zaksiegowania
                      FROM platnosc AS P INNER JOIN szkolenie_uczestnik AS SU ON SU.id_szkolenie_uczestnik = P.id_szkolenie_uczestnik
						INNER JOIN szkolenie AS S ON S.id_szkolenie = SU.id_szkolenie
                        	INNER JOIN uczestnik AS U ON U.id_uczestnik = SU.id_uczestnik
                            $id";

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

    public function zaksiegujWplate($id, $zaksiegowano, $data_zaksiegowania)
    {
        try	{
            $query = 'UPDATE platnosc SET '
            .'zaksiegowano = :zaksiegowano,'
            .'data_zaksiegowania = :data_zaksiegowania
              WHERE id_platnosc = :id';

            $stmt = $this->pdo->prepare($query);
            $stmt->bindValue(':zaksiegowano', $zaksiegowano, PDO::PARAM_STR);
            $stmt->bindValue(':data_zaksiegowania', $data_zaksiegowania, PDO::PARAM_STR);
            $stmt->bindValue(':id', $id, PDO::PARAM_STR);


            $stmt->execute();

            $stmt->closeCursor();

        } catch(\PDOException $e) {
            echo 'Połączenie nie mogło zostać utworzone: ' . $e->getMessage();
            d($e);
        }
    }

    public function dodajPlatnosc($id_szkolenie_uczestnik, $termin_platnosci, $kwota)
    {
        try	{
            $query = 'INSERT INTO platnosc( id_szkolenie_uczestnik, termin_platnosci, kwota)
            VALUES '.'(:id_szkolenie_uczestnik, :termin_platnosci, :kwota)';

            $stmt = $this->pdo->prepare($query);
            $stmt->bindValue(':id_szkolenie_uczestnik', $id_szkolenie_uczestnik, PDO::PARAM_INT);
            $stmt->bindValue(':termin_platnosci', $termin_platnosci, PDO::PARAM_STR);
            $stmt->bindValue(':kwota', $kwota, PDO::PARAM_STR);

            $stmt->execute();

            $stmt->closeCursor();

        } catch(\PDOException $e) {
            echo 'Połączenie nie mogło zostać utworzone: ' . $e->getMessage();
            d($e);
        }
    }


}
