<?php
session_start();
header('Content-Type: application/json');

// Ha nincs belépve, hiba
if (!isset($_SESSION['user'])) {
    http_response_code(403);
    echo json_encode(['error' => 'Jelentkezz be!']);
    exit;
}

$file = 'products.json';

// POST kérés = Módosítás (Csak Adminnak!)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($_SESSION['user']['role'] !== 'admin') {
        echo json_encode(['success' => false, 'message' => 'Nincs jogosultságod!']);
        exit;
    }
    
    // Adat mentése
    $newData = file_get_contents('php://input');
    // Itt egy egyszerűsített felülírást csinálunk a demó kedvéért (élesben validálni kell!)
    // A frontend küldi a frissített terméket, mi megkeressük és cseréljük
    $updatedItem = json_decode($newData, true);
    $products = json_decode(file_get_contents($file), true);
    
    foreach ($products as &$p) {
        if ($p['id'] === $updatedItem['id']) {
            $p['price'] = $updatedItem['price'];
            $p['stock'] = $updatedItem['stock']; // Készletet is mentünk
            break;
        }
    }
    
    file_put_contents($file, json_encode($products, JSON_PRETTY_PRINT));
    echo json_encode(['success' => true]);
    exit;
}

// GET kérés = Listázás (Mindenkinek)
echo file_get_contents($file);
?>