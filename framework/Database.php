<?php

namespace Framework;

use PDO;

class Database
{
    private $connection;
    private $statement; // sentencia

    public function __construct()
    {
        $host = $_ENV['DB_HOST'] ?? 'localhost';
        $port = $_ENV['DB_PORT'] ?? 3306;
        $dbname = $_ENV['DB_NAME'] ?? 'parqueadero_system';
        $user = $_ENV['DB_USER'] ?? 'root';
        $pass = $_ENV['DB_PASS'] ?? '';
    
        $dsn = "mysql:host=$host;port=$port;dbname=$dbname;charset=utf8mb4";
    
        $this->connection = new PDO($dsn, $user, $pass, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ]);
    }

    public function query($sql, $params = [])
    {
        $this->statement = $this->connection->prepare($sql);
        $this->statement->execute($params);

        return $this;
    }

    public function get()
    {
        return $this->statement->fetchAll();
    }

    public function first()
    {
        return $this->statement->fetch();
    }

    public function firstOrFail()
    {
        $result = $this->first();

        if (!$result) {
            exit('404 Not Found');
        }

        return $result;
    }

    public function beginTransaction()
    {
        return $this->connection->beginTransaction();
    }

    public function commit()
    {
        return $this->connection->commit();
    }

    public function rollBack()
    {
        return $this->connection->rollBack();
    }

    public function inTransaction()
    {
        return $this->connection->inTransaction();
    }
}
