<?php
require_once 'config.php';

header('Content-Type: application/json');

if (isset($_GET['fecha'])) {
    $fecha = $_GET['fecha'];
    $cupos_disponibles = getCuposDisponibles($fecha);
    $pdo = conectarDB();
    $config = $pdo->query("SELECT total_cupos FROM configuracion ORDER BY id DESC LIMIT 1")->fetch(PDO::FETCH_ASSOC);
    $total = $config['total_cupos'] ?? 10;

    // NUEVO: obtener los espacios ocupados
    $stmt = $pdo->prepare("SELECT numero_espacio FROM reservas WHERE fecha_reserva = ? AND estado = 'activa'");
    $stmt->execute([$fecha]);
    $ocupados = $stmt->fetchAll(PDO::FETCH_COLUMN);

    echo json_encode([
        'fecha' => $fecha,
        'disponibles' => $cupos_disponibles,
        'total' => $total,
        'ocupados' => $ocupados // <-- lista de espacios ocupados
    ]);
} else {
    echo json_encode(['error' => 'Fecha no proporcionada']);
}
?>