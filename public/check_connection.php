<?php

try {
    $pdo = new PDO("mysql:host=127.0.0.1;dbname=unm_womac", "womac", "Womac22!");
    echo "Pripojenie k databáze úspešné.";
} catch (PDOException $e) {
    die("Chyba pripojenia k databáze: " . $e->getMessage());
}
