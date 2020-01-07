<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitc26e13a8270838083171d7620bc383de
{
    public static $files = array (
        '0e6d7bf4a5811bfa5cf40c5ccd6fae6a' => __DIR__ . '/..' . '/symfony/polyfill-mbstring/bootstrap.php',
        '3917c79c5052b270641b5a200963dbc2' => __DIR__ . '/..' . '/kint-php/kint/init.php',
    );

    public static $prefixLengthsPsr4 = array (
        'T' => 
        array (
            'Twig\\Extensions\\' => 16,
        ),
        'S' => 
        array (
            'Symfony\\Polyfill\\Mbstring\\' => 26,
        ),
        'M' => 
        array (
            'Message\\' => 8,
        ),
        'K' => 
        array (
            'Kint\\' => 5,
        ),
        'C' => 
        array (
            'Config\\' => 7,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Twig\\Extensions\\' => 
        array (
            0 => __DIR__ . '/..' . '/twig/extensions/src',
        ),
        'Symfony\\Polyfill\\Mbstring\\' => 
        array (
            0 => __DIR__ . '/..' . '/symfony/polyfill-mbstring',
        ),
        'Message\\' => 
        array (
            0 => __DIR__ . '/../..' . '/message',
        ),
        'Kint\\' => 
        array (
            0 => __DIR__ . '/..' . '/kint-php/kint/src',
        ),
        'Config\\' => 
        array (
            0 => __DIR__ . '/../..' . '/config',
        ),
    );

    public static $fallbackDirsPsr4 = array (
        0 => __DIR__ . '/../..' . '/class',
    );

    public static $prefixesPsr0 = array (
        'T' => 
        array (
            'Twig_Extensions_' => 
            array (
                0 => __DIR__ . '/..' . '/twig/extensions/lib',
            ),
            'Twig_' => 
            array (
                0 => __DIR__ . '/..' . '/twig/twig/lib',
            ),
        ),
    );

    public static $classMap = array (
        'AltoRouter' => __DIR__ . '/..' . '/altorouter/altorouter/AltoRouter.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitc26e13a8270838083171d7620bc383de::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitc26e13a8270838083171d7620bc383de::$prefixDirsPsr4;
            $loader->fallbackDirsPsr4 = ComposerStaticInitc26e13a8270838083171d7620bc383de::$fallbackDirsPsr4;
            $loader->prefixesPsr0 = ComposerStaticInitc26e13a8270838083171d7620bc383de::$prefixesPsr0;
            $loader->classMap = ComposerStaticInitc26e13a8270838083171d7620bc383de::$classMap;

        }, null, ClassLoader::class);
    }
}