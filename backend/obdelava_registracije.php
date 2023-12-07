<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once '../vendor/autoload.php';

include "../backend/server.php";

if($_SERVER["REQUEST_METHOD"] === "POST"){
    // Preberemo podatke iz obrazca
    $ime = $_POST['ime'];
    $priimek = $_POST['priimek'];
    $email = $_POST['email'];
    $geslo = password_hash($_POST['geslo'], PASSWORD_DEFAULT);

    $podatki = [
        'ime' => $ime,
        'priimek' => $priimek,
        'email' => $email
    ];
    // Pripravimo SQL poizvedbo za vstavljanje novih uporabnikov v bazo
    $sql = "INSERT INTO uporabnik (ime, priimek, email, geslo) VALUES (:ime, :priimek, :email, :geslo)";

    $stmt = $povezava->prepare($sql);
    $stmt->bindParam(':ime', $ime);
    $stmt->bindParam(':priimek', $priimek);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':geslo', $geslo);


    if ($stmt->execute()) {
        echo "Uspešno registriran uporabnik!";
        sendEmail($podatki);
    } else {
        echo "Napaka pri registraciji!";
    }

    header("Location: ../frontend/register.php");
    exit();
}


function sendEmail($podatki){
    $mail = new PHPMailer(true);

    try {
        //Server settings
        $mail->SMTPDebug = 2;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'sandbox.smtp.mailtrap.io';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = '5d531d9ec9ded3';                     //SMTP username
        $mail->Password   = '5fe395058ea6d9';                               //SMTP password
        $mail->SMTPSecure = 'tls';            //Enable implicit TLS encryption
        $mail->Port       = 2525;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
    
        //Recipients
        $mail->setFrom('dri@dri.com', 'Mare');
        $mail->addAddress($podatki['email'], $podatki['ime'] . ' ' . $podatki['priimek']);     //Add a recipient

        //Attachments
       // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments

    
        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'Potrditev registracije';
        $mail->Body    = 'Hvala za registracijo' . $podatki['ime'] . ' ' . $podatki['priimek'];
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
    
        $mail->send();
        echo 'Message has been sent';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }

}
?>
