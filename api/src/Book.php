<?php

/*
   CREATE TABLE Books (id int NOT NULL AUTO_INCREMENT,
   name VARCHAR(255), author VARCHAR(255),
   opis VARCHAR(255),
   PRIMARY KEY (id));
  */

class Book
{
   protected $id;
   protected $name;
   protected $desc;
   protected $author;


   public function __construct($name = null, $desc = null, $author = null)
   {
      $this->id = -1;
      if(empty($name)){
         $this->setName($name);
      }
      if(empty($desc)){
         $this->setDesc($desc);
      }

      if(empty($author)){
         $this->setAuthor($author);
      }
   }


   public function updateBook(mysqli $conn, $id)
   {
      $newName = $conn->real_escape_string($this->getName()); //for security of input
      $newDesc = $conn->real_escape_string($this->getDesc()); //for security of input
      $newAuthor = $conn->real_escape_string($this->getAuthor()); //for security of input

      $sql = "UPDATE books SET name ='".$newName."', author =  '".$newAuthor."', opis = '".$newDesc."'WHERE id= $id";
      $result = $conn->query($sql);
      if($result == false){
        echo("Błąd dodawnia do bazy danych");
     }
   }



   public function deleteBook(mysqli $conn, $id)
   {
      $sql = "DELETE FROM books WHERE id =".$id."";
      $result = $conn->query($sql);
      if($result == false){
         echo("Błąd dodawnia do bazy danych");
      }
   }



   public function addBook(mysqli $conn)
   {
//powtórzyc 500 razy!!!
      $newName = $conn->real_escape_string($this->getName()); //for security of input
      $newDesc = $conn->real_escape_string($this->getDesc()); //for security of input
      $newAuthor = $conn->real_escape_string($this->getAuthor()); //for security of input

      $sql = "INSERT INTO Books(name, author, opis) VALUES ('".$newName."','".$newAuthor."','".$newDesc."')";
      $result = $conn->query($sql);
      if($result == false){
         echo("Błąd dodawnia do bazy danych");
      }
         return $conn->insert_id;
   }

   static function getAllBooks(mysqli $conn)
   {
      $sql = "SELECT * FROM Books";
      $result = $conn->query($sql);
      $pomTab = [];
      if($result){

         while($row = $result->fetch_array(MYSQL_ASSOC)){
            $pomTab[] = $row;
         }
      }
      return $pomTab;
   }



   /**
    * @return mixed
    */
   public function getId()
   {
      return $this->id;
   }

   /**
    * @return mixed
    */
   public function getName()
   {
      return $this->name;
   }

   /**
    * @param mixed $name
    */
   public function setName($name)
   {
      $this->name = $name;
   }

   /**
    * @return mixed
    */
   public function getDesc()
   {
      return $this->desc;
   }

   /**
    * @param mixed $desc
    */
   public function setDesc($desc)
   {
      $this->desc = $desc;
   }

   /**
    * @return mixed
    */
   public function getAuthor()
   {
      return $this->author;
   }

   /**
    * @param mixed $author
    */
   public function setAuthor($author)
   {
      $this->author = $author;
   }







}

?>