<?php

namespace Controllers;

use Twig\Loader\FilesystemLoader;
use Twig\Environment;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use \Config\Application\Config as cfg;

abstract class Controller
{
    protected $view;
    protected $loader;
    protected $twig;
    protected $url;

    public function __construct(){
        $this->loader = new \Twig_Loader_Filesystem('./Templates');
        $this->twig = new \Twig_Environment($this->loader, ['debug' => true]);
        $this->url = cfg::$tab["protokol"].$_SERVER["SERVER_NAME"]."/".cfg::$tab["path"];

    }

    public function redirect($url)
    {
        if(preg_match('/^http:/', $url) === 1)
            header('location: '.$url);
        else
            header('location: '.cfg::$tab['protokol'].$_SERVER["SERVER_NAME"].'/'.\Config\Application\Config::$tab['path'].$url);
        exit(0);
    }


}
