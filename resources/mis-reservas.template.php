<?php require __DIR__ . '/partials/header.php'; ?>

<div class="min-h-screen bg-gradient-to-br from-blue-50 via-indigo-50 to-purple-50">
    <div class="container mx-auto px-4 py-8">
        <div class="border-b border-gray-200 pb-8 mb-8">
            <div class="flex flex-col items-center">
                <div class="flex items-center gap-4">
                    <img src="assets/images/3shape-intraoral-logo.png" alt="3Shape Logo" class="w-12 h-12">
                    <h1 class="text-4xl font-bold text-gray-900"><?php echo $_SESSION['usuario_rol'] == 'admin' ? 'Todas las Reservas' : 'Mis Reservas'; ?></h1>
                </div>
                <p class="mt-2 text-lg text-gray-500"><?php echo $_SESSION['usuario_rol'] == 'admin' ? 'Gestiona y visualiza todas las reservas del parqueadero' : 'Gestiona tus reservas de parqueadero'; ?></p>
            </div>
        </div>

        <!-- Navigation (only for admin) -->
        <?php if (isset($_SESSION['usuario_rol']) && $_SESSION['usuario_rol'] == 'admin'): ?>
        <div class="flex justify-center space-x-4 mb-8">
            <a href="/usuarios" class="inline-block px-4 py-2 mx-2 text-red-700 border border-red-700 rounded hover:bg-red-700 hover:text-white transition">
                Usuarios
            </a>
            <a href="/admin" class="inline-block px-4 py-2 mx-2 text-red-700 border border-red-700 rounded hover:bg-red-700 hover:text-white transition">
                Administración
            </a>
        </div>
        <?php endif; ?>

        <!-- Messages -->
        <?php if (isset($mensaje) && !empty($mensaje)): ?>
        <div class="mb-8">
            <div class="<?php echo $tipo_mensaje == 'success' ? 'bg-green-50 border-green-200 text-green-800' : 'bg-red-50 border-red-200 text-red-800'; ?> border-l-4 <?php echo $tipo_mensaje == 'success' ? 'border-l-green-500' : 'border-l-red-500'; ?> p-4 rounded-lg shadow-sm">
                <div class="flex items-center">
                    <?php if ($tipo_mensaje == 'success'): ?>
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                    </svg>
                    <?php else: ?>
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                    </svg>
                    <?php endif; ?>
                    <span class="font-medium"><?php echo htmlspecialchars($mensaje); ?></span>
                </div>
            </div>
        </div>
        <?php endif; ?>

        <!-- Reservations Content -->
        <?php if (empty($reservas_por_fecha)): ?>
        <!-- No reservations state -->
        <div class="bg-white rounded-2xl shadow-xl p-12 text-center border border-gray-100">
            <div class="inline-flex items-center justify-center w-24 h-24 bg-gray-100 rounded-full mb-6">
                <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                </svg>
            </div>
            <h3 class="text-2xl font-bold text-gray-700 mb-3">No hay reservas registradas</h3>
            <p class="text-gray-500 text-lg mb-6">
                <?php echo $_SESSION['usuario_rol'] == 'admin' ? 'Aún no se han realizado reservas en el sistema.' : 'Aún no has realizado ninguna reserva.'; ?>
            </p>
            <?php if ($_SESSION['usuario_rol'] != 'admin'): ?>
            <a href="/" class="inline-flex items-center px-6 py-3 bg-red-700 text-white rounded-lg shadow-lg">
                <svg class="w-5 h-5 mr-2 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                <span>
                Hacer primera reserva
                </span>
            </a>
            <?php endif; ?>
        </div>
        <?php else: ?>
        <!-- Reservations by date -->
        <div class="space-y-8">
            <?php foreach ($reservas_por_fecha as $fecha => $reservas_fecha): ?>
            <div class="bg- rounded-2xl shadow-xl overflow-hidden border border-gray-100">
                <!-- Date header -->
                <div class="bg-gradient-to-r from-blue-500 to-indigo-600 p-6">
                    <div class="flex items-center justify-between text-black">
                        <div class="flex items-center">
                            <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            <h2 class="text-xl font-bold">
                                <?php 
                                // Función moderna para formatear fechas en español
                                $fecha_obj = new DateTime($fecha);
                                $dias = ['domingo', 'lunes', 'martes', 'miércoles', 'jueves', 'viernes', 'sábado'];
                                $meses = ['enero', 'febrero', 'marzo', 'abril', 'mayo', 'junio', 'julio', 'agosto', 'septiembre', 'octubre', 'noviembre', 'diciembre'];
                                
                                $dia_semana = $dias[$fecha_obj->format('w')];
                                $dia = $fecha_obj->format('d');
                                $mes = $meses[$fecha_obj->format('n') - 1];
                                $año = $fecha_obj->format('Y');
                                
                                echo ucfirst($dia_semana) . ', ' . $dia . ' de ' . $mes . ' de ' . $año;
                                ?>
                            </h2>
                        </div>
                        <div class="text-right">
                            <div class="text-sm opacity-90"><?php echo count($reservas_fecha); ?> reserva(s)</div>
                            <?php if (function_exists('getCuposDisponibles')): ?>
                            <div class="text-sm opacity-90"><?php echo getCuposDisponibles($fecha); ?> cupos disponibles</div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                <!-- Reservations list -->
                <div class="p-6 space-y-4">
                    <?php foreach ($reservas_fecha as $reserva): ?>
                    <div class="<?php echo $reserva['estado'] == 'activa' ? 'border-l-blue-500 bg-blue-50' : ($reserva['estado'] == 'cancelada' ? 'border-l-red-500 bg-red-50' : 'border-l-gray-500 bg-gray-50'); ?> border-l-4 rounded-lg p-4 transition-all duration-300 hover:shadow-md">
                        <div class="flex items-start justify-between">
                            <div class="flex-1">
                                <div class="flex items-center mb-2">
                                    <h4 class="text-lg font-semibold text-gray-800 mr-3"><?php echo htmlspecialchars($reserva['nombre']); ?></h4>
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium <?php echo $reserva['estado'] == 'activa' ? 'bg-blue-100 text-blue-800' : ($reserva['estado'] == 'cancelada' ? 'bg-red-100 text-red-800' : 'bg-gray-100 text-gray-800'); ?>">
                                        <?php echo ucfirst($reserva['estado']); ?>
                                    </span>
                                </div>
                                
                                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-3 text-sm text-gray-600">
                                    
                                    <div class="flex items-center">
                                        <svg class="w-4 h-4 mr-2 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                        </svg>
                                        <span><strong>Placa:</strong> <?php echo htmlspecialchars($reserva['placa_vehiculo']); ?></span>
                                    </div>
                                    
                                    <div class="flex items-center">
                                        <svg class="w-4 h-4 mr-2 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        </svg>
                                        <span><strong>Espacio:</strong> <?php echo htmlspecialchars($reserva['numero_espacio']); ?></span>
                                    </div>
                                     <div class="flex items-center">
                                        <svg class="w-4 h-4 mr-2 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"></path>
                                        </svg>
                                        <span><strong>Email:</strong> <?php echo htmlspecialchars($reserva['email']); ?></span>
                                    </div>
                                    
                                    <div class="flex items-center">
                                        <svg class="w-4 h-4 mr-2 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                        </svg>
                                        <span><strong>Reservado:</strong> <?php 
                                            // Asegurar zona horaria de Bogotá para mostrar la fecha de creación
                                            $fecha_bogota = new DateTime($reserva['fecha_creacion']);
                                            $fecha_bogota->setTimezone(new DateTimeZone('America/Bogota'));
                                            echo $fecha_bogota->format('d/m/Y H:i');
                                         ?></span>
                                    </div>
                                    
                                    <div class="flex items-center">
                                        <svg class="w-4 h-4 mr-2 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                        </svg>
                                        <span><strong>Para el día:</strong> <?php echo date('d/m/Y', strtotime($reserva['fecha_reserva'])); ?></span>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Cancel button -->
                            <?php if ($reserva['estado'] == 'activa' && $reserva['fecha_reserva'] >= date('Y-m-d')): ?>
                                <?php if (
                                    (isset($_SESSION['usuario_rol']) && $_SESSION['usuario_rol'] == 'admin') ||
                                    (isset($_SESSION['usuario_id']) && $reserva['usuario_id'] == $_SESSION['usuario_id'])
                                ): ?>
                                <div class="ml-4">
                                    <form method="POST" action="/mis-reservas" class="inline-block">
                                        <input type="hidden" name="action" value="cancelar">
                                        <input type="hidden" name="reserva_id" value="<?php echo $reserva['id']; ?>">
                                        <button type="submit" 
                                                onclick="return confirm('¿Estás seguro de que quieres cancelar esta reserva?')"
                                                class="inline-flex items-center px-4 py-2 bg-red-700 text-white text-sm font-medium rounded-lg hover:bg-red-600 transform hover:transition-all duration-300 shadow-md hover:bg-red-800">
                                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                            </svg>
                                            Cancelar
                                        </button>
                                    </form>
                                </div>
                                <?php endif; ?>
                            <?php endif; ?>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>

       <div class="text-center mt-8">
            <a href="/" 
            class="inline-flex items-center gap-2 px-6 py-3 bg-white text-gray-700 border border-gray-200 rounded-lg shadow-sm hover:shadow-md transform hover:-translate-y-1 active:translate-y-0 transition-all duration-200">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Volver al Dashboard
            </a>
        </div>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
<script src="js/dropdown.js"></script>
<?php require __DIR__ . '/partials/new.footer.php'; ?>