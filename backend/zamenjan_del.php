<?php 
include "server.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Pridobite podatke iz obrazca
    $id = $_POST['idzamenjen_del'];
    $naziv = $_POST['naziv'];
    $opomba = $_POST['opomba'];

    if (empty($id)) {
        // Če manjka ID, gre za dodajanje novega vnosa
        dodajZamenjanDel($naziv, $opomba);
    } else {
        // Če je prisoten ID, gre za urejanje obstoječega vnosa
        posodobiZamenjanDel($id,$naziv, $opomba);
    }
    header("Location: ../frontend/zamenjanDel.php");
    exit;
}

// Preverite, če ste v načinu urejanja (če je ID prisoten v URL-ju ali drugem načinu)
if (isset($_GET['edit']) && is_numeric($_GET['edit'])) {
    $id_to_edit = $_GET['edit'];
    // Pridobite obstoječe podatke za urejanje
    $stmt = $povezava->prepare("SELECT * FROM zamenjan_del WHERE idzamenjen_del = :idzamenjen_del");
    $stmt->bindParam(':idzamenjen_del', $id_to_edit, PDO::PARAM_INT);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
}

function dodajZamenjanDel($naziv, $opomba){
    global $povezava;

    $stmt = $povezava->prepare("INSERT INTO zamenjan_del (naziv, opomba) VALUES (:naziv, :opomba)");
    $stmt->bindParam(':naziv', $naziv);
    $stmt->bindParam(':opomba', $opomba);
    $stmt->execute();
}

function pridobiZamenjanDel($id) {
    global $povezava;

    $stmt = $povezava->prepare("SELECT * FROM zamenjan_del WHERE idzamenjen_del = :idzamenjen_del");
    $stmt->bindParam(':idzamenjen_del', $id);
    $stmt->execute();

    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function posodobiZamenjanDel($id, $naziv, $opomba) {
    global $povezava;

    $stmt = $povezava->prepare("UPDATE zunanji_izvajalec SET naziv = :naziv, opomba = :opomba WHERE idzamenjen_del = :idzamenjen_del");
    $stmt->bindParam(':idzamenjen_del', $id);
    $stmt->bindParam(':naziv', $naziv);
    $stmt->bindParam(':opomba', $opomba);
    $stmt->execute();
}

?>