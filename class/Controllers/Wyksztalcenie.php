<?php

namespace Controllers;

class Wyksztalcenie extends Controller
{

    protected $model;

    public function __construct()
    {
        parent::__construct();
        $this->model = new \Models\Wyksztalcenie;
    }

    // public function showView()
    // {
    //     $daneUczestnika = $this->model->showView();
    //     return $this->twig->render( 'Uczestnik/tabelaUczestnik.html.twig', [
    //                                 'uczestnik' =>$daneUczestnika,
    //                                 'url' => $this->url] );
    //
    // }
}
