<?php

namespace App\Controllers;

use Framework\Validator;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use DateTime;

class HomeController
{
    public function index()
    {
        // Verificar autenticación usando el sistema existente
        // if (!isAuthenticated()) {
        //     redirect('login');
        // }

        // Obtener usuario actual desde la sesión
        $currentUser = session()->get('user');
        
        // if (!$currentUser) {
        //     redirect('login');
        // }

        // Obtener información completa del usuario desde la base de datos
        $usuario = null;
        if ($currentUser) {
            $usuario = db()->query('SELECT * FROM usuarios WHERE id = :id', [
                'id' => $currentUser['id']
            ])->first();
        }

        // if (!$usuario) {
        //     redirect('login');
        // }

        // Actualizar variables de sesión para compatibilidad con el template existente
        if ($usuario) {
            $_SESSION['usuario_id'] = $usuario['id'];
            $_SESSION['usuario_nombre'] = trim(
                $usuario['p_nombre'] . ' ' .
                ($usuario['s_nombre'] ?? '') . ' ' .
                $usuario['p_apellido'] . ' ' .
                ($usuario['s_apellido'] ?? '')
            );
            $_SESSION['usuario_email'] = $usuario['email'];
            $_SESSION['usuario_telefono'] = $usuario['telefono'];
            $_SESSION['usuario_rol'] = $usuario['rol'];
            $_SESSION['usuario_bloqueado'] = (int)($usuario['bloqueado'] ?? 0);
        } else {
            $_SESSION['usuario_id'] = null;
            $_SESSION['usuario_nombre'] = null;
            $_SESSION['usuario_email'] = null;
            $_SESSION['usuario_telefono'] = null;
            $_SESSION['usuario_rol'] = null;
            $_SESSION['usuario_bloqueado'] = null;
        }

        // Generar fechas de la semana laboral (lunes a viernes)
        $fechas_semana = $this->generarFechasSemanaLaboral();
        $hoy = date('Y-m-d');

        // Obtener todas las reservas de la semana para carros
        $fechas_str = "'" . implode("','", array_keys($fechas_semana)) . "'";
        $espacios_ocupados_semana = db()->query(
            "SELECT numero_espacio, usuario_id, fecha_reserva FROM reservas 
             WHERE fecha_reserva IN ($fechas_str) AND tipo_vehiculo = 'carro' AND estado = 'activa'"
        )->get();

        // Organizar espacios ocupados por fecha
        $ocupados_por_fecha = [];
        foreach ($espacios_ocupados_semana as $espacio) {
            $ocupados_por_fecha[$espacio['fecha_reserva']][$espacio['numero_espacio']] = $espacio['usuario_id'];
        }

        // Obtener espacios ocupados para motos de toda la semana
        $motos_ocupadas_semana = db()->query(
            "SELECT numero_espacio, fecha_reserva, COUNT(*) as ocupados FROM reservas 
             WHERE fecha_reserva IN ($fechas_str) AND tipo_vehiculo = 'moto' AND estado = 'activa' 
             GROUP BY numero_espacio, fecha_reserva"
        )->get();

        // Organizar motos ocupadas por fecha
        $moto_ocupados_por_fecha = [];
        foreach ($motos_ocupadas_semana as $moto) {
            $moto_ocupados_por_fecha[$moto['fecha_reserva']][$moto['numero_espacio']] = $moto['ocupados'];
        }

        // Obtener espacios ocupados para motos grandes de toda la semana
        $motos_grandes_ocupadas_semana = db()->query(
            "SELECT numero_espacio, usuario_id, fecha_reserva FROM reservas 
             WHERE fecha_reserva IN ($fechas_str) AND tipo_vehiculo = 'moto_grande' AND estado = 'activa'"
        )->get();

        // Organizar motos grandes ocupadas por fecha
        $moto_grande_ocupados_por_fecha = [];
        foreach ($motos_grandes_ocupadas_semana as $moto_grande) {
            $moto_grande_ocupados_por_fecha[$moto_grande['fecha_reserva']][$moto_grande['numero_espacio']] = $moto_grande['usuario_id'];
        }

        // Crear mapas de ocupación para hoy (para mostrar en la vista)
        $ocupados_map = $ocupados_por_fecha[$hoy] ?? [];
        $moto_ocupados = $moto_ocupados_por_fecha[$hoy] ?? [];
        $moto_grande_ocupados_map = $moto_grande_ocupados_por_fecha[$hoy] ?? [];

        // Obtener reservas de toda la semana
        $reservas_semana = [];
        foreach ($fechas_semana as $fecha => $info) {
            if ($_SESSION['usuario_rol'] == 'admin') {

                // Admin ve todas las reservas
                $reservas = db()->query(
                    'SELECT 
                        r.*, 
                        CONCAT(
                            u.p_nombre, " ",
                            IFNULL(u.s_nombre, ""), " ",
                            u.p_apellido, " ",
                            IFNULL(u.s_apellido, "")
                        ) AS nombres,
                        u.email 
                     FROM reservas r 
                     JOIN usuarios u ON r.usuario_id = u.id 
                     WHERE r.fecha_reserva = :fecha AND r.estado = "activa" 
                     ORDER BY r.numero_espacio',
                    ['fecha' => $fecha]
                )->get();
            } elseif ($_SESSION['usuario_rol']) {
                // Usuario normal solo ve sus reservas
                $reservas = db()->query(
                    'SELECT 
                        r.*,
                        CONCAT(
                            u.p_nombre, " ",
                            IFNULL(u.s_nombre, ""), " ",
                            u.p_apellido, " ",
                            IFNULL(u.s_apellido, "")
                        ) AS nombres
                     FROM reservas r
                     INNER JOIN usuarios u ON r.usuario_id = u.id
                     WHERE r.fecha_reserva = :fecha
                        AND r.usuario_id = :usuario_id
                        AND r.estado = "activa" 
                     ORDER BY r.numero_espacio',
                    [
                        'fecha' => $fecha,
                        'usuario_id' => $currentUser['id']
                    ]
                )->get();
            } else {
                $reservas = [];
            }
            $reservas_semana[$fecha] = $reservas;
        }

        // Obtener lista de usuarios para admin
        $usuarios = [];
        if ($_SESSION['usuario_rol'] == 'admin') {
            $usuarios = db()->query('SELECT id,
                                            CONCAT(
                                                p_nombre, " ",
                                                IFNULL(CONCAT(s_nombre, " "), ""),
                                                p_apellido, " ",
                                                IFNULL(CONCAT(s_apellido, " "), "")
                                            ) AS nombres
                                            FROM usuarios
                                            ORDER BY p_nombre, p_apellido')->get();
        }

        // Procesar reservas si se envió el formulario
        $mensaje = null;
        $tipo_mensaje = null;

        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action']) && $_POST['action'] == 'reservar') {
            try {
                $numero_espacio = $_POST['numero_espacio'];
                $tipo_vehiculo = $_POST['tipo_vehiculo'];
                $fecha_reserva = $_POST['fecha_reserva'];
                $placa_vehiculo = strtoupper(trim($_POST['placa_vehiculo']));
                
                $fecha_reserva = $this->convertirFormatoFecha($fecha_reserva);
                
                // Determinar el usuario (admin puede reservar para otros)
                //$usuario_reserva = ($_SESSION['usuario_rol'] == 'admin' && !empty($_POST['usuario_id'])) 
                    //? (int)$_POST['usuario_id'] 
                    //: (int)($currentUser['id'] ?? 0);
                if ($_SESSION['usuario_rol'] === 'admin') {
                    if (empty($_POST['usuario_id'])) {
                        throw new Exception("Debe seleccionar un usuario para la reserva");
                    }
                    $usuario_reserva = (int) $_POST['usuario_id'];
                } else {
                    $usuario_reserva = (int) ($currentUser['id'] ?? 0);
                }

                if (!$usuario_reserva) {
                    throw new \Exception("Debe iniciar sesión para hacer reservas");
                }

                // Validar bloqueo del usuario destino de la reserva (aplica tanto para usuario normal como para admin creando para otro)
                $usuarioDestino = db()->query('SELECT bloqueado FROM usuarios WHERE id = :id', ['id' => $usuario_reserva])->first();
                if ($usuarioDestino && (int)($usuarioDestino['bloqueado'] ?? 0) === 1) {
                    throw new \Exception("El usuario está bloqueado y no puede realizar reservas");
                }

                // Verificar que el usuario no tenga ya una reserva para esa fecha
                //Solo aplica para usuarios normales, no para admin
                if ($_SESSION['usuario_rol'] !== 'admin') {
                    $reserva_existente = db()->query(
                        'SELECT id FROM reservas 
                        WHERE usuario_id = :usuario_id AND (fecha_reserva) = :fecha AND estado = "activa"',
                        [
                            'usuario_id' => $usuario_reserva,
                            'fecha' => $fecha_reserva
                        ]

                    )->first();

                    if ($reserva_existente) {
                        throw new \Exception("Ya tienes una reserva para esta fecha. Solo se permite una reserva por día.");
                    }
                }

                //VALIDACION PREVIA de cupos antes de la transaccion
                $maxCupos = $this->obtenerMaxCupos($tipo_vehiculo, $numero_espacio);
        
                $ocupados_previo = db()->query(
                    'SELECT COUNT(*) as total FROM reservas
                    WHERE numero_espacio = :espacio
                    AND fecha_reserva = :fecha
                    AND estado = "activa"
                    AND tipo_vehiculo = :tipo',
                    [
                        'espacio' => $numero_espacio,
                        'fecha' => $fecha_reserva,
                        'tipo' => $tipo_vehiculo
                    ]

                )->first();

                if ((int)($ocupados_previo ['total'] ?? 0) >= $maxCupos) {
                    throw new \Exception("No hay cupos disponibles en el espacio $numero_espacio.");
                }


                // Verificar disponibilidad del espacio
                db()->beginTransaction();
                try {
                    //Lock de registros del espacio en esa fecha
                    $ocupados = db()->query(
                        'SELECT COUNT(*) as total FROM reservas
                        WHERE numero_espacio = :espacio
                        AND fecha_reserva = :fecha
                        AND estado = "activa"
                        AND tipo_vehiculo = :tipo
                        FOR UPDATE',
                        [
                            'espacio' => $numero_espacio,
                            'fecha' => $fecha_reserva,
                            'tipo' => $tipo_vehiculo
                        ]
                    )->first();

                    $totalOcupados = (int)($ocupados['total'] ?? 0);

                    if ($totalOcupados >= $maxCupos) {
                        db()->rollBack();
                        throw new \Exception("No hay cupos disponibles en el espacio $numero_espacio. ($totalOcupados/$maxCupos ocupados)");
                    }
                    
                    // Insert protegido
                    db()->query(
                        'INSERT INTO reservas
                        (usuario_id, numero_espacio, tipo_vehiculo, fecha_reserva, placa_vehiculo, estado, fecha_creacion)
                        VALUES (:usuario_id, :numero_espacio, :tipo_vehiculo, :fecha_reserva, :placa_vehiculo, "activa", NOW())',
                        [
                            'usuario_id' => $usuario_reserva,
                            'numero_espacio' => $numero_espacio,
                            'tipo_vehiculo' => $tipo_vehiculo,
                            'fecha_reserva' => $fecha_reserva,
                            'placa_vehiculo' => $placa_vehiculo
                        ]
                    );

                    db()->commit();

                } catch (\Exception $e) {
                    db()->rollBack();
                    throw $e;
                }

                redirect('/', "Reserva creada exitosamente para el espacio $numero_espacio.", 'success');
                
            } catch (\PDOException $e) {

                $mensaje = ($e->getCode() === 23000)
                    ? "Ya tienes una reserva para este día. No puedes crear más de una."
                    : "Error al crear la reserva: " . $e->getMessage();
                redirect('/', $mensaje, 'error');

            } catch (\Exception $e) {

                redirect('/', $e->getMessage(), 'error');

            }
        }

        // Extraer reservas de hoy y mañana
        $hoy = date('Y-m-d');
        $manana = date('Y-m-d', strtotime('+1 day'));
        
        $reservas_hoy = isset($reservas_semana[$hoy]) ? $reservas_semana[$hoy] : [];
        $reservas_manana = isset($reservas_semana[$manana]) ? $reservas_semana[$manana] : [];

        $mensaje = session()->getFlash('message');
        $tipo_mensaje = session()->getFlash('type');

        // Cargar la vista con todos los datos necesarios
        view('home', [
            'title' => 'Agendar Parqueadero',
            'fechas_semana' => $fechas_semana,
            'ocupados_por_fecha' => $ocupados_por_fecha,
            'moto_ocupados_por_fecha' => $moto_ocupados_por_fecha,
            'moto_grande_ocupados_por_fecha' => $moto_grande_ocupados_por_fecha,
            'reservas_semana' => $reservas_semana,
            'reservas_hoy' => $reservas_hoy,
            'reservas_manana' => $reservas_manana,
            'usuarios' => $usuarios,
            'hoy' => $hoy,
            'mensaje' => $mensaje,
            'tipo_mensaje' => $tipo_mensaje,
            // Agregar estos mapas para la vista
            'ocupados_map' => $ocupados_map,
            'moto_ocupados' => $moto_ocupados,
            'moto_grande_ocupados_map' => $moto_grande_ocupados_map,
            'usuario_bloqueado' => (int)($_SESSION['usuario_bloqueado'] ?? 0)
        ]);
    }

