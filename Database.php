<?php

class Database {

private $connection;
private $statement;

  public function __construct($config, $username = 'root', $password = '') {

        try {
            //$dsn = "mysql:host={$config['servername']};port={$config['port']};dbname={$config['dbname']}";
            $dsn = 'mysql:'. http_build_query($config, '', ';');
            $this->connection = new PDO($dsn, $username, $password, [
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
            ]);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } 
        catch(PDOException $e){
            echo "Connection failed: " . $e->getMessage();
        }
  }


  // Method to execute a query
  public function query($sql, $param = []) {

      try {
          $this->statement = $this->connection->prepare($sql);
          $this->statement->execute($param);

          return $this;//returning the same instance
          
      } catch(PDOException $e) {
          echo "Query failed: " . $e->getMessage();
      }
      
  }

  public function all(){

    return $this->statement->fetchAll();
    
  }

  public function find(){

    return $this->statement->fetch();

  }

  public function findOrFail(){
    
    $result = $this->find();

    return $result ? $result : abort();
    
  }


}