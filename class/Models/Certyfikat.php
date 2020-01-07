<?php
namespace Models;

use PDO;

class Certyfikat extends Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function showView($id = null)
    {
        $data = array();
        try	{

            $query = "SELECT id_certyfikat, CONCAT(C.id_certyfikat,'/',S.id_szkolenie,'/',YEAR(data_wystawienia)) AS id ,CONCAT(U.imie,' ',U.drugie_imie,' ',U.nazwisko) AS uczestnik,
                                S.nazwa AS szkolenie, S.data AS data, SU.obecnosc AS obecnosc, C.opis AS opis
                      FROM certyfikat AS C INNER JOIN szkolenie_uczestnik AS SU ON SU.id_szkolenie_uczestnik = C.id_szkolenie_uczestnik
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

    public function dodajCertyfikat($id_szkolenie_uczestnik, $data_wystawienia, $opis)
    {
        try	{
            $query = 'INSERT INTO certyfikat(id_szkolenie_uczestnik, data_wystawienia, opis)
            VALUES '.'(:id_szkolenie_uczestnik, :data_wystawienia, :opis)';

            $stmt = $this->pdo->prepare($query);
            $stmt->bindValue(':id_szkolenie_uczestnik', $id_szkolenie_uczestnik, PDO::PARAM_INT);
            $stmt->bindValue(':data_wystawienia', $data_wystawienia, PDO::PARAM_STR);
            $stmt->bindValue(':opis', $opis, PDO::PARAM_STR);

            $stmt->execute();

            $stmt->closeCursor();

        } catch(\PDOException $e) {
            echo 'Połączenie nie mogło zostać utworzone: ' . $e->getMessage();
            d($e);
        }
    }


}
