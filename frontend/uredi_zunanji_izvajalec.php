<?php
include "../backend/server.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Preberemo vrednosti iz obrazca in posodobimo vnos
    $id = $_POST['id'];
    $naziv = $_POST['naziv'];
    $kontaktna_stevilka = $_POST['kontaktna_stevilka'];
    $kontaktna_oseba = $_POST['kontaktna_oseba'];
    $email = $_POST['email'];

    // Tukaj napišite SQL poizvedbo, ki bo posodobila vnos v bazi z uporabo ID-ja

    header("Location: zunanjiIzvajalec.php"); // Preusmerimo nazaj na seznam
    exit;
}

// Preberemo ID iz URL-ja
$id = $_GET['id'];

// Izvedemo SQL poizvedbo za pridobitev podatkov izbrane vrstice
$stmt = $povezava->prepare("SELECT * FROM zunanji_izvajalec WHERE id = :id");
$stmt->bindParam(':id', $id);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Vključitev Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container">
    <h2 class="mt-5">Urejanje zunanjega izvajalca</h2>

    <!-- Obrazec za urejanje zunanjega izvajalca -->
    <form method="POST" action="../backend/zunanji_izvajalci.php">
        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
        <div class="mb-3">
            <label for="naziv" class="form-label">Naziv:</label>
            <input type="text" class="form-control" name="naziv" id="naziv" value="<?php echo $row['naziv']; ?>" required>
        </div>

        <div class="mb-3">
            <label for="kontaktna_stevilka" class="form-label">Kontaktna številka:</label>
            <input type="text" class="form-control" name="kontaktna_stevilka" id="kontaktna_stevilka" value="<?php echo $row['kontaktna_stevilka']; ?>" required>
        </div>

        <div class="mb-3">
            <label for="kontaktna_oseba" class="form-label">Kontaktna Oseba:</label>
            <input type="text" class="form-control" name="kontaktna_oseba" id="kontaktna_oseba" value="<?php echo $row['kontaktna_oseba']; ?>" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">E-pošta:</label>
            <input type="text" class="form-control" name="email" id="email" value="<?php echo $row['email']; ?>" required>
        </div>


        <button type="submit" class="btn btn-primary">Shrani</button>
    </form>

    <!-- Vključitev Bootstrap JavaScript in jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</body>
</html>
