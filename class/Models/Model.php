<?php

namespace models;
use pdo;

abstract class Model
{

	public $pdo;

    /**
     * Zmienna przechowujaca nazwe tabeli
     * @var String
     */
    protected $name;

    /**
     * nazwa Id tabeli
     * @var String
     */
    protected $idName;

	public function __construct()
	{
        $this->pdo = \Handles\MySQL::getHandle();
        //d($this->pdo);
	}

    /**
     * Usuwanie elementu o podanym id z biezacej tabeli
     * @param  int $id idUsuwanego elementu
     */
    public function deleteOneById($id, $table_name, $table_id_name)
    {
        $liczba = 0;
        try{
            $stmt = $this->pdo->prepare('DELETE FROM `'.$table_name.'` WHERE `'.$table_id_name.'` = :id ');
            $stmt->bindValue(':id', $id, PDO::PARAM_INT);

            $stmt -> execute();
            $liczba = $stmt->rowCount();
            //sprawdzajace wyswietlenie
            $stmt->closeCursor();

            print('Usunieto '.$liczba. ' rekordow');
        }catch(\PDOException $e){
            d($e);
            echo" wystapil blad z usunieciem danych";
        }

    }//koniec metody deleteByOneId()
}
