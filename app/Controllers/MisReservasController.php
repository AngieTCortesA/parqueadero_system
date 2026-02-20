<?php

namespace App\Controllers;

use Framework\Validator;
use Exception;

date_default_timezone_set('America/Bogota');
class MisReservasController
{
    public function index()
    {
        $reservas = [];
        // Verificar autenticación
        if (!isset($_SESSION['usuario_id'])) {
            redirect('login');
        }

     // Actualizar reservas vencidas a 'completada' (solo por fecha)
$hoy = date('Y-m-d');
db()->query('UPDATE reservas SET estado = "completada" WHERE estado = "activa" AND fecha_reserva < :hoy', [
    'hoy' => $hoy
]);
        // --- FIN NUEVO ---

        // Manejar cancelación de reservas
        $mensaje = '';
        $tipo_mensaje = '';
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action'])) {
            if ($_POST['action'] == 'cancelar' && isset($_POST['reserva_id'])) {
                $resultado = $this->cancelarReserva($_POST['reserva_id']);
                $mensaje = $resultado['mensaje'];
                $tipo_mensaje = $resultado['tipo'];
                
                // Recargar la página para ver los cambios si fue exitoso
                if ($resultado['tipo'] === 'success') {
                    redirect('/mis-reservas', $mensaje);
                }
            }
        }

        // Obtener reservas según el rol del usuario
        if ($_SESSION['usuario_rol'] ==='admin') {
            // Admin ve todas las reservas
            $reservas = db()->query(
                'SELECT 
                    r.*,
                    r.usuario_id,
                    r.numero_espacio,
                    u.email,
                    CONCAT(
                        u.p_nombre, " ",
                        IFNULL(u.s_nombre, ""), " ",
                        u.p_apellido, " ",
                        IFNULL(u.s_apellido, "")
                    ) AS nombre
                FROM reservas r
                INNER JOIN usuarios u ON r.usuario_id = u.id
                ORDER BY r.fecha_reserva DESC',
            )->get();

        } else {
            //Usuario normal ve solo sus reservas
             $reservas = db()->query(
                'SELECT 
                    r.*,
                    r.usuario_id,
                    r.numero_espacio,
                    u.email,
                    CONCAT(
                        u.p_nombre, " ",
                        IFNULL(u.s_nombre, ""), " ",
                        u.p_apellido, " ",
                        IFNULL(u.s_apellido, "")
                    ) AS nombre
                FROM reservas r
                INNER JOIN usuarios u ON r.usuario_id = u.id
                WHERE r.usuario_id = :usuario_id
                ORDER BY r.fecha_reserva DESC, r.fecha_creacion DESC',
                [
                    'usuario_id' => $_SESSION['usuario_id']
                ]
            )->get();
        }


        // Agrupar reservas por fecha
        $reservas_por_fecha = [];
        foreach ($reservas as $reserva) {
            $fecha = $reserva['fecha_reserva'];
            $reservas_por_fecha[$fecha][] = $reserva;
        }

