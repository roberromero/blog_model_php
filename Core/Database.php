<?php
namespace Core;
use PDO;
use PDOException;

class Database 
{

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

    return $this->statement->fetchAll(PDO::FETCH_ASSOC);//If FETCH ARRAY NOT ADDED
    //PDO default fetch mode is on, which is typically fetching results as both indexed and associative arrays.
    
  }

  public function find(){

    return $this->statement->fetch(PDO::FETCH_ASSOC);

  }

  public function findOrFail(){
    
    $result = $this->find();

    return $result ? $result : abort();
    
  }


}