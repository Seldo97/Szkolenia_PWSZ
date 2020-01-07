<?php

namespace Controllers;

class Platnosc extends Controller
{

    protected $model;

    public function __construct()
    {
        parent::__construct();
        $this->model = new \Models\Platnosc;
    }

    public function showView()
    {
        $danePlat = $this->model->showView();
        return $this->twig->render( 'Platnosc/tabelaPlat.html.twig', [
                                    'platnosci' => $danePlat,
                                    'url' => $this->url,
                                    'sesja' => $_SESSION] );
    }

    public function zaksiegujWplate($id)
    {
        $d=strtotime("+1 Months");
        $data_zaksiegowania = date("Y-m-d");
        $this->model->zaksiegujWplate($id, 1, $data_zaksiegowania);
        //$this->model->dodajPlatnosc('5', date("Y-m-d", $d), '200');
        $this->redirect($_SERVER['HTTP_REFERER']);
    }

}
