<?php
require_once 'config.php';

try {
    $db = conectarDB();
    echo "✅ Conexión exitosa a la base de datos.";
} catch (Exception $e) {
    echo "❌ Error: " . $e->getMessage();
}
