<?php
include "../backend/server.php";

if($_SERVER["REQUEST_METHOD"] === "POST") {
    // Preberemo podatke iz obrazca
    $email = $_POST['email'];
    $geslo = $_POST['geslo'];

    // Preverimo, ali obstaja uporabnik s podanim emailom
    $stmt = $povezava->prepare("SELECT * FROM uporabnik WHERE email = :email");
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    $uporabnik = $stmt->fetch(PDO::FETCH_ASSOC);

    // Preverimo geslo
    if ($uporabnik && password_verify($geslo, $uporabnik['geslo'])) {
        // Uporabnik je prijavljen, shranimo podatke v sejo
        session_start();
        $_SESSION['uporabnik_id'] = $uporabnik['iduporabnik'];
        $_SESSION['ime'] = $uporabnik['ime'];
        $_SESSION['priimek'] = $uporabnik['priimek'];
        $_SESSION['email'] = $uporabnik['email'];

        
        // Preusmerimo uporabnika na želeno stran
        header("Location: ../frontend/zunanjiIzvajalec.php");
        exit();
    } else {
        echo "Neuspešna prijava. Preverite vnešene podatke.";
        echo "<br>";
        echo "Napaka: " . implode(", ", $stmt->errorInfo());
        echo "Geslo v bazi: " . $uporabnik['geslo'];
        echo "Vnešeno geslo: " . $geslo;
    }
}
?>
