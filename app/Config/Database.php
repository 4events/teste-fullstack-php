<?php

namespace App\Config;

use PDO;

class Database
{

    const DB_HOST = "127.0.0.1";
    const DB_NAME = "testephp";
    const DB_USER = "testephp";
    const DB_PASS = "Px2FCx_JRmvs6tMg";

    /**
     * @var PDO
     */
    private PDO $stmt;

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
    public function getPDO(): PDO
    {
        return $this->stmt;
    }

}