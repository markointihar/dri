<?php
session_start(); // Ponovno inicializirajte sejo
session_destroy(); // Uniči sejo
echo json_encode(['success' => true]); // Pošlji odgovor nazaj v JSON obliki
?>