    /**
     * Endpoint JSON para consultar disponibilidad por fecha
     * GET /api/disponibilidad?fecha=YYYY-MM-DD
     */
    public function availability()
    {
        // Asegurar cabeceras JSON siempre
        header('Content-Type: application/json; charset=utf-8');

        try {
            $fecha_param = $_GET['fecha'] ?? '';
            if (!$fecha_param) {
                http_response_code(400);
                echo json_encode(['error' => 'Parámetro fecha es requerido']);
                return;
            };

            $fecha = $this->convertirFormatoFecha($fecha_param);

            $currentUser = session()->get('user');
            $currentUserId = $currentUser['id'] ?? ($_SESSION['usuario_id'] ?? null);

            // Carros: espacios ocupados por usuario
            $carros = db()->query(
                "SELECT numero_espacio, usuario_id FROM reservas \n                 WHERE fecha_reserva = :fecha AND tipo_vehiculo = 'carro' AND estado = 'activa'",
                ['fecha' => $fecha]
            )->get();

            $carro_ocupados = [];
            $carro_seleccionados_usuario = [];
            foreach ($carros as $c) {
                $num = (int) $c['numero_espacio'];
                $carro_ocupados[] = $num;
                if ($currentUserId && (int) $c['usuario_id'] === (int) $currentUserId) {
                    $carro_seleccionados_usuario[] = $num;
                }
            }

            // Motos: conteo por espacio
            $motos = db()->query(
                "SELECT numero_espacio, COUNT(*) as ocupados FROM reservas \n                 WHERE fecha_reserva = :fecha AND tipo_vehiculo = 'moto' AND estado = 'activa'\n                 GROUP BY numero_espacio",
                ['fecha' => $fecha]
            )->get();

            $moto_cupos = [];
            foreach ($motos as $m) {
                $moto_cupos[(string) $m['numero_espacio']] = (int) $m['ocupados'];
            }

            $moto_seleccionados_usuario = [];
            if ($currentUserId) {
                $motos_usuario = db()->query(
                    "SELECT numero_espacio FROM reservas 
                    WHERE fecha_reserva = :fecha AND tipo_vehiculo = 'moto' AND estado = 'activa' AND usuario_id = :uid",
                    ['fecha' => $fecha, 'uid' => $currentUserId]
                )->get();
                foreach ($motos_usuario as $mu) {
                    $moto_seleccionados_usuario[] = (string) $mu['numero_espacio'];
                }
            }

            // Definición de cupos máximos (alineado con el template actual)
            $moto_maximos = [
                '476' => 7,
                '475' => 7,
                '474' => 7,
                '441' => 5,
                '001' => 4,
                '002' => 3
            ];

            // Motos grandes: conteo por espacio (máximo 2 por espacio)
            $motos_grandes_conteo = db()->query(
                "SELECT numero_espacio, COUNT(*) as ocupados FROM reservas \n                 WHERE fecha_reserva = :fecha AND tipo_vehiculo = 'moto_grande' AND estado = 'activa'\n                 GROUP BY numero_espacio",
                ['fecha' => $fecha]
            )->get();

            $moto_grande_cupos = [];
            foreach ($motos_grandes_conteo as $mgc) {
                $moto_grande_cupos[(string) $mgc["numero_espacio"]] = (int) $mgc["ocupados"];
            }

            // Motos grandes: espacios seleccionados por el usuario actual
            $moto_grande_seleccionados_usuario = [];
            if ($currentUserId) {
                $motos_grandes_usuario = db()->query(
                    "SELECT numero_espacio FROM reservas \n                     WHERE fecha_reserva = :fecha AND tipo_vehiculo = 'moto_grande' AND estado = 'activa' AND usuario_id = :uid",
                    ['fecha' => $fecha, 'uid' => $currentUserId]
                )->get();
                foreach ($motos_grandes_usuario as $mgu) {
                    $moto_grande_seleccionados_usuario[] = (int) $mgu['numero_espacio'];
                }
            }

            // Definición de cupos máximos para motos grandes
            $moto_grande_maximos = [
                '270' => 2,
                '271' => 2,
                '272' => 2,
            ];

            echo json_encode([
                'fecha' => $fecha,
                'carro' => [
                    'ocupados' => $carro_ocupados,
                    'seleccionados_usuario' => $carro_seleccionados_usuario,
                ],
                'moto' => [
                    'ocupados' => $moto_cupos,
                    'maximos' => $moto_maximos,
                    'seleccionados_usuario' => $moto_seleccionados_usuario,
                ],
                'moto_grande' => [
                    'ocupados' => $moto_grande_cupos,
                    'maximos' => $moto_grande_maximos,
                    'seleccionados_usuario' => $moto_grande_seleccionados_usuario,
                ],
            ]);
        } catch (\Throwable $e) {
            http_response_code(500);
            echo json_encode(['error' => 'Error interno', 'detail' => $e->getMessage()]);
        }
    }

