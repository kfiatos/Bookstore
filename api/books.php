<?php
include('src/connection.php');
include("src/Book.php");


function handleGET(){
  $conn = Connection::startConnection();
  $books = Book::getAllBooks($conn);

  header('Content-type: application/json');
  $json = json_encode($books);
  echo($json);

  Connection::stopConnecion($conn);
}

function handlePOST()
{
  $conn = Connection::startConnection();

  $book = new Book();
  $book->setName($_POST['nazwa']);
  $book->setAuthor($_POST['author']);
  $book->setDesc($_POST['opis']);
  $newObjectId  = $book->addBook($conn);
  Connection::stopConnecion($conn);
  header('Content-type: application/json');
  echo json_encode($newObjectId);


}

function handleDELETE()
{
  $conn = Connection::startConnection();
  $id = file_get_contents("php://input");
  $book = new Book();
  $book->deleteBook($conn, $id);
  Connection::stopConnecion($conn);
  header('Content-type: application/json');



}

function handlePUT()
{
  $conn = Connection::startConnection();

  parse_str(file_get_contents("php://input"),$data);
  header('Content-type: application/json');

  $book = new Book();
  $book->setName($data['name']);
  $book->setAuthor($data['author']);
  $book->setDesc($data['opis']);
  $book->updateBook($conn, $data['id']);
  Connection::stopConnecion($conn);




}


$methodType = $_SERVER['REQUEST_METHOD'];
switch($methodType){
  case "GET":
    handleGET();
    break;
  case "POST":
    handlePOST();
    break;
  case "DELETE":
    handleDELETE();
    break;
  case "PUT";
    handlePUT();
    break;
  default:
    die("Nie obsługujemy");


}






?>
