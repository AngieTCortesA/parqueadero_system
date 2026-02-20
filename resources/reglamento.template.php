<?php require resource_path('partials/header.php'); ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reglamento de Uso de Parqueaderos - 3Shape</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        '3shape-blue': '#003366',
                        '3shape-red': '#bb3d3d',
                        '3shape-light': '#f5f7fa'
                    }
                }
            }
        }
    </script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
        body {
            font-family: 'Inter', sans-serif;
        }
        .policy-section {
            border-left: 4px solid #003366;
        }
    </style>
</head>
<body class="bg-3shape-light min-h-screen">
    <!-- Header Section -->
    <header class="bg-white shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
            <div class="flex justify-between items-center">
                <div>
                    <h1 class="text-3xl font-bold text-3shape-blue">Politica de Uso de Parqueaderos 3Shape</h1>
                    <p class="text-gray-600 mt-2">Política oficial de 3Shape Colombia</p>
                </div>
                <div class="bg-3shape-blue text-white px-4 py-2 rounded-lg">
                    <span class="text-sm font-semibold">Versión 1.0</span>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Objective Section -->
        <section class="bg-white rounded-lg shadow-md p-8 mb-8 policy-section">
            <div class="flex items-center mb-6">
                <div class="w-12 h-12 bg-3shape-blue rounded-lg flex items-center justify-center mr-4">
                    <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                    </svg>
                </div>
                <h2 class="text-2xl font-bold text-3shape-blue">1. Objetivo</h2>
            </div>
            <div class="pl-16">
                <p class="text-gray-700 leading-relaxed">
                    Establecer normas claras que garanticen el uso adecuado, seguro y ordenado de los espacios de estacionamiento asignados para 3Shape. Se busca garantizar la disponibilidad de espacios, priorizando el acceso y control exclusivos para los colaboradores lo cual contribuye a reducir el mal uso y promover eficientemente los espacios de parqueo, evitando bloqueos en las áreas, dando seguridad dentro de las instalaciones.
                </p>
            </div>
        </section>

        <!-- General Rules Section -->
        <section class="bg-white rounded-lg shadow-md p-8 mb-8">
            <div class="flex items-center mb-8">
                <div class="w-12 h-12 bg-3shape-blue rounded-lg flex items-center justify-center mr-4">
                    <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                    </svg>
                </div>
                <h2 class="text-2xl font-bold text-3shape-blue">2. Normas Generales</h2>
            </div>

            <!-- 2.1 Asignación de Espacios -->
            <div class="mb-8 pl-4">
                <h3 class="text-xl font-semibold text-gray-800 mb-4 flex items-center">
                    <span class="w-8 h-8 bg-3shape-blue text-white rounded-full flex items-center justify-center text-sm font-bold mr-3">2.1</span>
                    Asignación de Espacios de Estacionamiento
                </h3>
                <div class="bg-blue-50 rounded-lg p-6 space-y-4 ml-11">
                    <div class="flex items-start">
                        <div class="w-2 h-2 bg-3shape-blue rounded-full mt-2 mr-3 flex-shrink-0"></div>
                        <p class="text-gray-700">Para acceder a los parqueaderos de uso exclusivo de 3Shape los vehículos, previamente deberán ser <strong>registrados y autorizados</strong> por administración de 3Shape. Si no lo está puede incurrir en multas o pagos tarifarios al edificio. Todas las placas deben estar registradas y autorizadas (tenga esto en cuenta cuando cambie de vehículo).</p>
                    </div>
                    <div class="flex items-start">
                        <div class="w-2 h-2 bg-3shape-blue rounded-full mt-2 mr-3 flex-shrink-0"></div>
                        <p class="text-gray-700">Todos los espacios de estacionamiento son asignados exclusivamente a los colaboradores de 3Shape. Para estacionar los vehículos es necesario reservar por la aplicación los espacios con anterioridad.</p>
                    </div>
                    <div class="flex items-start">
                        <div class="w-2 h-2 bg-3shape-blue rounded-full mt-2 mr-3 flex-shrink-0"></div>
                        <p class="text-gray-700">En caso de que se complete el cupo de espacios de estacionamiento reservados, los colaboradores que deseen traer sus vehículos deberán estacionar en los parqueaderos de visitantes acogiéndose a la tarifa establecida por el edificio.</p>
                    </div>
                    <div class="flex items-start">
                        <div class="w-2 h-2 bg-3shape-blue rounded-full mt-2 mr-3 flex-shrink-0"></div>
                        <p class="text-gray-700">Cada colaborador tendrá una semana disponible para reservar con antelación y programe con tiempo los días que requiera el estacionamiento.</p>
                    </div>
                    <div class="bg-red-50 border border-red-200 rounded-lg p-4 mt-4">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 text-red-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16c-.77.833.192 2.5 1.732 2.5z"></path>
                            </svg>
                            <span class="font-semibold text-red-800">Importante:</span>
                        </div>
                        <p class="text-red-700 mt-2 ml-7">Si no va a asistir, por medio del aplicativo deberá cancelar la reserva. Si no lo hace y no asiste tendrá una suspensión del servicio por un mes.</p>
                    </div>
                </div>
            </div>

            <!-- 2.2 Zonas de No Estacionamiento -->
            <div class="mb-8 pl-4">
                <h3 class="text-xl font-semibold text-gray-800 mb-4 flex items-center">
                    <span class="w-8 h-8 bg-3shape-blue text-white rounded-full flex items-center justify-center text-sm font-bold mr-3">2.2</span>
                    Respeto por las Zonas de No Estacionamiento
                </h3>
                <div class="bg-red-50 rounded-lg p-6 space-y-4 ml-11">
                    <div class="flex items-start">
                        <div class="w-2 h-2 bg-red-600 rounded-full mt-2 mr-3 flex-shrink-0"></div>
                        <p class="text-gray-700">No se permite estacionar en zonas designadas como áreas de no estacionamiento, como pasillos de acceso, áreas de carga y descarga y zonas marcadas como prohibido estacionar.</p>
                    </div>
                    <div class="flex items-start">
                        <div class="w-2 h-2 bg-red-600 rounded-full mt-2 mr-3 flex-shrink-0"></div>
                        <p class="text-gray-700">No se permite estacionar en un parqueadero que no esté demarcado como de <strong>3Shape</strong>.</p>
                    </div>
                    <div class="flex items-start">
                        <div class="w-2 h-2 bg-red-600 rounded-full mt-2 mr-3 flex-shrink-0"></div>
                        <p class="text-gray-700">No se permite estacionar en lugares que no están designados para el tipo de vehículo del colaborador (por ejemplo, estacionar motos en espacios para autos o viceversa). Las motos de alto cilindraje tienen sus espacios designados, por ende, no está permitido que las de bajo cilindraje ocupen estos espacios y viceversa.</p>
                    </div>
                </div>
            </div>

            <!-- 2.3 Seguridad del Vehículo -->
            <div class="mb-8 pl-4">
                <h3 class="text-xl font-semibold text-gray-800 mb-4 flex items-center">
                    <span class="w-8 h-8 bg-3shape-blue text-white rounded-full flex items-center justify-center text-sm font-bold mr-3">2.3</span>
                    Seguridad del Vehículo
                </h3>
                <div class="bg-green-50 rounded-lg p-6 ml-11">
                    <div class="flex items-start">
                        <div class="w-2 h-2 bg-green-600 rounded-full mt-2 mr-3 flex-shrink-0"></div>
                        <p class="text-gray-700">Los colaboradores son responsables de la seguridad de sus vehículos. Se recomienda el uso de dispositivos de seguridad, como cerraduras o candados, cuando sea necesario y no dejar sus pertenencias a la mano como cascos, guantes, chaquetas, zapatos, maletas, etc.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Sanctions Section -->
        <section class="bg-white rounded-lg shadow-md p-8 mb-8">
            <div class="flex items-center mb-8">
                <div class="w-12 h-12 bg-3shape-red rounded-lg flex items-center justify-center mr-4">
                    <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16c-.77.833.192 2.5 1.732 2.5z"></path>
                    </svg>
                </div>
                <h2 class="text-2xl font-bold text-3shape-blue">3. Sanciones</h2>
            </div>

            <div class="grid md:grid-cols-2 gap-6">
                <div class="bg-red-50 border border-red-200 rounded-lg p-6">
                    <h3 class="font-bold text-red-800 mb-3 flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        Mal Parqueo
                    </h3>
                    <p class="text-gray-700 mb-3">En caso de infringir las normas establecidas (por ejemplo, estacionar en el parqueadero No designado a 3Shape, zonas prohibidas, ocupar espacios reservados sin autorización, o estacionarse fuera de los límites marcados), se aplicará una multa.</p>
                    <div class="bg-red-100 rounded-lg p-3">
                        <p class="font-bold text-red-800 text-center">Multa: 3 días de SMLMV</p>
                    </div>
                </div>

                <div class="bg-orange-50 border border-orange-200 rounded-lg p-6">
                    <h3 class="font-bold text-orange-800 mb-3 flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                        </svg>
                        Daño en Propiedad
                    </h3>
                    <p class="text-gray-700">Si el mal uso del estacionamiento por parte de un empleado resulta en daño a la infraestructura del edificio, o vehículos de otros usuarios, el empleado, visitante o contratista serán responsables de cubrir los costos de reparación o reemplazo. Esto incluye, pero no se limita a, daños causados por colisiones, derrame de líquidos o sustancias, y vandalismo.</p>
                </div>
            </div>
        </section>

        <!-- Procedure Section -->
        <section class="bg-white rounded-lg shadow-md p-8 mb-8">
            <div class="flex items-center mb-8">
                <div class="w-12 h-12 bg-3shape-blue rounded-lg flex items-center justify-center mr-4">
                    <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path>
                    </svg>
                </div>
                <h2 class="text-2xl font-bold text-3shape-blue">4. Procedimiento de Sanciones</h2>
            </div>

            <div class="space-y-6">
                <div class="flex items-start">
                    <div class="w-8 h-8 bg-3shape-blue text-white rounded-full flex items-center justify-center text-sm font-bold flex-shrink-0 mr-4">1</div>
                    <div>
                        <h3 class="font-semibold text-gray-800 mb-2">Verificación y Aviso al Infractor</h3>
                        <p class="text-gray-700">Una vez se tenga conocimiento del mal parqueo se informará al propietario del vehículo que figure en el sistema de control de acceso del edificio; el conductor dispone de <span class="font-bold text-blue-600">10 minutos</span> para mover el carro y liberar el garaje afectado. Si la conducta se corrige en este tiempo la multa no se cobrará. Pero si reincide en la falta deberá hacer el debido proceso de pago de esta.</p>
                    </div>
                </div>

                <div class="flex items-start">
                    <div class="w-8 h-8 bg-3shape-blue text-white rounded-full flex items-center justify-center text-sm font-bold flex-shrink-0 mr-4">2</div>
                    <div>
                        <h3 class="font-semibold text-gray-800 mb-2">Cobro de la Multa</h3>
                        <p class="text-gray-700">Se hace efectivo después de los 10 minutos. El infractor deberá cancelar el valor de la multa de <span class="font-bold text-red-600">3 días de SMLMV</span>, que será depositada en la cuenta bancaria de la administración habilitada para este fin.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Footer Message -->
        <div class="text-center py-8">
            <div class="inline-flex items-center space-x-2 bg-3shape-blue text-white px-6 py-3 rounded-lg">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                </svg>
                <span class="font-semibold">Let's change dentistry together</span>
            </div>
        </div>
    </main>
</body>
</html>
<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
<?php require resource_path('partials/new.footer.php'); ?>