    /**
     * Verifica si una fecha es día hábil (lunes a viernes)
     */
    private function esDiaHabil($fecha)
    {
        $dia_semana = date('N', strtotime($fecha)); // 1 = lunes, 7 = domingo
        return $dia_semana >= 1 && $dia_semana <= 5;
    }

    /**
     * Genera las fechas de la semana laboral actual (lunes a viernes)
     */
    private function generarFechasSemanaLaboral()
    {
        $fechas = [];
        $hoy = new \DateTime();
        
        // Encontrar el lunes de esta semana
        $lunes = clone $hoy;
        $dia_semana = $lunes->format('N'); // 1 = lunes, 7 = domingo
        
        if ($dia_semana > 1) {
            $lunes->sub(new \DateInterval('P' . ($dia_semana - 1) . 'D'));
        }
        
        // Generar fechas de lunes a viernes
        $dias_semana = ['Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes'];
        
        for ($i = 0; $i < 5; $i++) {
            $fecha = clone $lunes;
            $fecha->add(new \DateInterval('P' . $i . 'D'));
            
            $fecha_str = $fecha->format('Y-m-d');
            $fechas[$fecha_str] = [
                'fecha' => $fecha_str,
                'dia_nombre' => $dias_semana[$i],
                'dia_mes' => $fecha->format('d'),
                'mes_nombre' => $this->obtenerNombreMes($fecha->format('n')),
                'es_hoy' => $fecha_str === date('Y-m-d'),
                'es_pasado' => $fecha_str < date('Y-m-d')
            ];
        }
        
        return $fechas;
    }

