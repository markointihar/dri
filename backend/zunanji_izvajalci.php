<?php 
include "server.php";

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $naziv = $_POST['naziv'];
    $kontaktna_stevilka = $_POST['kontaktna_stevilka'];
    $kontaktna_oseba = $_POST['kontaktna_oseba'];
    $email = $_POST['email'];

    dodajZunanjiIzvajalec($naziv, $kontaktna_stevilka, $kontaktna_oseba, $email);
    echo "uspešno dodan zunanji izvajalec";
}


?>
