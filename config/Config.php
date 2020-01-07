<?php
    namespace Config;

    class Config
    {

        public static $dir = './';
        public static $file = 'conf.ini';

        public static function wczytaj($section)
        {
            $class = get_called_class();
            $ini_array = parse_ini_file(self::$dir . self::$file, true, INI_SCANNER_TYPED);
            //print_r($ini_array[$section]);
            if(isset($ini_array[$section]))
            {
                foreach ($ini_array[$section] as $key => $value)
                    $class::$tab[$key] = $value;
            }
        }
    }