    /**
     * Obtiene el nombre del mes en español
     */
    private function obtenerNombreMes($numero_mes)
    {
        $meses = [
            1 => 'Enero', 2 => 'Febrero', 3 => 'Marzo', 4 => 'Abril',
            5 => 'Mayo', 6 => 'Junio', 7 => 'Julio', 8 => 'Agosto',
            9 => 'Septiembre', 10 => 'Octubre', 11 => 'Noviembre', 12 => 'Diciembre'
        ];
        return $meses[$numero_mes];
    }

    /**
     * Formatea una fecha para mostrar de forma legible
     */
    private function formatearFecha($fecha)
    {
        $timestamp = strtotime($fecha);
        $dia_nombre = $this->obtenerNombreDia(date('N', $timestamp));
        $dia = date('d', $timestamp);
        $mes = $this->obtenerNombreMes(date('n', $timestamp));
        
        return "$dia_nombre $dia de $mes";
    }

    /**
     * Obtiene el nombre del día en español
     */
    private function obtenerNombreDia($numero_dia)
    {
        $dias = [
            1 => 'Lunes', 2 => 'Martes', 3 => 'Miércoles', 4 => 'Jueves',
            5 => 'Viernes', 6 => 'Sábado', 7 => 'Domingo'
        ];
        return $dias[$numero_dia];
    }

