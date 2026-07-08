<?php
// Munkamenet indítása
session_start();
header('Content-Type: application/json');

// JSON bemenet olvasása
$inputJSON = file_get_contents('php://input');
$input = json_decode($inputJSON, TRUE);

$username = $input['username'] ?? '';
$password = $input['password'] ?? '';

// Biztos abszolút útvonal (mivel egy mappában vannak)
// 1. Megpróbáljuk ugyanabban a mappában
$filePath = __DIR__ . '/users.json';

// 2. Ha ott nincs, megpróbáljuk egy szinttel feljebb (a szülő mappában)
if (!file_exists($filePath)) {
    $filePath = __DIR__ . '/../users.json';
}

// 3. Ha így sem találjuk, akkor hiba
if (!file_exists($filePath)) {
    echo json_encode(['success' => false, 'message' => 'Hiba: A users.json fájl nem található a szerveren!']);
    exit;
}

$usersFile = file_get_contents($filePath);

if ($usersFile === false) {
    echo json_encode(['success' => false, 'message' => 'Rendszerhiba: Az adatbázis nem elérhető!']);
    exit;
}

$users = json_decode($usersFile, true);
$foundUser = null;

// Keresés a felhasználók között
if (is_array($users)) {
// Keresés a felhasználók között
    foreach ($users as $user) {
    // Ellenőrizzük, hogy a beírt jelszó illeszkedik-e a tárolt hash-hez
        if ($user['username'] === $username && password_verify($password, $user['password'])) {
            $foundUser = $user;
            break;
        }
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
    echo json_encode(['success' => false, 'message' => 'Hibás felhasználónév vagy jelszó!']);
}
?>