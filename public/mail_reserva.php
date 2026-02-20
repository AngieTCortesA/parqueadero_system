<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require __DIR__ . '/../vendor/autoload.php'; // Ajusta la ruta si es necesario

function enviarCorreoReserva($to, $nombre, $datosReserva) {
    $mail = new PHPMailer(true);
    try {
        // Configuración SMTP
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
        $mail->setFrom('killiam1119@gmail.com', 'Sistema de Parqueadero');
        $mail->addAddress($to, $nombre);
        $mail->isHTML(true);
        $mail->Subject = 'Confirmación de Reserva de Parqueadero';

        $mail->Body = '
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
                        <td style="padding: 8px 0;">' . htmlspecialchars($datosReserva['fecha']) . '</td>
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
                    <strong>Recuerda:</strong> Llega puntual y presenta este correo si te lo solicitan en la entrada.
                </div>
                <p style="font-size: 0.95em; color: #888; margin-bottom: 0;">Gracias por usar el Sistema de Parqueadero.<br>Este es un correo automático, por favor no respondas a este mensaje.</p>
            </div>
        </div>
        ';
        $mail->AltBody = "Reserva realizada para el {$datosReserva['fecha']}, placa: {$datosReserva['placa']}, tipo de vehículo: {$datosReserva['tipo_vehiculo']}.";

        $mail->send();
        return true;
    } catch (Exception $e) {
        error_log('Error al enviar correo de reserva: ' . $mail->ErrorInfo);
        return false;
    }
}