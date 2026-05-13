<?php
/* Database configuration, this allows us to store the database information and connect to MySQL database
We initialize it instead of using mysqli_connect() every time we want to connect to the database.

saja code
*/
class Database{ 
  private $host = "localhost"; // database server, currently we are using local server
  private $username = "root"; 
  private $password = "";
  private $db_name = "mysess_db";
  private $charset = "utf8mb4";

  // create the PDO connection and return it. PDO is a more secure and flexible way to connect to the database compared to mysqli
  protected function connect() {

    try {
      $dsn = "mysql:host=$this->host;dbname=$this->db_name;charset=$this->charset";
      $pdo = new PDO($dsn, $this->username, $this->password);
      $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
      return $pdo;
    } catch (PDOException $e) {
      echo "Connection failed: " . $e->getMessage();
    }
  }
}
?>