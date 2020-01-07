<?php
namespace Controllers;

class Strona_glowna extends Controller
{
    public function showView()
    {
        return $this->twig->render('Strona_glowna/strona_glowna.html.twig', ['sesja' => $_SESSION]);
    }
}
