<?php
$kolory = [];
$kolor = [
  'nazwa' => 'blue',
  'ulubiony'=> 'true'
];
  $kolory[]= $kolor;

$kolor =  [
  'nazwa' => 'red',
  'ulubiony'=> 'false'
];
$kolory[]= $kolor;
//var_dump($kolory);

//echo('Teraz zmieniam na JSON');
$koloryJSON = json_encode($kolory);
//echo("<br>");
header('Content-type: application/json');
echo($koloryJSON);


?>