    public function show()
    {
        if (!isAuthenticated()) {
            redirect('login');
        }

        $home = db()->query('SELECT * FROM usuarios WHERE id = :id', [
            'id' => $_GET['id'] ?? null,
        ])->firstOrFail();
        
        return $home;
    }

    private function obtenerMaxCupos(string $tipo, string $espacio): int
    {
        if ($tipo === 'carro') {
            return 1;
        }

        if ($tipo === 'moto_grande') {
            return 2;
        }

        // Moto normal
        $cupos = [
            '476' => 7,
            '476a' => 1,
            '475' => 7,
            '475a' => 1,
            '474' => 7,
            '474b' => 1,
            '474a' => 1,
            '441' => 5,
            '001' => 5,
            '002' => 5
        ];

        return $cupos[$espacio] ?? 1;
    }

    
    private function enviarCorreoConfirmacion($to, $nombre, $datosReserva)
    {
        $mail = new PHPMailer(true);
        
        try {
            // Configuración SMTP (usando tus datos)
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'killiam1119@gmail.com';
            $mail->Password = 'oqon pjgg ekvm yptj';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;
            $mail->CharSet = 'UTF-8';
            $mail->Encoding = 'base64';
            $mail->SMTPOptions = [
                'ssl' => [
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => true
                ]
            ];
            
            // Configuración del correo
            $mail->setFrom('killiam1119@gmail.com', 'Sistema de Parqueadero');
            $mail->addAddress($to, $nombre);
            $mail->isHTML(true);
            $mail->Subject = 'Confirmación de Reserva de Parqueadero';

            // Cuerpo del mensaje
            $mail->Body = $this->crearCuerpoHTML($nombre, $datosReserva);
            $mail->AltBody = $this->crearTextoPlano($nombre, $datosReserva);

            $mail->send();
            return true;
        } catch (Exception $e) {
            error_log('Error al enviar correo: ' . $e->getMessage());
            return false;
        }
    }

