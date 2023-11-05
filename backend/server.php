<?php

$server = "localhost";
$username = "dri";
$geslo = "dri";

try{
    $povezava = new PDO("mysql:host=$server;dbname=dri", $username, $geslo);
    $povezava->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Uspešna povezava";
}catch(PDOException $e){
    echo "NE uspešna povezava: " . $e->getMessage();
}



// Preverite zahtevano pot (URL)
$requestPath = $_SERVER['PHP_SELF'];


if ($requestPath == "/zunanjiIzvajalec") {
    // Obdelava zahteve za prikaz oblike
    include "zunanjiIzvajalec.html"; 
    exit;
} else if ($requestPath == "/drugaPot") {
    // Obdelava druge zahteve
    include "druga_oblika.html";
    exit;
}



function dodajZunanjiIzvajalec($naziv, $kontaktna_stevilka, $kontaktna_oseba, $email){
    global $povezava;

    $stmt = $povezava->prepare("INSERT INTO zunanji_izvajalec (naziv, kontaktna_stevilka, kontaktna_oseba, email) VALUES (:naziv, :kontaktna_stevilka, :kontaktna_oseba, :email)");
    $stmt->bindParam(':naziv', $naziv);
    $stmt->bindParam(':kontaktna_stevilka', $kontaktna_stevilka);
    $stmt->bindParam(':kontaktna_oseba', $kontaktna_oseba);
    $stmt->bindParam(':email', $email);
    $stmt->execute();
}

function pridobiZunanjiIzvajalec($id) {
    global $povezava;

    $stmt = $povezava->prepare("SELECT * FROM zunanji_izvajalec WHERE id = :id");
    $stmt->bindParam(':id', $id);
    $stmt->execute();

    return $stmt->fetch(PDO::FETCH_ASSOC);
}


?>