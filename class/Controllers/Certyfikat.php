<?php

namespace Controllers;

class Certyfikat extends Controller
{

    protected $model;

    public function __construct()
    {
        parent::__construct();
        $this->model = new \Models\Certyfikat;
    }

    public function showView()
    {
        $daneCert = $this->model->showView();
        return $this->twig->render( 'Certyfikat/tabelaCert.html.twig', [
                                    'certyfikaty' =>$daneCert,
                                    'url' => $this->url,
                                    'sesja' => $_SESSION]);
    }

    public function generujCert($id)
    {

        $daneCert = $this->model->showView("WHERE id_certyfikat = $id");
        //d($daneCert);
        return $this->twig->render( 'Certyfikat/podgladPDF.html.twig', [
                                    'certyfikaty' => $daneCert[0],
                                    'url' => $this->url,
                                    'sesja' => $_SESSION]);
        //$this->redirect($_SERVER['HTTP_REFERER']);
    }

}
