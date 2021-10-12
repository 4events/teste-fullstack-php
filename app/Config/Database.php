<?php

namespace App\Config;

use PDO;

class Database
{

    const DB_HOST = "127.0.0.1";
    const DB_NAME = "teste_fullstack_php";
    const DB_USER = "teste_fullstack_php";
    const DB_PASS = ".srXmB.9FyJTBH)E";

    /**
     * @var PDO
     */
    private $stmt;

    /**
     * @return Database
     */
    public function __construct()
    {

        $this->stmt = new PDO(
            "mysql:host=".static::DB_HOST.";port=3306;dbname=".static::DB_NAME,
            static::DB_USER,
            static::DB_PASS,
            [
                PDO::ATTR_ERRMODE,
                PDO::ERRMODE_EXCEPTION,
                PDO::ERRMODE_WARNING
            ]
        );

        return $this;

    }

    /**
     * @return PDO
     */
    public function getPDO()
    {
        return $this->stmt;
    }

}