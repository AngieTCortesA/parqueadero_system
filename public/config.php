<?php
$host = $_ENV['DB_HOST'];
$port = $_ENV['DB_PORT'];
$name = $_ENV['DB_NAME'];
$user = $_ENV['DB_USER'];
$pass = $_ENV['DB_PASS'];

$dsn = "mysql:host=$host;port=$port;dbname=$name;charset=utf8";

$pdo = new PDO($dsn, $user, $pass, [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
]);

function conectarDB() {
    try {
        $dsn = "mysql:host=".DB_HOST.";port=".DB_PORT.";dbname=".DB_NAME.";charset=utf8";
        $pdo = new PDO($dsn, DB_USER, DB_PASS, [
            PDO::ATTR_TIMEOUT => 5,              // Timeout reducido para pruebas
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ]);
        return $pdo;
    } catch (PDOException $e) {
        die("Error de conexión: " . $e->getMessage());
    }
}

function getCuposDisponibles($fecha) {
    $pdo = conectarDB();
    
    // Obtener total de cupos configurados
    $config = $pdo->query("SELECT total_cupos FROM configuracion ORDER BY id DESC LIMIT 1")->fetch(PDO::FETCH_ASSOC);
    $total_cupos = $config['total_cupos'] ?? 10;
    
    // Contar reservas activas para la fecha
    $stmt = $pdo->prepare("SELECT COUNT(*) as ocupados FROM reservas WHERE fecha_reserva = ? AND estado = 'activa'");
    $stmt->execute([$fecha]);
    $ocupados = $stmt->fetch(PDO::FETCH_ASSOC)['ocupados'];
    
    return $total_cupos - $ocupados;
}

function usuarioTieneReserva($usuario_id, $fecha) {
    $pdo = conectarDB();
    $stmt = $pdo->prepare("SELECT COUNT(*) as count FROM reservas WHERE usuario_id = ? AND fecha_reserva = ? AND estado = 'activa'");
    $stmt->execute([$usuario_id, $fecha]);
    return $stmt->fetch(PDO::FETCH_ASSOC)['count'] > 0;
}

// Función para verificar si el usuario está logueado
function verificarAutenticacion() {
    if (!isset($_SESSION['usuario_id'])) {
        header("Location: login.php");
        exit();
    }
}

// Función para verificar si el usuario es admin
function verificarAdmin() {
    verificarAutenticacion();
    if ($_SESSION['usuario_rol'] != 'admin') {
        header("Location: index.php");
        exit();
    }
}

$hoy = date('Y-m-d');
$manana = date('Y-m-d', strtotime('+1 day'));