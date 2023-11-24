<?php

include "../backend/server.php";

if($_SERVER["REQUEST_METHOD"] === "POST"){
    // Preberemo podatke iz obrazca
    $ime = $_POST['ime'];
    $priimek = $_POST['priimek'];
    $email = $_POST['email'];
    $geslo = password_hash($_POST['geslo'], PASSWORD_DEFAULT);

    // Pripravimo SQL poizvedbo za vstavljanje novih uporabnikov v bazo
    $sql = "INSERT INTO uporabnik (ime, priimek, email, geslo) VALUES (:ime, :priimek, :email, :geslo)";

    $stmt = $povezava->prepare($sql);
    $stmt->bindParam(':ime', $ime);
    $stmt->bindParam(':priimek', $priimek);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':geslo', $geslo);


    if ($stmt->execute()) {
        echo "Uspešno registriran uporabnik!";
    } else {
        echo "Napaka pri registraciji!";
    }

    header("Location: ../frontend/register.php");
    exit();
}
?>
