<?php 
include "server.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Pridobite podatke iz obrazca
    $id = $_POST['id'];
    $naziv = $_POST['naziv'];
    $kontaktna_stevilka = $_POST['kontaktna_stevilka'];
    $kontaktna_oseba = $_POST['kontaktna_oseba'];
    $email = $_POST['email'];

    if (empty($id)) {
        // Če manjka ID, gre za dodajanje novega vnosa
        dodajZunanjiIzvajalec($naziv, $kontaktna_stevilka, $kontaktna_oseba, $email);
    } else {
        // Če je prisoten ID, gre za urejanje obstoječega vnosa
        posodobiZunanjiIzvajalec($id, $naziv, $kontaktna_stevilka, $kontaktna_oseba, $email);
    }
    header("Location: ../frontend/zunanjiIzvajalec.php");
    exit;
}

// Preverite, če ste v načinu urejanja (če je ID prisoten v URL-ju ali drugem načinu)
if (isset($_GET['edit']) && is_numeric($_GET['edit'])) {
    $id_to_edit = $_GET['edit'];
    // Pridobite obstoječe podatke za urejanje
    $stmt = $povezava->prepare("SELECT * FROM zunanji_izvajalec WHERE id = :id");
    $stmt->bindParam(':id', $id_to_edit, PDO::PARAM_INT);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
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

