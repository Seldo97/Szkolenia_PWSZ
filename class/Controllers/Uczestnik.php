<?php

namespace Controllers;

class Uczestnik extends Controller
{

    protected $model;

    public function __construct()
    {
        parent::__construct();
        $this->model = new \Models\Uczestnik();
    }

    public function showView()
    {
        $daneUczestnika = $this->model->showView();
        return $this->twig->render( 'Uczestnik/tabelaUczestnik.html.twig', [
                                    'uczestnik' =>$daneUczestnika,
                                    'url' => $this->url,
                                    'sesja' => $_SESSION]);

    }

    public function updateView($id)
    {
        $wyksztalcenie = new \Models\Wyksztalcenie();
        $daneWyksztalcenie['data'] = $wyksztalcenie->showView();

        $daneUczestnika = $this->model->selectOneById($id);
        return $this->twig->render( 'Uczestnik/UczestnikEdit.html.twig', [
                                    'id' => $id,
                                    'uczestnik' =>$daneUczestnika[0],
                                    'wyksztalcenie' => $daneWyksztalcenie['data'],
                                    'url' => $this->url,
                                    'sesja' => $_SESSION]);
    }


    public function update($Id)
    {
        if(isset($_POST['imie'])
            && isset($_POST['drugie_imie'])
            && isset($_POST['nazwisko'])
            && isset($_POST['data_urodzenia'])
            && isset($_POST['email'])
            && isset($_POST['telefon'])
            && isset($_POST['wyksztalcenie']) )
        {
            //d($_POST);
            $imie = $_POST['imie'];
            $drugie_imie = $_POST['drugie_imie'];
            $nazwisko = $_POST['nazwisko'];
            $data_urodzenia = $_POST['data_urodzenia'];
            $email = $_POST['email'];
            $telefon = $_POST['telefon'];
            $wyksztalcenie = $_POST['wyksztalcenie'];
            //d($_POST);
        $model = new \Models\Uczestnik();
        $model->update($Id, $imie, $drugie_imie, $nazwisko, $data_urodzenia, $email, $telefon, $wyksztalcenie);
        //echo 'Dodało :)';
        $this->redirect('uczestnik');
        }
    }

}
