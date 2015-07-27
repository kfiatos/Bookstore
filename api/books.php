<?php
include('src/connection.php');
include ("src/book.php");

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
  $data = file_get_contents("php://input");
  $book = new Book();
  $book->deleteBook($conn, $data);
  Connection::stopConnecion($conn);
  header('Content-type: application/json');



}

function handlePUT()
{
  $conn = Connection::startConnection();
  $data = file_get_contents("php://input");
  $book = new Book();
  $book->deleteBook($conn, $data);
  $book->deleteBook($conn, $data);
  Connection::stopConnecion($conn);
  header('Content-type: application/json');



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
