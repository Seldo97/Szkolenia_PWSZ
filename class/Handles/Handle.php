<?php
    namespace Handles;

    abstract class Handle
    {
        protected $pdo;
        protected static $singletons = array();

        protected function __construct() {}
        protected function __clone() {}

        public static function getSingleton()
        {
            $className = get_called_class();
            if(!isset(self::$singletons[$className]) || self::$singletons[$className] === null){
                self::$singletons[$className] = new $className();
            }
            return self::$singletons[$className];
        }

        public static function  getHandle()
        {
            $className = get_called_class();
            $singleton = $className::getSingleton();
            if(isset($singleton) && $singleton->pdo != null){
                return $className::getSingleton()->pdo;
            }
            throw new \Exceptions\DatabaseConnection();
        }
    }
