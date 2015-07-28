<?php
//$conn = new mysqli("localhost", "root", "root", "bookstore");
//
//if($conn->errno){
//  echo("Error connecting to database");
//  echo($conn->error."<br>");
//  die();
//}


class Connection
{

    static function startConnection(){
      $host = 'localhost';
      $username = 'root';
      $password = 'root';
      $dbname = 'bookstore';

      $conn = new mysqli($host, $username, $password, $dbname);

      if($conn->connect_error)
      {
       die("Błąd, sorki nie udało się połączyć z bazą");
      }
      return $conn;

    }

  /**
   * komment dla devów
   * @param mysqli $connection Musisz mi dac obiekt mysqli bla bla
   */

  static function stopConnecion(mysqli $connection)
  {
    $connection->close();
  }

}

?>
