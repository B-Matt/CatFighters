<?php

class Database
{
    private $connection = null;

    public function __construct() 
    {
        try
        {
            $this->connection = new PDO("mysql:host=" . Config::DB_HOST . ";dbname=" . Config::DB_NAME, Config::DB_USER, Config::DB_PASS);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->connection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC); 
        }
        catch(Exception $e)
        {
            throw new Exception($e->getMessage());   
        }
    }

    public function select($query, $params = []) 
    {
        try 
        {
            $stmt = $this->executeStmt($query, $params);
            return $stmt->fetchAll();
        }
        catch(Exception $e)
        {
            throw new Exception($e->getMessage());
        }
    }

    private function executeStmt($query, $params)
    {
        try 
        {
            $stmt = $this->connection->prepare($query);
            $stmt->execute($params);
            return $stmt;
        }
        catch(Exception $e)
        {
            throw new Exception($e->getMessage());
        }
    }
}