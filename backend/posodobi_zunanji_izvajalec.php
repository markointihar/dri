<?php
include "server.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $naziv = $_POST['naziv'];
    $kontaktna_stevilka = $_POST['kontaktna_stevilka'];
    $kontaktna_oseba = $_POST['kontaktna_oseba'];
    $email = $_POST['email'];


    posodobiZunanjiIzvajalec($id, $naziv, $kontaktna_stevilka, $kontaktna_oseba, $email);
    header("Location: ../frontend/zunanjiIzvajalec.php");
    exit;
}

function posodobiZunanjiIzvajalec($id, $naziv, $kontaktna_stevilka, $kontaktna_oseba, $email) {
    global $povezava;

    $stmt = $povezava->prepare("UPDATE zunanji_izvajalec SET naziv = :naziv, kontaktna_stevilka = :kontaktna_stevilka, kontaktna_oseba = :kontaktna_oseba, email = :email WHERE id = :id");
    $stmt->bindParam(':id', $id);
    $stmt->bindParam(':naziv', $naziv);
    $stmt->bindParam(':kontaktna_stevilka', $kontaktna_stevilka);
    $stmt->bindParam(':kontaktna_oseba', $kontaktna_oseba);
    $stmt->bindParam(':email', $email);
    $stmt->execute();
}

?>
