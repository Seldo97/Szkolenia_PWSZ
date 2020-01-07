<?php
namespace Controllers;

class Rejestracja extends Controller
{
    protected $model;

    public function __construct()
    {
        parent::__construct();
        //$this->model = new \Models\Rejestracja;
    }

    public function showFormRegister()
    {
        $model_Wyksztalcenie = new \Models\Wyksztalcenie();
        $modeldata_Wyksztalcenie = $model_Wyksztalcenie->selectAllRecords();

        return $this->twig->render(
            'Rejestracja/uczestnik.html.twig',
            [
                "wyksztalcenie" => $modeldata_Wyksztalcenie,
                'sesja' => $_SESSION
            ]
        );
    }

    public function registerParticipant()
    {
        try
        {
            $model_Rejestracja = new \Models\Rejestracja();
            $model_Rejestracja->registerParticipant();
            $this->redirect('rejestracja-uczestnika-potwierdzenie');
        }
        catch(\Exception $e)
        {
            echo 'Błąd:' . $e->getMessage();
            d($e);
        }
    }

    public function showRegisterConfirmation()
    {
        return $this->twig->render(
            'Rejestracja/potwierdzenie.html.twig',
            array()
        );
    }
}