        view('mis-reservas', [
            'title' => $_SESSION['usuario_rol'] == 'admin' ? 'Todas las Reservas' : 'Mis Reservas',
            'reservas_por_fecha' => $reservas_por_fecha,
            'mensaje' => $mensaje,
            'tipo_mensaje' => $tipo_mensaje
        ]);
    }

    /**
     * Cancela (elimina) una reserva específica
     * 
     * @param int $reserva_id ID de la reserva a cancelar
     * @return array Resultado de la operación con mensaje y tipo
     */
    public function cancelarReserva($reserva_id)
    {
        // Validar que se recibió el ID
        if (!$reserva_id || !is_numeric($reserva_id)) {
            return [
                'mensaje' => 'ID de reserva inválido',
                'tipo' => 'error'
            ];
        }

        try {
            // Buscar la reserva
            $reserva = db()->query('SELECT * FROM reservas WHERE id = :id', [
                'id' => $reserva_id
            ])->first();

            // Verificar que la reserva existe
            if (!$reserva) {
                return [
                    'mensaje' => 'La reserva no existe',
                    'tipo' => 'error'
                ];
            }

            // Verificar permisos: admin puede cancelar cualquiera, usuario solo las suyas
            if ($_SESSION['usuario_rol'] !== 'admin' && $reserva['usuario_id'] != $_SESSION['usuario_id']) {
                return [
                    'mensaje' => 'No tienes permiso para cancelar esta reserva',
                    'tipo' => 'error'
                ];
            }

            // Eliminar la reserva
            $resultado = db()->query('UPDATE reservas SET estado = "cancelada" WHERE id = :id', [
                'id' => $reserva_id
            ]);

            if ($resultado) {
                return [
                    'mensaje' => 'Reserva cancelada exitosamente',
                    'tipo' => 'success'
                ];
            } else {
                return [
                    'mensaje' => 'Error al cancelar la reserva. Inténtalo de nuevo.',
                    'tipo' => 'error'
                ];
            }

        } catch (Exception $e) {
            error_log("Error al cancelar reserva ID {$reserva_id}: " . $e->getMessage());
            
            return [
                'mensaje' => 'Ocurrió un error inesperado. Inténtalo de nuevo.',
                'tipo' => 'error'
            ];
        }
    }

    /**
     * Marca una reserva como completada manualmente
     * @param int $reserva_id
     * @return array
     */
    public function completarReserva($reserva_id)
    {
        // Validar que se recibió el ID
        if (!$reserva_id || !is_numeric($reserva_id)) {
            return [
                'mensaje' => 'ID de reserva inválido',
                'tipo' => 'error'
            ];
        }
        try {
            // Buscar la reserva
            $reserva = db()->query('SELECT * FROM reservas WHERE id = :id', [
                'id' => $reserva_id
            ])->first();
            if (!$reserva) {
                return [
                    'mensaje' => 'La reserva no existe',
                    'tipo' => 'error'
                ];
            }
            // Solo admin o dueño pueden completar
            if ($_SESSION['usuario_rol'] !== 'admin' && $reserva['usuario_id'] != $_SESSION['usuario_id']) {
                return [
                    'mensaje' => 'No tienes permiso para completar esta reserva',
                    'tipo' => 'error'
                ];
            }
            // Actualizar estado
            $resultado = db()->query('UPDATE reservas SET estado = "completada" WHERE id = :id', [
                'id' => $reserva_id
            ]);
            if ($resultado) {
                return [
                    'mensaje' => 'Reserva marcada como completada',
                    'tipo' => 'success'
                ];
            } else {
                return [
                    'mensaje' => 'Error al completar la reserva. Inténtalo de nuevo.',
                    'tipo' => 'error'
                ];
            }
        } catch (Exception $e) {
            error_log("Error al completar reserva ID {$reserva_id}: " . $e->getMessage());
            return [
                'mensaje' => 'Ocurrió un error inesperado. Inténtalo de nuevo.',
                'tipo' => 'error'
            ];
        }
    }

    /**
     * Verifica si un usuario ya tiene una reserva activa para una fecha específica
     * (Para usar en el controlador de crear reservas)
     * 
     * @param int $usuario_id
     * @param string $fecha
     * @param int $excluir_reserva_id (opcional, para ediciones)
     * @return bool
     */
    public static function usuarioTieneReservaPorDia($usuario_id, $fecha, $excluir_reserva_id = null)
    {
        $query = 'SELECT COUNT(*) as total FROM reservas WHERE usuario_id = :usuario_id AND fecha_reserva = :fecha';
        $params = [
            'usuario_id' => $usuario_id,
            'fecha' => $fecha
        ];

        if ($excluir_reserva_id) {
            $query .= ' AND id != :excluir_id';
            $params['excluir_id'] = $excluir_reserva_id;
        }

        $resultado = db()->query($query, $params)->first();
        
        return $resultado['total'] > 0;
    }
}