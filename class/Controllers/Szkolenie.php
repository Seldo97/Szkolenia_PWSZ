<?php

namespace Controllers;
use Models\Szkolenie as S;
use Models\Trener as T;

class Szkolenie extends Controller
{

	protected $model;

	public function __construct()
	{
		parent::__construct();
		$this->model = new \Models\Szkolenie;
	}

	public function showView()
	{
		$trener = new T();
		$daneTrenera = $trener->showView();
		$daneSzkolenia = $this->model->showView();
		return $this->twig->render('Szkolenia/tabelaSzkolenia.html.twig', [
									'szkolenie' =>$daneSzkolenia,
									'trenerzy' => $daneTrenera,
									'url' => $this->url,
									'sesja' => $_SESSION]);
	}

	public function insert()
	{
		$nazwa = $_POST["nazwa"];
		$data = $_POST["data"];
		$godzina = $_POST["godzina"];
		$nr_sali = $_POST["nr_sali"];
		$id_trener = $_POST["id_trener"];
		$id_status = $_POST["id_status"];
		$cena = $_POST["cena"];
		$opis = $_POST["opis"];

		$szkolenie = new S();
		if(isset($_POST["nazwa"]) && isset($_POST["data"]) && isset($_POST["godzina"]) && isset($_POST["nr_sali"]) && isset($_POST["id_trener"])
			&& isset($_POST["id_status"]) && isset($_POST["cena"]) && isset($_POST["opis"])){

			$szkolenie->insert($nazwa, $data, $godzina, $nr_sali, $id_trener, $id_status, $cena, $opis);
			parent::redirect("szkolenia");
		}
		else{
			parent::redirect("szkolenia");
		}
	}

	public function delete($id)
	{
		$szkolenie = new S();
		$szkolenie->deleteOneById($id, "szkolenie", "id_szkolenie");

		parent::redirect("szkolenia");
	}

	public function showPresence($id)
	{
		$daneUczestnika = $this->model->showPresence($id);
		return $this->twig->render( 'Szkolenia/tabelaSzkoleniaObecnosc.html.twig', [
			'uczestnicy' =>$daneUczestnika,
			'url' => $this->url,
			'sesja' => $_SESSION]);

	}

	public function zapiszObecnosc()
	{
	    $szkolenie = new S();
        d($_POST['lista_uczestnik']);
        d($_POST['lista_obecnosc']);
        if(!empty($_POST['lista_uczestnik']))
        {
            foreach($_POST['lista_uczestnik'] as $key=>$uczestnik)
            {
                echo $_POST['lista_obecnosc'][$key];
                $szkolenie->zapiszObecnosc($uczestnik, $_POST['lista_obecnosc'][$key]);
            }
        }

        parent::redirect("szkolenia");
	}

    public function zmienObecnoscTak($id)
    {
        $szkolenie = new S();
        $szkolenie->zmienObecnosc( $id,1);

        $this->redirect($_SERVER['HTTP_REFERER']);
    }

    public function zmienObecnoscNie($id)
    {
        $szkolenie = new S();
        $szkolenie->zmienObecnosc($id,0);

        $this->redirect($_SERVER['HTTP_REFERER']);
    }
    
        public function createForm($id){
        $trener = new T();
		$daneTrenera = $trener->showView();
        $szkolenie = new S();
        $daneSzkolenie = $szkolenie->selectOneById($id);
        //d($daneSzkolenie);
         return $this->twig->render('Szkolenia/szkoleniaUpdate.html.twig', ['id' => $id,'szkolenie' =>$daneSzkolenie[0], 'url' => $this->url,
			'sesja' => $_SESSION, 'trenerzy' => $daneTrenera,]);
    }
    
        public function update(){
		$nazwa = $_POST["nazwa"];
		$data = $_POST["data"];
		$godzina = $_POST["godzina"];
		$nr_sali = $_POST["nr_sali"];
		$id_trener = $_POST["id_trener"];
		$id_status = $_POST["id_status"];
		$cena = $_POST["cena"];
		$opis = $_POST["opis"];
        $id = $_POST["id"];

        $szkolenie = new S();
        if(isset($_POST["nazwa"]) && isset($_POST["nr_sali"]) && isset($_POST["cena"])
        && (trim($_POST["nazwa"]!="")) && (trim($_POST["cena"]!=""))
        && (trim($_POST["nr_sali"]!=""))){

            $szkolenie->update($nazwa, $data, $godzina, $nr_sali, $id_trener, $id_status, $cena, $opis, $id);
            $daneSzkolenie = $szkolenie->showView();
            parent::redirect("szkolenia");

        }else{

            $daneDostawca = $dostawca->selectOneById($id);
            return $this->twig->render('Szkolenia/szkoleniaUpdate.html.twig', ['id' => $id,'szkolenie' =>$daneSzkolenie[0], 'url' => $this->url,
			'sesja' => $_SESSION, 'trenerzy' => $daneTrenera,]);
        }
    }
}
