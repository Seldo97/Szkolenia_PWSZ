<?php

namespace Controllers;

class ZapisSzkolenie extends Controller
{

    protected $model;

    public function __construct()
    {
        parent::__construct();
    }

    public function showView($id)
    {
        $szkolenie = new \Models\Szkolenie();
        $daneSzkolenia = $szkolenie->selectOneById($id);

        $uczestnik = new \Models\Uczestnik();
        $daneUczestnika['data'] = $uczestnik->showView();

        return $this->twig->render( 'Szkolenia/zapisSzkolenie.html.twig', [
                                    'szkolenie' => $daneSzkolenia[0],
                                    'uczestnik' => $daneUczestnika['data'],
                                    'url' => $this->url,
                                    'sesja' => $_SESSION]);
    }

    public function zapisz_sie()
    {

            if(isset($_POST['idszkolenia'])
                && isset($_POST['id_uczestnik'])
                && isset($_POST['obecnosc'])
                && isset($_POST['cena']) )
            {
                    $idszkolenia = $_POST['idszkolenia'];
                    $id_uczestnik = $_POST['id_uczestnik'];
                    $obecnosc = $_POST['obecnosc'];
                    $cena = $_POST['cena'];
                    //d($_POST);
                    $model = new \Models\ZapisSzkolenie();
                    $model->save($id_uczestnik, $idszkolenia, $obecnosc);

                    $platnosc = new \Models\Platnosc();
                    $platnosc->dodajPlatnosc($model->lastID, date("Y-m-d", strtotime("+1 Months")), $cena);

                    $certyfikat = new \Models\Certyfikat();
                    $certyfikat->dodajCertyfikat($model->lastID, date("Y-m-d", strtotime("+1 Months")), 'jakis opisek');
                    //echo 'Dodało :)';
                    $this->redirect('szkolenia');
            }
            else
            {

                echo 'Nie dodało!';
            }
    }
}
