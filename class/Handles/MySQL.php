<?php
    namespace Handles;

    use Config\Database\MySQL as sqlCnf;
    use PDO;

    class MySQL extends Handle
    {
        protected function __clone() {}
        protected function __construct()
        {
            try{
                $this->pdo = new PDO(
                    sqlCnf::$tab['type'].
                    ':host='.sqlCnf::$tab['host'].
                    ';dbname='.sqlCnf::$tab['database'].
                    ';charset=utf8' .
                    ';port='.sqlCnf::$tab['port'],
                    sqlCnf::$tab['user'],
                    sqlCnf::$tab['password']
                    );
                $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            } catch(\PDOException $e) {
                $this->pdo = null;
                throw new \Exceptions\DatabaseConnection($e);
            }
        }
    }
