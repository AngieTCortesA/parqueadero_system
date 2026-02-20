<?php
// Configuración local comentada
return[
    'host' => '127.0.0.1',
    'dbname' => 'parqueadero_system',
    'username' => 'root',
    'password' => '',
    'charset' => 'utf8mb4',
    'options' => [
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ]
]; 

// Configuración de Railway (sincronizada con config.php)
//return[
//    'host' => 'interchange.proxy.rlwy.net:18270', // Incluye el puerto
//    'dbname' => 'railway',
//    'username' => 'root',
//    'password' => 'XaUYILSXnQZKykDunwXNFIvrSThFFxDn',
//    'charset' => 'utf8mb4',
//    'options' => [
//        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
//        PDO::ATTR_TIMEOUT => 5,
//        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
//    ]
//];  