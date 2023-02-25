<?php

namespace App\DAO;

abstract class Connection
{
    protected $pdo;

    public function __construct()
    {
        $host = $_ENV['BD_HOST'];
        $port = $_ENV['BD_PORT'];
        $user = $_ENV['BD_USER'];
        $pass = $_ENV['BD_PASS'];
        $dbname = $_ENV['DB_NAME'];
        $dsn = 'mysql' . ":host={$host};dbname={$dbname};port={$port}";

        try {
            if (!isset($connection)) {
                $this->pdo = new \PDO($dsn, $user, $pass);
                $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            }
        } catch (\PDOException $e) {
            $mensagem = "Drivers disponiveis: " . implode(",",\PDO::getAvailableDrivers());
            $mensagem .= "\nErro: " . $e->getMessage();
            throw new \Exception($mensagem);
        }


       
    }
}