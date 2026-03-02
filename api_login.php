<?php
// Munkamenet indítása
session_start();
header('Content-Type: application/json');

// JSON bemenet olvasása (amit a fetch küld)
$inputJSON = file_get_contents('php://input');
$input = json_decode($inputJSON, TRUE);

$username = $input['username'] ?? '';
$password = $input['password'] ?? '';

// Felhasználók betöltése a users.json-ból
// Fontos: A users.json-t majd védeni kell, hogy böngészőből ne lehessen letölteni!
$usersFile = file_get_contents('../users.json'); // Egy mappával feljebb keressük biztonság miatt
if ($usersFile === false) {
    // Ha nem találja feljebb, megnézi ugyanott (fejlesztéshez)
    $usersFile = file_get_contents('users.json');
}

$users = json_decode($usersFile, true);
$foundUser = null;

// Keresés
foreach ($users as $user) {
    if ($user['username'] === $username && $user['password'] === $password) {
        $foundUser = $user;
        break;
    }
}

if ($foundUser) {
    $_SESSION['user'] = [
        'username' => $foundUser['username'],
        'role' => $foundUser['role']
    ];
    echo json_encode(['success' => true, 'role' => $foundUser['role']]);
} else {
    http_response_code(401);
    echo json_encode(['success' => false, 'message' => 'Hibás adatok!']);
}
?>