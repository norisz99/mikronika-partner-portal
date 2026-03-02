<?php
session_start();
header('Content-Type: application/json');

// Ha logout paramétert kap
if (isset($_GET['logout'])) {
    session_destroy();
    echo json_encode(['success' => true]);
    exit;
}

// Státusz lekérdezés
if (isset($_SESSION['user'])) {
    echo json_encode(['isLoggedIn' => true, 'user' => $_SESSION['user']]);
} else {
    echo json_encode(['isLoggedIn' => false]);
}
?>