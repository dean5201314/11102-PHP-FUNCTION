<?php

$rows=all();

dd($rows);


function all(){
    $dsn="mysql:host=localhost;charset=utf8;dbname=school";
    $pdo=new PDO($dsn,'root','');

    $sql="select * from `students` ";
    $rows=$pdo->query($sql)->fetchAll();
    return $rows;
}


 function dd($array){
     echo "<pre>";
     print_r($array);
     echo "</pre>";
 }