    private function crearCuerpoHTML($nombre, $datosReserva)
    {
        // Formatear la fecha para el correo
        $fechaFormateada = $this->formatearFecha($datosReserva['fecha']);
        
        return '
        <div style="max-width: 500px; margin: 0 auto; background: #fff; border-radius: 12px; box-shadow: 0 2px 12px rgba(44,62,80,0.08); font-family: Arial, sans-serif; overflow: hidden;">
            <div style="background: #3498db; padding: 24px 0; text-align: center;">
                <img src="https://img.icons8.com/color/96/000000/car--v1.png" alt="Logo Auto" style="width: 64px; height: 64px; margin-bottom: 10px;">
                <h1 style="color: #fff; margin: 0; font-size: 2em;">¡Reserva Confirmada!</h1>
            </div>
            <div style="padding: 30px 24px 24px 24px; color: #333;">
                <p style="font-size: 1.1em;">Hola <strong>' . htmlspecialchars($nombre) . '</strong>,</p>
                <p style="margin-bottom: 18px;">Tu reserva de parqueadero se ha registrado correctamente. Aquí tienes los detalles:</p>
                <table style="width: 100%; border-collapse: collapse; margin-bottom: 18px;">
                    <tr>
                        <td style="padding: 8px 0; font-weight: bold;">Fecha:</td>
                        <td style="padding: 8px 0;">' . htmlspecialchars($fechaFormateada) . '</td>
                    </tr>
                    <tr>
                        <td style="padding: 8px 0; font-weight: bold;">Espacio:</td>
                        <td style="padding: 8px 0;">' . htmlspecialchars($datosReserva['numero_espacio']) . '</td>
                    </tr>
                    <tr>
                        <td style="padding: 8px 0; font-weight: bold;">Placa:</td>
                        <td style="padding: 8px 0;">' . htmlspecialchars($datosReserva['placa']) . '</td>
                    </tr>
                    <tr>
                        <td style="padding: 8px 0; font-weight: bold;">Tipo de vehículo:</td>
                        <td style="padding: 8px 0;">' . htmlspecialchars($datosReserva['tipo_vehiculo']) . '</td>
                    </tr>
                </table>
                <div style="background: #e8f4f8; border-left: 4px solid #3498db; padding: 12px 18px; border-radius: 6px; margin-bottom: 18px;">
                    <strong>Recuerda:</strong> Presenta este correo si te lo solicitan en la entrada.
                </div>
                <p style="font-size: 0.95em; color: #888; margin-bottom: 0;">Gracias por usar el Sistema de Parqueadero.<br>Este es un correo automático, por favor no respondas a este mensaje.</p>
            </div>
        </div>';
    }

