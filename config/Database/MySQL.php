<?php
    namespace Config\Database;

    use Config\Config as Config;

    class MySQL extends Config
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
MySQL::wczytaj('MySQL');
