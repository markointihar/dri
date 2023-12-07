<?php

$server = "localhost";
$username = "dri";
$geslo = "dri";

try{
    $povezava = new PDO("mysql:host=$server;dbname=dri", $username, $geslo);
    $povezava->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   
}catch(PDOException $e){
    echo "NE uspešna povezava: " . $e->getMessage();
}
?>