    private function crearTextoPlano($nombre, $datosReserva)
    {
        $fechaFormateada = $this->formatearFecha($datosReserva['fecha']);
        
        return "Confirmación de Reserva\n\n" .
               "Hola {$p_nombre},\n\n" .
               "Tu reserva ha sido registrada con éxito:\n\n" .
               "Fecha: {$fechaFormateada}\n" .
               "Espacio: {$datosReserva['numero_espacio']}\n" .
               "Placa: {$datosReserva['placa']}\n" .
               "Tipo de vehículo: {$datosReserva['tipo_vehiculo']}\n\n" .
               "Recuerda: Presenta este correo si te lo solicitan en la entrada.\n\n" .
               "Gracias por usar el Sistema de Parqueadero.\n" .
               "Este es un mensaje automático, por favor no respondas a este correo.";
    }

    /**
     * Convierte fecha de formato MM/DD/YYYY a YYYY-MM-DD
     */
    private function convertirFormatoFecha($fecha)
    {
        // Si la fecha ya está en formato YYYY-MM-DD, devolverla tal como está
        if (preg_match('/^\d{4}-\d{2}-\d{2}$/', $fecha)) {
            return $fecha;
        }
        
        // Si está en formato MM/DD/YYYY, convertirla
        if (preg_match('/^(\d{1,2})\/(\d{1,2})\/(\d{4})$/', $fecha, $matches)) {
            $mes = str_pad($matches[1], 2, '0', STR_PAD_LEFT);
            $dia = str_pad($matches[2], 2, '0', STR_PAD_LEFT);
            $año = $matches[3];
            return "$año-$mes-$dia";
        }
        
        // Si no coincide con ningún formato esperado, intentar con strtotime
        $timestamp = strtotime($fecha);
        if ($timestamp !== false) {
            return date('Y-m-d', $timestamp);
        }
        
        // Si todo falla, devolver la fecha original
        return $fecha;
    }
}
