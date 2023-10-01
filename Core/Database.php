<?php

namespace Core;

use PDO;


// Connect to the  database and execute a query.
class Database {

    private $connection;
    private $statement; 

    public function __construct($config,$username = 'root',$password = '')
    {
        $dsn = 'mysql:' . http_build_query($config,'',';');
        $this->connection = new PDO($dsn ,$username,$password,[
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]);
    }    

    function query(string $query,array $params = []) 
    {
        $this->statement = $this->connection->prepare($query);

        $this->statement->execute($params);
        
        return $this;
    }

    public function fetch() 
    {
        $fetchedData = $this->statement->fetch();
        return $fetchedData;
    }

    public function fetchOrAbort() 
    {
        $fetchedData = $this->fetch();
        
        if(! $fetchedData) {
            abort(Response::NOT_FOUND);
        }
        
        return $fetchedData;
    }

    public function fetchAll() 
    {
        $fetchedData = $this->statement->fetchAll();
        return $fetchedData;
    }

    public function fetchAllOrAbort() 
    {
        $fetchedData = $this->fetchAll();
        
        if(! $fetchedData) {
            abort(Response::NOT_FOUND);
        }
        
        return $fetchedData;
    }
}