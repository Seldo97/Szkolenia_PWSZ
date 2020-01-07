<?php
    namespace Config\Application;

    use Config\Config as MainConfig;

    class Config extends MainConfig
    {
        public static $tab = null;

        public static function infConf()
        {
            d(self::$tab);
        }

        public static function getValue($key)
        {
            return self::$tab[$key];
        }
    }
Config::wczytaj('Application');
