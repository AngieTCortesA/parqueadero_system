<?php require __DIR__ . '/partials/header.php'; ?>
<?php require __DIR__ . '/partials/flash.php'; ?>
<style>
.radio-inputs {
  display: flex;
  justify-content: center;
  align-items: center;
  max-width: 350px;
  -webkit-user-select: none;
  -moz-user-user-select: none;
  -ms-user-select: none;
  user-select: none;
}
.radio-inputs > * {
  margin: 6px;
}
.radio-input:checked + .radio-tile {
  border-color: #2260ff;
  box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1);
  color: #2260ff;
}
.radio-input:checked + .radio-tile:before {
  transform: scale(1);
  opacity: 1;
  background-color: #2260ff;
  border-color: #2260ff;
}
.radio-input:checked + .radio-tile .radio-icon svg {
  fill: #2260ff;
}
.radio-input:checked + .radio-tile .radio-label {
  color: #2260ff;
}
.radio-input:focus + .radio-tile {
  border-color: #2260ff;
  box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1), 0 0 0 4px #b5c9fc;
}
.radio-input:focus + .radio-tile:before {
  transform: scale(1);
  opacity: 1;
}
.radio-tile {
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  width: 80px;
  min-height: 80px;
  border-radius: 0.5rem;
  border: 2px solid #b5bfd9;
  background-color: #fff;
  box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1);
  transition: 0.15s ease;
  cursor: pointer;
  position: relative;
}
.radio-tile:before {
  content: "";
  position: absolute;
  display: block;
  width: 0.75rem;
  height: 0.75rem;
  border: 2px solid #b5bfd9;
  background-color: #fff;
  border-radius: 50%;
  top: 0.25rem;
  left: 0.25rem;
  opacity: 0;
  transform: scale(0);
  transition: 0.25s ease;
}
.radio-tile:hover {
  border-color: #2260ff;
}
.radio-tile:hover:before {
  transform: scale(1);
  opacity: 1;
}
.radio-icon svg {
  width: 2rem;
  height: 2rem;
  fill: #494949;
}
.radio-label {
  color: #707070;
  transition: 0.375s ease;
  text-align: center;
  font-size: 13px;
}
.radio-input {
  clip: rect(0 0 0 0);
  -webkit-clip-path: inset(100%);
  clip-path: inset(100%);
  height: 1px;
  overflow: hidden;
  position: absolute;
  white-space: nowrap;
  width: 1px;
}

.mapa-espacios-bg {
    width: 100%;
    max-width: 900px; /* Ajusta este valor al ancho que tiene tu mapa de carros */
    margin: 0 auto;
    min-height: 200px; /* Opcional: altura mínima para evitar saltos */
}

#mapa-espacios-carro,
#mapa-motos-grid,
#mapa-espacios-moto-grande {
    width: 100%;
    max-width: 900px; /* Mismo valor que el contenedor padre */
    margin: 0 auto;
}

/* Para centrar los elementos de motos dentro del contenedor */
#mapa-motos-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 10px;
    justify-items: center;
}

#mapa-espacios-moto-grande {
    display: flex;
    justify-content: center;
    gap: 10px;
}

/* Estilos para mensajes de validación */
.mensaje {
  padding: 1rem;
    margin-bottom: 1rem;
    border-radius: 0.5rem;
    text-align: center;
    font-weight: 600;
}

.mensaje.success {
  background-color: #d1fae5;
    color: #065f46;
    border: 1px solid #a7f3d0;
}

.mensaje.error {
  background-color: #fee2e2;
    color: #991b1b;
    border: 1px solid #fecaca;
}

.mensaje.warning {
  background-color: #fef3c7;
  border: 1px solid #f59e0b;
  color: #92400e;
}

.mensaje::before {
  font-family: "Font Awesome 5 Free";
  font-weight: 900;
  font-size: 16px;
}

.mensaje.success::before {
  content: "\f00c"; /* check icon */
}

.mensaje.error::before {
  content: "\f071"; /* exclamation triangle */
}

.mensaje.warning::before {
  content: "\f06a"; /* exclamation circle */
}

/* Estilos para ocultar/mostrar secciones */
.seccion-oculta {
  display: none !important;
}

.seccion-visible {
  display: block !important;
  animation: fadeIn 0.5s ease-in;
}

@keyframes fadeIn {
  from { opacity: 0; transform: translateY(20px); }
  to { opacity: 1; transform: translateY(0); }
}

.datepicker-principal {
  background: #f8fafc;
  border: 2px solid #e2e8f0;
  border-radius: 12px;
  padding: 24px;
  margin-bottom: 32px;
  text-align: center;
}

.datepicker-principal h2 {
  color: #1e293b;
  margin-bottom: 16px;
  font-size: 1.5rem;
  font-weight: 600;
}

.datepicker-principal .relative {
  max-width: 320px;
  margin: 0 auto;
}
</style>
 
<div class="border-b border-gray-300 pb-8 mb-8">
    <img src="assets/images/3shape-intraoral-logo.png" alt="" width="50" height="50">

    <h1 class="mb-4 text-4xl font-extrabold leading-none tracking-tight text-gray-900 md:text-5xl lg:text-6xl dark:text-black">Sistema de Agendamiento de Parqueadero de 3Shape</h1>
    <?php if (isset($_SESSION['usuario_nombre']) && $_SESSION['usuario_nombre']): ?>
    <p class="mt-6 mb-8 ml-0 text-lg font-normal text-gray-500 lg:text-xl sm:px-16 xl:px-48 dark:text-gray-400">Te damos la bienvenida, <?php echo htmlspecialchars($_SESSION['usuario_nombre']); ?></p>
    <?php endif; ?>
    <a href="/about" class="inline-flex items-center justify-center px-5 py-3 mb-8 text-base font-medium text-center text-white bg-red-800 rounded-lg hover:bg-red-900 transform transition-all duration-200 ease-out hover:-translate-y-1 focus:ring-4 focus:ring-red-300 dark:focus:ring-red-900">
        Conoce nuestra política
        <svg class="w-3.5 h-3.5 ms-2 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
      </svg>
    </a>

<!-- Mensajes de error o exito -->
   <?php if (isset($mensaje) && $mensaje): ?>
        <div class="mensaje <?php echo htmlspecialchars($tipo_mensaje); ?>">
            <?php echo htmlspecialchars($mensaje); ?>
        </div>
    <?php endif; ?>
 
<!-- Sección principal del datepicker -->
<div class="datepicker-principal">
    <h2><i class="fas fa-calendar-alt"></i> Selecciona la fecha de tu reserva</h2>
    <p class="mb-4 text-gray-600">Primero elige la fecha en la que deseas reservar tu espacio de parqueadero</p>
    
    <div class="relative max-w-sm" style="margin: 0 auto;">
        <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
            <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
            </svg>
        </div>
        <input datepicker id="default-datepicker" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Elige la fecha en la que deseas reservar">
    </div>
    
    <div id="mensaje-seleccionar-fecha" class="mt-4 text-sm text-gray-500">
        <i class="fas fa-arrow-up"></i> Selecciona una fecha para ver los espacios disponibles
    </div>
</div>

  <button id="open-carousel-btn"
    style="display:block;margin:20px auto;padding:14px 28px;font-size:17px;font-weight:500;cursor:pointer;color:white;background-color: #66676d;border:none;border-radius:8px;transition:transform .2s ease,background-color .2s ease,box-shadow .2s ease;"
    onmouseover="this.style.backgroundColor='#494343';this.style.transform='translateY(-3px)';this.style.boxShadow='0 6px 15px rgba(0,0,0,.15)'"
    onmouseout="this.style.backgroundColor='#66676d';this.style.transform='translateY(0)';this.style.boxShadow='none'">
    Ver distribución de parqueadero
    </button>

    <!-- Modal Start -->
    <div id="carousel-modal" style="display:none; position: fixed; z-index: 1000; left: 0; top: 0; width: 100%; height: 100%; overflow: auto; background-color: rgba(0,0,0,0.5);">
      <div style="background-color: #fff; margin: 10% auto; padding: 20px; border-radius: 8px; max-width: 650px; position: relative;">
        <button id="close-carousel-btn" aria-label="Cerrar" style="position: absolute; top: 10px; right: 10px; background: #f44336; border: none; color: white; font-size: 20px; padding: 5px 10px; cursor: pointer; border-radius: 5px;">&times;</button>
        
        <div id="image-carousel" style="max-width: 600px; margin: 0 auto; position: relative; overflow: hidden; border-radius: 8px; box-shadow: 0 4px 8px rgba(0,0,0,0.1);">
            <div style="text-align: center; padding:0 12px 0 12px; font-weight: bold; color: #444;">Mapa conceptual / Referencia de espacios</div>
            <div id="carousel-subtitle" style="text-align: center; padding:0 12px 12px 12px; font-weight: bold; color: #444;">Parqueadero primer piso</div>
            <div class="carousel-images" style="display: flex; transition: transform 0.5s ease;">
                <img src="assets/images/Parking.png" alt="Image 2" style="width: 100%; flex-shrink: 0;">
                <img src="assets/images/Parking-2.png" alt="Image 1" style="width: 100%; flex-shrink: 0;">
            </div>

            <!-- Navigation buttons -->
            <button id="prev-btn" aria-label="Previous" style="position: absolute; top: 50%; left: 10px; transform: translateY(-50%); background: rgba(0,0,0,0.3); border: none; color: white; font-size: 24px; padding: 8px 12px; cursor: pointer; border-radius: 50%;">&#10094;</button>
            <button id="next-btn" aria-label="Next" style="position: absolute; top: 50%; right: 10px; transform: translateY(-50%); background: rgba(0,0,0,0.3); border: none; color: white; font-size: 24px; padding: 8px 12px; cursor: pointer; border-radius: 50%;">&#10095;</button>
        </div>
      </div>
    </div>

    <?php
    $reservas_usuario = [];
    if (isset($_SESSION['usuario_id'])) {
        $reservas_usuario = db()->query(
            'SELECT fecha_reserva FROM reservas WHERE usuario_id = :id AND estado = "activa"',
            ['id' => $_SESSION['usuario_id']]
        )->get();
    }
    $fechas_reservadas = array_column($reservas_usuario, 'fecha_reserva');
    ?>

    <script>
    document.addEventListener("DOMContentLoaded", function () {
            const carousel = document.getElementById('image-carousel');
            const imagesContainer = carousel.querySelector('.carousel-images');
            const images = imagesContainer.querySelectorAll('img');
            const totalImages = images.length;
            const subtitle = document.getElementById('carousel-subtitle');

            const subtitles = [
                "Parqueadero tercer piso",
                "Parqueadero segundo piso"
            ];

            let currentIndex = 0;

            const prevBtn = document.getElementById('prev-btn');
            const nextBtn = document.getElementById('next-btn');

            function updateCarousel() {
                const offset = -currentIndex * 100;
                imagesContainer.style.transform = 'translateX(' + offset + '%)';

                //Actualizar subtitulo
                subtitle.textContent = subtitles[currentIndex];
            }

            prevBtn.addEventListener('click', () => {
                currentIndex = (currentIndex - 1 + totalImages) % totalImages;
                updateCarousel();
            });

            nextBtn.addEventListener('click', () => {
                currentIndex = (currentIndex + 1) % totalImages;
                updateCarousel();
            });

            // Modal open/close logic
            const openBtn = document.getElementById('open-carousel-btn');
            const modal = document.getElementById('carousel-modal');
            const closeBtn = document.getElementById('close-carousel-btn');

            openBtn.addEventListener('click', () => {
                modal.style.display = 'block';
                currentIndex = 0; // Reset to first image when opening
                updateCarousel();
            });

            closeBtn.addEventListener('click', () => {
                modal.style.display = 'none';
            });

            // Close modal when clicking outside the modal content
            window.addEventListener('click', (event) => {
                if (event.target === modal) {
                    modal.style.display = 'none';
                }
            });
        })();
    </script>
</div>

<!-- Contenedor de mapas y formulario - inicialmente oculto -->
<div id="seccion-mapas-reserva" class="seccion-oculta">
    <div class="container">
        
        <!-- Mostrar mensajes de validación y confirmación -->
        <?php if (isset($mensaje) && !empty($mensaje)): ?>
            <div class="mensaje <?php echo isset($tipo_mensaje) ? $tipo_mensaje : 'error'; ?>">
                <?php echo htmlspecialchars($mensaje); ?>
            </div>
        <?php endif; ?>
        
        <!-- Mostrar mensaje adicional si hay parámetros en la URL (para redirects) -->
        <?php if (isset($_GET['message'])): ?>
            <div class="mensaje <?php echo isset($_GET['type']) ? $_GET['type'] : 'error'; ?>">
                <?php echo htmlspecialchars($_GET['message']); ?>
            </div>
        <?php endif; ?>
        
        <!-- Mostrar fecha seleccionada -->
        <div id="fecha-seleccionada-info" class="mb-6 p-4 bg-blue-50 border border-blue-200 rounded-lg">
            <h3 class="text-lg font-semibold text-blue-800 mb-2">
                <i class="fas fa-calendar-check"></i> Fecha seleccionada: <span id="fecha-mostrar"></span>
            </h3>
            <p class="text-blue-600 text-sm">Ahora selecciona el tipo de vehículo y el espacio que deseas reservar</p>
        </div>
        
        <div class="grid">
            <div>
                <div class="card" style="margin-bottom: 32px; width: 100%; max-width: 100vw;">
                    <div style="margin-bottom: 18px;">
                        <label style="font-weight:bold; font-size:1.1rem; margin-right: 18px;">Tipo de Vehículo:</label>
                        <div class="radio-inputs">
                            <label>
                                <input class="radio-input" type="radio" name="tipo_vehiculo_selector" value="moto">
                                <span class="radio-tile">
                                    <span class="radio-icon">
                                         <!-- Moto Icon -->
                                      <i class="fa-solid fa-motorcycle"></i>
                                       
                                    </span>
                                    <span class="radio-label">Moto</span>
                                </span>
                            </label>
                            <label>
                                <input class="radio-input" type="radio" name="tipo_vehiculo_selector" value="carro" checked>
                                <span class="radio-tile">
                                    <span class="radio-icon">
                                        <!-- Carro SVG -->
                                        <svg stroke="currentColor" xml:space="preserve" viewBox="0 0 324.018 324.017" fill="none" width="32" height="32"><g><g><path d="M317.833,197.111c3.346-11.148,2.455-20.541-2.65-27.945c-9.715-14.064-31.308-15.864-35.43-16.076l-8.077-4.352 l-0.528-0.217c-8.969-2.561-42.745-3.591-47.805-3.733c-7.979-3.936-14.607-7.62-20.475-10.879 c-20.536-11.413-34.107-18.958-72.959-18.958c-47.049,0-85.447,20.395-90.597,23.25c-2.812,0.212-5.297,0.404-7.646,0.59 l-6.455-8.733l7.34,0.774c2.91,0.306,4.267-1.243,3.031-3.459c-1.24-2.216-4.603-4.262-7.519-4.57l-23.951-2.524 c-2.91-0.305-4.267,1.243-3.026,3.459c1.24,2.216,4.603,4.262,7.519,4.57l3.679,0.386l8.166,11.05 c-13.823,1.315-13.823,2.139-13.823,4.371c0,18.331-2.343,22.556-2.832,23.369L0,164.443v19.019l2.248,2.89 c-0.088,2.775,0.823,5.323,2.674,7.431c5.981,6.804,19.713,7.001,21.256,7.001c4.634,0,14.211-2.366,20.78-4.153 c-0.456-0.781-0.927-1.553-1.3-2.392c-0.36-0.809-0.603-1.668-0.885-2.517c-0.811-2.485-1.362-5.096-1.362-7.845 c0-14.074,11.449-25.516,25.515-25.516s25.52,11.446,25.52,25.521c0,6.068-2.221,11.578-5.773,15.964 c-0.753,0.927-1.527,1.828-2.397,2.641c-1.022,0.958-2.089,1.859-3.254,2.641c29.332,0.109,112.164,0.514,168.708,1.771 c-0.828-0.823-1.533-1.771-2.237-2.703c-0.652-0.854-1.222-1.75-1.761-2.688c-2.164-3.744-3.5-8.025-3.5-12.655 c0-14.069,11.454-25.513,25.518-25.513c14.064,0,25.518,11.449,25.518,25.513c0,5.126-1.553,9.875-4.152,13.878 c-0.605,0.922-1.326,1.755-2.04,2.594c-0.782,0.922-1.616,1.781-2.527,2.584c5.209,0.155,9.699,0.232,13.546,0.232 c19.563,0,23.385-1.688,23.861-5.018C324.114,202.108,324.472,199.602,317.833,197.111z"></path></g></g></svg>
                                    </span>
                                    <span class="radio-label">Carro</span>
                                </span>
                            </label>
                             <label>
                                <input class="radio-input" type="radio" name="tipo_vehiculo_selector" value="moto_grande">
                                <span class="radio-tile">
                                    <span class="radio-icon">
                                       <!-- Moto Grande SVG -->
                                        <svg stroke="currentColor" xml:space="preserve" viewBox="0 0 467.168 467.168" fill="none" width="32" height="32"><g><g><path d="M76.849,210.531C34.406,210.531,0,244.937,0,287.388c0,42.438,34.406,76.847,76.849,76.847 c30.989,0,57.635-18.387,69.789-44.819l18.258,14.078c0,0,134.168,0.958,141.538-3.206c0,0-16.65-45.469,4.484-64.688 c2.225-2.024,5.021-4.332,8.096-6.777c-3.543,8.829-5.534,18.45-5.534,28.558c0,42.446,34.403,76.846,76.846,76.846 c42.443,0,76.843-34.415,76.843-76.846c0-42.451-34.408-76.849-76.843-76.849c-0.697,0-1.362,0.088-2.056,0.102 c5.551-3.603,9.093-5.865,9.093-5.865l-5.763-5.127c0,0,16.651-3.837,12.816-12.167c-3.848-8.33-44.19-58.28-44.19-58.28 s7.146-15.373-7.634-26.261l-7.098,15.371c0,0-18.093-12.489-25.295-10.084c-7.205,2.398-18.005,3.603-21.379,8.884l-3.358,3.124 c0,0-0.95,5.528,4.561,13.693c0,0,55.482,17.05,58.119,29.537c0,0,3.848,7.933-12.728,9.844l-3.354,4.328l-8.896,0.479 l-16.082-36.748c0,0-15.381,4.082-23.299,10.323l1.201,6.24c0,0-64.599-43.943-125.362,21.137c0,0-44.909,12.966-76.37-26.897 c0,0-0.479-12.968-76.367-10.565l5.286,5.524c0,0-5.286,0.479-7.444,3.841c-2.158,3.358,1.2,6.961,18.494,6.961 c0,0,39.153,44.668,69.17,42.032l42.743,20.656l18.975,32.42c0,0,0.034,2.785,0.23,7.045c-4.404,0.938-9.341,1.979-14.579,3.09 C139.605,232.602,110.832,210.531,76.849,210.531z M390.325,234.081c29.395,0,53.299,23.912,53.299,53.299 c0,29.39-23.912,53.294-53.299,53.294c-29.394,0-53.294-23.912-53.294-53.294C337.031,257.993,360.932,234.081,390.325,234.081z M76.849,340.683c-29.387,0-53.299-23.913-53.299-53.295c0-29.395,23.912-53.299,53.299-53.299 c22.592,0,41.896,14.154,49.636,34.039c-28.26,6.011-56.31,11.99-56.31,11.99l3.619,19.933l55.339-2.444 C124.365,322.116,102.745,340.683,76.849,340.683z M169.152,295.835c1.571,5.334,3.619,9.574,6.312,11.394l-24.696,0.966 c1.058-3.783,1.857-7.666,2.338-11.662L169.152,295.835z"></path></g></g></svg>
                                    </span>
                                    <span class="radio-label">Motos de Alto Cilindraje</span>
                                </span>
                            </label>
                        </div>
                    </div>
                    
                    <!-- Información sobre restricción de una reserva por día -->
                    <?php if (isset($_SESSION['usuario_nombre']) && $_SESSION['usuario_nombre']): ?>
                    <div style="background: #e0f2fe; border: 1px solid #0288d1; padding: 10px; border-radius: 6px; margin-bottom: 15px; font-size: 14px; color: #01579b;">
                        <i class="fas fa-info-circle" style="margin-right: 5px;"></i>
                        <strong>Recordatorio:</strong> Solo se permite una reserva por día por usuario. Si ya tienes una reserva activa para una fecha, no podrás crear otra para el mismo día, a menos que canceles tu reserva actual.
                    </div>
                    <?php endif; ?>
                    <?php if (!empty($usuario_bloqueado) && $_SESSION['usuario_rol'] !== 'admin'): ?>
                    <div class="mensaje warning" style="background:#fff7ed;border:1px solid #f59e0b;color:#92400e;margin-bottom:15px;">
                        <i class="fas fa-ban" style="margin-right:6px;"></i>
                        Tu cuenta está actualmente bloqueada por el administrador. No puedes crear nuevas reservas hasta ser desbloqueado.
                    </div>
                    <?php endif; ?>
                    
                    <div id="mapa-carro" style="display:block;">
                <div class="mapa-titulo" style="justify-content: flex-start;">
                    <span style="color:#2563eb;font-size:2.2rem;">&#128205;</span>
                    Mapa de Espacios de Parqueadero (Carros)-Disponibilidad para la fecha seleccionada
                </div>
                <div class="mapa-leyenda" style="justify-content: flex-start;">
                    <span><span style="display:inline-block;width:18px;height:18px;background:#22c55e;border-radius:4px;"></span> Disponible</span>
                    <span><span style="display:inline-block;width:18px;height:18px;background:#f6e6ea;border-radius:4px;"></span> Ocupado</span>
                    <span><span style="display:inline-block;width:18px;height:18px;background:#2563eb;border-radius:4px;"></span> Seleccionado</span>
                </div>
                <div class="mapa-espacios-bg" style="width: 100%; max-width: 900px; margin: 0 auto;">
                    <div id="mapa-espacios-carro">
                        <?php for ($i = 281; $i >= 273; $i--): ?>
                            <?php
                                $estado = 'disponible';
                                if (isset($ocupados_map[$i])) {
                                    if ($ocupados_map[$i] == $_SESSION['usuario_id']) {
                                        $estado = 'seleccionado';
                                    } else {
                                        $estado = 'ocupado';
                                    }
                                }
                            ?>
                            <button type="button" class="espacio-btn <?php echo $estado; ?>" data-espacio="<?php echo $i; ?>" data-tipo="carro" <?php echo ($estado=='ocupado'?'disabled':''); ?>
                            <?php if($estado=='seleccionado'): ?> style="background:#2563eb;color:#fff;border:2px solid #2563eb;box-shadow:0 0 0 4px #2563eb33;"<?php endif; ?>
                            >
                                <span class="icono-auto"><i class="fa-solid fa-car-side"></i></span>
                                <span><?php echo $i; ?></span>
                            </button>
                        <?php endfor; ?>
                    </div>
                </div>
                <div id="ayuda-espacio-carro" style="font-size: 13px; color: #888; margin-top: 3px; text-align:center;">Selecciona un espacio disponible (verde).</div>
            </div>
            <div id="mapa-moto" style="display:none;">
                <div class="mapa-titulo" style="justify-content: flex-start;">
                    <span style="color:#2563eb;font-size:2.2rem;">&#128205;</span>
                    Mapa de Espacios de Parqueadero (Motos)-Disponibilidad para la fecha seleccionada
                </div>
                <div class="mapa-leyenda" style="justify-content: flex-start;">
                    <span><span style="display:inline-block;width:18px;height:18px;background:#22c55e;border-radius:4px;"></span> Disponible</span>
                    <span><span style="display:inline-block;width:18px;height:18px;background:#f6e6ea;border-radius:4px;"></span> Lleno</span>
                    <span><span style="display:inline-block;width:18px;height:18px;background:#2563eb;border-radius:4px;"></span> Seleccionado</span>
                </div>
                <div class="mapa-espacios-bg" style="width: 100%; max-width: 900px; margin: 0 auto;">
                    <div id="mapa-motos-grid" style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 10px; justify-items: center;">
                        <!-- Columna 1 -->
                        <?php
                            $id = 474;
                            $ocupados = $moto_ocupados[$id] ?? 0;
                            $max = 7;
                            $estado = ($ocupados >= $max) ? 'ocupado' : 'disponible';
                            $info = "$ocupados/$max cupos reservados";
                        ?>
                        <button type="button" class="espacio-btn moto-btn <?php echo $estado; ?>" data-espacio="474" data-tipo="moto" data-cupos="<?php echo $info; ?>" <?php echo ($estado=='ocupado'?'disabled':''); ?> style="position:relative;">
                            <span class="icono-auto"><i class="fa-solid fa-motorcycle"></i></span>
                            <span>474</span>
                            <span class="tooltip-cupos"><?php echo $info; ?></span>
                        </button>
                    
                        <!-- Columna 2 -->
                        <?php
                            $id = 475;
                            $ocupados = $moto_ocupados[$id] ?? 0;
                            $max = 7;
                            $estado = ($ocupados >= $max) ? 'ocupado' : 'disponible';
                            $info = "$ocupados/$max cupos reservados";
                        ?>
                        <button type="button" class="espacio-btn moto-btn <?php echo $estado; ?>" data-espacio="475" data-tipo="moto" data-cupos="<?php echo $info; ?>" <?php echo ($estado=='ocupado'?'disabled':''); ?> style="position:relative;">
                            <span class="icono-auto"><i class="fa-solid fa-motorcycle"></i></span>
                            <span>475</span>
                            <span class="tooltip-cupos"><?php echo $info; ?></span>
                        </button>
                        <!-- Columna 3 -->
                        <?php
                            $id = 476;
                            $ocupados = $moto_ocupados[$id] ?? 0;
                            $max = 7;
                            $estado = ($ocupados >= $max) ? 'ocupado' : 'disponible';
                            $info = "$ocupados/$max cupos reservados";
                        ?>
                        <button type="button" class="espacio-btn moto-btn <?php echo $estado; ?>" data-espacio="476" data-tipo="moto" data-cupos="<?php echo $info; ?>" <?php echo ($estado=='ocupado'?'disabled':''); ?> style="position:relative;">
                            <span class="icono-auto"><i class="fa-solid fa-motorcycle"></i></span>
                            <span>476</span>
                            <span class="tooltip-cupos"><?php echo $info; ?></span>
                        </button>
                        
                        <?php
                            $id = 441;
                            $ocupados = $moto_ocupados[$id] ?? 0;
                            $max = 5;
                            $estado = ($ocupados >= $max) ? 'ocupado' : 'disponible';
                            $info = "$ocupados/$max cupos reservados";
                        ?>
                        <button type="button" class="espacio-btn moto-btn <?php echo $estado; ?>" data-espacio="441" data-tipo="moto" data-cupos="<?php echo $info; ?>" <?php echo ($estado=='ocupado'?'disabled':''); ?> style="position:relative;">
                            <span class="icono-auto"><i class="fa-solid fa-motorcycle"></i></span>
                            <span>441</span>
                            <span class="tooltip-cupos"><?php echo $info; ?></span>
                        </button>  
                        
                        <?php
                            $id = '001';
                            $ocupados = $moto_ocupados[$id] ?? 0;
                            $max = 5;
                            $estado = ($ocupados >= $max) ? 'ocupado' : 'disponible';
                            $info = "$ocupados/$max cupos reservados";
                        ?>
                        <button type="button" class="espacio-btn moto-btn <?php echo $estado; ?>" data-espacio="001" data-tipo="moto" data-cupos="<?php echo $info; ?>" <?php echo ($estado=='ocupado'?'disabled':''); ?> style="position:relative;">
                            <span class="icono-auto"><i class="fa-solid fa-motorcycle"></i></span>
                            <span>001</span>
                            <span class="tooltip-cupos"><?php echo $info; ?></span>
                        </button>

                        <?php
                            $id = '002';
                            $ocupados = $moto_ocupados[$id] ?? 0;
                            $max = 5;
                            $estado = ($ocupados >= $max) ? 'ocupado' : 'disponible';
                            $info = "$ocupados/$max cupos reservados";
                        ?>
                        <button type="button" class="espacio-btn moto-btn <?php echo $estado; ?>" data-espacio="002" data-tipo="moto" data-cupos="<?php echo $info; ?>" <?php echo ($estado=='ocupado'?'disabled':''); ?> style="position:relative;">
                            <span class="icono-auto"><i class="fa-solid fa-motorcycle"></i></span>
                            <span>002</span>
                            <span class="tooltip-cupos"><?php echo $info; ?></span>
                        </button>
                        
                    </div>
                </div>
                <div id="ayuda-espacio-moto" style="font-size: 13px; color: #888; margin-top: 3px; text-align:center;">Selecciona un espacio disponible (verde). Pasa el mouse para ver los cupos ocupados.</div>
            </div>

<div id="mapa-moto-grande" style="display:none;">
    <div class="mapa-titulo" style="justify-content: flex-start;">
        <span style="color:#2563eb;font-size:2.2rem;">&#128205;</span>
        Mapa de Espacios de Parqueadero (Motos de Alto Cilindraje)-Disponibilidad para la fecha seleccionada
    </div>
    <div class="mapa-leyenda" style="justify-content: flex-start;">
        <span><span style="display:inline-block;width:18px;height:18px;background:#22c55e;border-radius:4px;"></span> Disponible</span>
        <span><span style="display:inline-block;width:18px;height:18px;background:#f6e6ea;border-radius:4px;"></span> Ocupado</span>
        <span><span style="display:inline-block;width:18px;height:18px;background:#2563eb;border-radius:4px;"></span> Seleccionado</span>
    </div>
    <div class="mapa-espacios-bg" style="width: 100%; max-width: 900px; margin: 0 auto;">
        <div id="mapa-espacios-moto-grande" style="display: flex; justify-content: center; gap: 10px;">
            <?php for ($i = 272; $i >= 270; $i--): ?>
                <?php
                    $estado = 'disponible';
                    if (isset($moto_grande_ocupados_map[$i])) {
                        if ($moto_grande_ocupados_map[$i] == $_SESSION['usuario_id']) {
                            $estado = 'seleccionado';
                        } else {
                            $estado = 'ocupado';
                        }
                    }
                    $info_mg = "0/2 cupos reservados";
                ?>
                <button type="button" class="espacio-btn moto-grande-btn <?php echo $estado; ?>" data-espacio="<?php echo $i; ?>" data-tipo="moto_grande" data-cupos="<?php echo $info_mg; ?>" <?php echo ($estado=='ocupado'?'disabled':''); ?>
                <?php if($estado=='seleccionado'): ?> style="position:relative;background:#2563eb;color:#fff;border:2px solid #2563eb;box-shadow:0 0 0 4px #2563eb33;"<?php else: ?> style="position:relative;"<?php endif; ?>
                >
                    <span class="icono-auto"><i class="fa-solid fa-motorcycle"></i></span>
                    <span><?php echo $i; ?></span>
                    <span class="tooltip-cupos"><?php echo $info_mg; ?></span>
                </button>
            <?php endfor; ?>
        </div>
    </div>
    <div id="ayuda-espacio-moto-grande" style="font-size: 13px; color: #888; margin-top: 3px; text-align:center;">Selecciona un espacio disponible (verde) para motos de alto cilindraje, es decir, de un mayor tamaño.</div>
</div>
                    </div>

                    <div id="formulario-reserva" class="card form-reserva-oculto">
                        <h2 style="margin-bottom: 18px;"><i class="fas fa-lock"></i> Reservar Espacio <span id="espacio-seleccionado-titulo"></span></h2>
                        
                        <!-- Validación del lado del cliente para mostrar advertencia -->
                        <div id="advertencia-reserva-existente" style="display: none; background: #fff3cd; border: 1px solid #ffc107; padding: 10px; border-radius: 6px; margin-bottom: 15px; color: #856404;">
                            <i class="fas fa-exclamation-triangle" style="margin-right: 5px;"></i>
                            <strong>Atención:</strong> Solo puedes tener una reserva activa por día. Si ya tienes una reserva para la fecha seleccionada, esta acción será rechazada.
                        </div>
                        
                        <?php if (!empty($mensaje)): ?>
                            <div class="mb-4 p-4 rounded-lg 
                                <?= $tipo_mensaje === 'success' 
                                    ? 'bg-green-100 text-green-800 border border-green-300' 
                                    : 'bg-red-100 text-red-800 border border-red-300' ?>">
                                <?= htmlspecialchars($mensaje) ?>
                            </div>
                        <?php endif; ?>
                        <form method="POST" action="" id="form-reserva">
                            <input type="hidden" name="action" value="reservar">
                            <input type="hidden" name="numero_espacio" id="numero_espacio" required>
                            <input type="hidden" name="tipo_vehiculo" id="tipo_vehiculo" value="carro">
                            <!-- Campo de fecha oculto que se sincroniza con el datepicker principal -->
                            <input type="hidden" name="fecha_reserva" id="fecha_reserva" required>
                            
                            <?php if ($_SESSION['usuario_rol'] == 'admin'): ?>
                                <div class="form-group">
                                    <label for="usuario_id">Usuario:</label>
                                    <select name="usuario_id" id="usuario_id" required>
                                        <option value="">Seleccione un usuario</option>
                                        <?php foreach ($usuarios as $usuario): ?>
                                            <option value="<?php echo $usuario['id']; ?>"><?php echo htmlspecialchars($usuario['nombres']); ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            <?php endif; ?>
                            
                            <div class="form-group">
                                <label for="placa_vehiculo">Placa del Vehículo:</label>
                                <input type="text" name="placa_vehiculo" id="placa_vehiculo" placeholder="ABC123" maxlength="10" required style="text-transform: uppercase;">
                                <small style="color: #666; font-size: 12px; display: block; margin-top: 4px;">
                                    Ingresa la placa sin espacios ni guiones
                                </small>
                            </div>
                            
                            <?php if (!isset($_SESSION['usuario_nombre']) || !$_SESSION['usuario_nombre']): ?>
                                <button type="button" class="text-white bg-blue-400 dark:bg-blue-500 cursor-not-allowed font-medium rounded-lg text-sm px-5 py-2.5 text-center" disabled>
                                    <i class="fas fa-sign-in-alt" style="margin-right: 5px;"></i>
                                    Debe iniciar sesión para reservar
                                </button>
                            <?php elseif (!empty($usuario_bloqueado) && $_SESSION['usuario_rol'] !== 'admin'): ?>
                                <button type="button" class="text-white bg-gray-400 cursor-not-allowed font-medium rounded-lg text-sm px-5 py-2.5 text-center" disabled>
                                    <i class="fas fa-ban" style="margin-right: 5px;"></i>
                                    Tu cuenta está bloqueada
                                </button>
                            <?php else: ?>
                                <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" id="btn-reservar">
                                    <i class="fas fa-calendar-plus" style="margin-right: 5px;"></i>
                                    Reservar Cupo
                                </button>
                            <?php endif; ?>
                        </form>
                    </div>
                </div>
              
                <div>         
                <a href="#" class="block max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow-sm hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">

                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white"><i class="far fa-calendar-alt"></i> Reservas para hoy</h5>
                    <p class="font-normal text-gray-700 dark:text-gray-400"> 
                        <?php if (empty($reservas_hoy)): ?>
                                            <p class="font-normal text-gray-700 dark:text-white">
                                                <?php echo ($_SESSION['usuario_rol'] == 'admin') ? 'No hay reservas para hoy.' : 'No tienes reservas para hoy.'; ?>
                                            </p>
                                        <?php else: ?>
                                            <?php foreach ($reservas_hoy as $reserva): ?>
                                                <div class="reserva-item">
                                                    <h4><?php echo htmlspecialchars($reserva['nombres']); ?></h4>
                                                    <p><strong>Espacio: </strong><?php echo htmlspecialchars($reserva['numero_espacio']); ?></p>
                                                    <p><strong>Placa:</strong> <?php echo htmlspecialchars($reserva['placa_vehiculo']); ?></p>
                                                    <p><strong>Email:</strong> <?php echo htmlspecialchars($reserva['email']); ?></p>
                                                    <p><strong>Tipo:</strong> <?php echo ucfirst(str_replace('_', ' ', htmlspecialchars($reserva['tipo_vehiculo']))); ?></p>
                                                </div>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                    </p>
                </a>
                <br>
                <a href="#" class="block max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow-sm hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">

                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white"><i class="far fa-calendar-alt"></i> Reservas para Mañana</h5>
                    <p class="font-normal text-gray-700 dark:text-gray-400">  
                        <?php if (empty($reservas_manana)): ?>
                             <p class="font-normal text-gray-700 dark:text-white">
                                <?php echo ($_SESSION['usuario_rol'] == 'admin') ? 'No hay reservas para mañana.' : 'No tienes reservas para mañana.'; ?>
                            </p>
                        <?php else: ?>
                            <?php foreach ($reservas_manana as $reserva): ?>
                                <div class="reserva-item">
                                    <h4><?php echo htmlspecialchars($reserva['nombres']); ?></h4>
                                    <p><strong>Espacio: </strong><?php echo htmlspecialchars($reserva['numero_espacio']); ?></p>
                                    <p><strong>Placa:</strong> <?php echo htmlspecialchars($reserva['placa_vehiculo']); ?></p>
                                    <p><strong>Email:</strong> <?php echo htmlspecialchars($reserva['email']); ?></p>
                                    <p><strong>Tipo:</strong> <?php echo ucfirst(str_replace('_', ' ', htmlspecialchars($reserva['tipo_vehiculo']))); ?></p>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </p>
                </a>

                </div>
            </div>
        </div>
    </div>
</div>
    
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const datepicker = document.getElementById('default-datepicker');
        const seccionMapas = document.getElementById('seccion-mapas-reserva');
        const fechaMostrar = document.getElementById('fecha-mostrar');
        const fechaReserva = document.getElementById('fecha_reserva');
        const mensajeSeleccionar = document.getElementById('mensaje-seleccionar-fecha');
        const contenedorCarro = document.getElementById('mapa-espacios-carro');
        const contenedorMoto = document.getElementById('mapa-motos-grid');
        const contenedorMotoGrande = document.getElementById('mapa-espacios-moto-grande');
        const fechasReservadas = <?php echo json_encode($fechas_reservadas); ?>;

        function obtenerFechasPermitidas() {
            const hoy = new Date();
            hoy.setHours(0, 0, 0, 0);

            const fechaMin = new Date(hoy);
            fechaMin.setDate(hoy.getDate() + 1); // mañana

            const fechaMax = new Date(hoy);
            fechaMax.setDate(hoy.getDate() + 7); // +7 días

            return { fechaMin, fechaMax };
        }

        function esDiaHabil(fecha) {
            const diaSemana = fecha.getDay();
            return diaSemana >= 1 && diaSemana <= 5; // Lunes(1) a Viernes(5)
        }

        // Validar si ya tiene reserva para ese día
        function yaTieneReserva(fechaStr) {
            const fechaBackend = formatearParaBackend(fechaStr);
            return fechasReservadas.includes(fechaBackend);
        }

        //Funcion para validar que la feha sea valida 
        function esFechaValida(fechaStr) {
            const fecha = parsearFechaInput(fechaStr);
            if (!fecha || isNaN(fecha.getTime())) return false;

            fecha.setHours(0, 0, 0, 0);

            const { fechaMin, fechaMax } = obtenerFechasPermitidas();

            // Validar rango
            if (fecha < fechaMin || fecha > fechaMax) return false;
            
            // Validar día hábil
            if (!esDiaHabil(fecha)) return false;

            return true;
            
        }
        
        //Funcion para mostrar error si la fecha es invalida
        function mostrarErrorFecha(mensaje) {

            mensajeSeleccionar.style.display = 'block';
            mensajeSeleccionar.classList.remove('text-gray-500');
            mensajeSeleccionar.classList.add('text-red-600');
            mensajeSeleccionar.innerHTML = `<i class="fas fa-exclamation-triangle"></i> ${mensaje}`;

            seccionMapas.classList.remove('seccion-visible');
            seccionMapas.classList.add('seccion-oculta');
        }


        function formatearParaBackend(fechaStr) {

            const fecha = parsearFechaInput(fechaStr);
            if (!fecha) return null;

            const año = fecha.getFullYear();
            const mes = String(fecha.getMonth() + 1).padStart(2, '0');
            const dia = String(fecha.getDate()).padStart(2, '0');

            return `${año}-${mes}-${dia}`;
        }


        // Función para mostrar los mapas cuando se selecciona una fecha
        function mostrarMapasConFecha(fechaStr) {
            if (!fechaStr) return; 

            // Parsear y formatear la fecha
            const fecha = parsearFechaInput(fechaStr);
            if (!fecha) {
                mostrarErrorFecha('Fecha inválida');
                return;
            }

            const { fechaMin, fechaMax } = obtenerFechasPermitidas();

            // Validar rango
            if (fecha < fechaMin || fecha > fechaMax) {
                mostrarErrorFecha('Solo puedes reservar desde mañana hasta máximo 7 días en adelante.');
                return;
            }

            // Validar día hábil
            if (!esDiaHabil(fecha)) {
                mostrarErrorFecha('Solo se pueden hacer reservas para días hábiles (lunes a Viernes).');
                return;
            }

            if (yaTieneReserva(fechaStr)) {
                mostrarErrorFecha('Ya tienes una reserva para este día. Solo se permite una reserva por día.');
                return;
            }

            // Si pasa todas las validaciones, continuar
            const fechaParaBackend = formatearParaBackend(fechaStr);
            const fechaFormateada = fecha.toLocaleDateString('es-ES', {
                weekday: 'long', year: 'numeric', month: 'long', day: 'numeric'
            });

            // Actualizar elementos
            fechaMostrar.textContent = fechaFormateada;
            fechaReserva.value = fechaParaBackend;

            // Mostrar sección de mapas
            seccionMapas.classList.remove('seccion-oculta');
            seccionMapas.classList.add('seccion-visible');

            // Limpiar error si lo había
            mensajeSeleccionar.style.display = 'none';
            mensajeSeleccionar.classList.remove('text-red-600');
            mensajeSeleccionar.classList.add('text-gray-500');

            // Scroll suave
            setTimeout(() => {
                seccionMapas.scrollIntoView({ 
                    behavior: 'smooth', 
                    block: 'start' 
                });
            }, 300);

            // Cargar disponibilidad dinámica
            cargarDisponibilidad(fechaParaBackend);
        }

        async function cargarDisponibilidad(fecha) {
            try {
                const res = await fetch(`/api/disponibilidad?fecha=${encodeURIComponent(fecha)}`);
                if (!res.ok) throw new Error('No se pudo obtener disponibilidad');
                const data = await res.json();
                actualizarMapas(data);
            } catch (err) {
                console.error('Error cargando disponibilidad:', err);
            }
        }

        function parsearFechaInput(fechaStr) {

            if (!fechaStr) return null;

            // Si ya viene en formato YYYY-MM-DD
            if (/^\d{4}-\d{2}-\d{2}$/.test(fechaStr)) {
                const [y, m, d] = fechaStr.split('-').map(Number);
                return new Date(y, m - 1, d);
            }

            // Si Flowbite devuelve formato local
            const fecha = new Date(fechaStr);

            return isNaN(fecha) ? null : fecha;
        }

        function actualizarMapas(data) {
            // Actualizar CARROS 281..272
            if (contenedorCarro) {
                const ocupados = new Set((data.carro && data.carro.ocupados) || []);
                const seleccionadosUsuario = new Set((data.carro && data.carro.seleccionados_usuario) || []);
                const botonesCarro = contenedorCarro.querySelectorAll('button.espacio-btn');
                botonesCarro.forEach(btn => {
                    const num = parseInt(btn.getAttribute('data-espacio'), 10);
                    btn.classList.remove('disponible', 'ocupado', 'seleccionado');
                    btn.removeAttribute('style');
                    if (seleccionadosUsuario.has(num)) {
                        btn.classList.add('seleccionado');
                        btn.disabled = false;
                        btn.style.background = '#2563eb';
                        btn.style.color = '#fff';
                        btn.style.border = '2px solid #2563eb';
                        btn.style.boxShadow = '0 0 0 4px #2563eb33';
                    } else if (ocupados.has(num)) {
                        btn.classList.add('ocupado');
                        btn.disabled = true;
                    } else {
                        btn.classList.add('disponible');
                        btn.disabled = false;
                    }
                });
            }

            // Actualizar MOTOS 476, 475, 474, 441
            if (contenedorMoto && data.moto) {
                const ocupadosPorEspacio = data.moto.ocupados || {};
                const maximos = data.moto.maximos || {};
                const botonesMoto = contenedorMoto.querySelectorAll('button.moto-btn');
                botonesMoto.forEach(btn => {
                    const id = btn.getAttribute('data-espacio');
                    const ocupados = Number(ocupadosPorEspacio[id] || 0);
                    const max = Number(maximos[id] || 0);
                    const lleno = max > 0 && ocupados >= max;
                    btn.classList.remove('disponible', 'ocupado', 'seleccionado');
                    if (lleno) {
                        btn.classList.add('ocupado');
                        btn.disabled = true;
                    } else {
                        btn.classList.add('disponible');
                        btn.disabled = false;
                    }
                    const tooltip = btn.querySelector('.tooltip-cupos');
                    const info = `${ocupados}/${max || '?'} cupos reservados`;
                    btn.setAttribute('data-cupos', info);
                    if (tooltip) tooltip.textContent = info;
                });
            }

            // Actualizar MOTOS GRANDES 270..272 (máximo 2 por espacio)
            if (contenedorMotoGrande && data.moto_grande) {
                const ocupadosPorEspacioMG = data.moto_grande.ocupados || {};
                const maximosMG = data.moto_grande.maximos || {};
                const seleccionadosUsuario = new Set(data.moto_grande.seleccionados_usuario || []);
                const botonesMG = contenedorMotoGrande.querySelectorAll('button.moto-grande-btn');
                botonesMG.forEach(btn => {
                    const id = btn.getAttribute('data-espacio');
                    const num = parseInt(id, 10);
                    const ocupados = Number(ocupadosPorEspacioMG[id] || 0);
                    const max = Number(maximosMG[id] || 2);
                    const lleno = max > 0 && ocupados >= max;
                    btn.classList.remove('disponible', 'ocupado', 'seleccionado');
                    // mantener estilos inline (position:relative) necesarios para tooltip
                    if (seleccionadosUsuario.has(num)) {
                        btn.classList.add('seleccionado');
                        btn.disabled = false;
                        btn.style.background = '#2563eb';
                        btn.style.color = '#fff';
                        btn.style.border = '2px solid #2563eb';
                        btn.style.boxShadow = '0 0 0 4px #2563eb33';
                    } else if (lleno) {
                        btn.classList.add('ocupado');
                        btn.disabled = true;
                    } else {
                        btn.classList.add('disponible');
                        btn.disabled = false;
                    }
                    const tooltip = btn.querySelector('.tooltip-cupos');
                    const info = `${ocupados}/${max || '?'} cupos reservados`;
                    btn.setAttribute('data-cupos', info);
                    if (tooltip) tooltip.textContent = info;
                });
            }

            // Reenganchar listeners de selección para los botones disponibles
            activarSeleccionEspacios('#mapa-espacios-carro .espacio-btn.disponible, #mapa-espacios-carro .espacio-btn.seleccionado', 'carro');
            activarSeleccionEspacios('.moto-btn.disponible, .moto-btn.seleccionado', 'moto');
            activarSeleccionEspacios('.moto-grande-btn.disponible, .moto-grande-btn.seleccionado', 'moto_grande');
        }
        
        // Escuchar cambios en el datepicker
        datepicker.addEventListener('changeDate', function(e) {
    
            // Flowbite guarda la fecha en e.detail.date (objeto Date)
            if (e.detail && e.detail.date) {
                const fecha = e.detail.date;
                const año = fecha.getFullYear();
                const mes = String(fecha.getMonth() + 1).padStart(2, '0');
                const dia = String(fecha.getDate()).padStart(2, '0');
                const fechaFormato = `${año}-${mes}-${dia}`; // YYYY-MM-DD
                mostrarMapasConFecha(fechaFormato);
                return;
            }
            
            // Fallback: leer el value del input
            const fechaSeleccionada = e.target.value;
            if (fechaSeleccionada) {
                mostrarMapasConFecha(fechaSeleccionada);
            }
        });
        
        // También escuchar el evento input para mayor compatibilidad
        datepicker.addEventListener('input', function(e) {
            const val = e.target.value;

            if (val) {
                mostrarMapasConFecha(val);
            }
        });

        //Fallback con blur (cuando el usuario sale del campo)
        datepicker.addEventListener('blur', function(e) {
            const val = e.target.value;
            if (val) {
                mostrarMapasConFecha(val);
            }
        });
        
        // Si ya hay una fecha seleccionada al cargar la página, mostrar los mapas
        if (datepicker.value) {
            mostrarMapasConFecha(datepicker.value);
        }
    });

    // Convertir placa a mayúsculas automáticamente
    document.getElementById('placa_vehiculo').addEventListener('input', function() {
        this.value = this.value.toUpperCase();
    });

    function validarReservaExistente() {
        <?php if ($_SESSION['usuario_rol'] != 'admin'): ?>
        const fecha = document.getElementById('fecha_reserva').value;
        const advertencia = document.getElementById('advertencia-reserva-existente');
        const btnReservar = document.getElementById('btn-reservar');

        if (!fecha) return;

        // Usar la misma para disponibilidad
        fetch(`/api/disponibilidad?fecha=${encodeURIComponent(fecha)}`)
            .then(response => response.json())
            .then(data => {
                // La API ya devuelve seleccionados_usuario para el usuario actual
                const tieneReserva = (
                    (data.carro?.seleccionados_usuario?.length > 0) ||
                    (data.moto_grande?.seleccionados_usuario?.length > 0)
                );

                if (tieneReserva) {
                    if (advertencia) advertencia.style.display = 'block';
                    if (btnReservar) {
                        btnReservar.disabled = true;
                        btnReservar.textContent = 'Ya tienes una reserva para esta fecha';
                        btnReservar.classList.add('bg-gray-400', 'cursor-not-allowed');
                        btnReservar.classList.remove('bg-blue-700', 'hover:bg-blue-800');
                    }
                } else {
                    if (advertencia) advertencia.style.display = 'none';
                    if (btnReservar) {
                        btnReservar.disabled = false;
                        btnReservar.innerHTML = '<i class="fas fa-calendar-plus" style="margin-right: 5px;"></i>Reservar Cupo';
                        btnReservar.classList.remove('bg-gray-400', 'cursor-not-allowed');
                        btnReservar.classList.add('bg-blue-700', 'hover:bg-blue-800');
                    }
                }
            })
            .catch(error => {
                console.error('Error verificando reserva:', error);
                if (advertencia) advertencia.style.display = 'none';
            });
        <?php endif; ?>
    }

    // Selector de tipo de vehículo y mapas
    const tipoVehiculoRadios = document.getElementsByName('tipo_vehiculo_selector');
    const mapaCarro = document.getElementById('mapa-carro');
    const mapaMoto = document.getElementById('mapa-moto');
    const mapaMotoGrande = document.getElementById('mapa-moto-grande');
    const formTipoVehiculo = document.getElementById('tipo_vehiculo');

    // Mostrar el mapa correcto según selección
    Array.from(tipoVehiculoRadios).forEach(radio => {
        radio.addEventListener('change', function() {
            // Ocultar todos los mapas
            mapaCarro.style.display = 'none';
            mapaMoto.style.display = 'none';
            mapaMotoGrande.style.display = 'none';
            
            if (this.value === 'carro') {
                mapaCarro.style.display = 'block';
                if (formTipoVehiculo) formTipoVehiculo.value = 'carro';
            } else if (this.value === 'moto') {
                mapaMoto.style.display = 'block';
                if (formTipoVehiculo) formTipoVehiculo.value = 'moto';
            } else if (this.value === 'moto_grande') {
                mapaMotoGrande.style.display = 'block';
                if (formTipoVehiculo) formTipoVehiculo.value = 'moto_grande';
            }
            
            // Limpiar selección previa
            document.getElementById('numero_espacio').value = '';
            document.getElementById('formulario-reserva').classList.add('form-reserva-oculto');
        });
    });

    // Selección dinámica de espacio y mostrar formulario
    function activarSeleccionEspacios(selector, tipo) {
        const botones = document.querySelectorAll(selector);
        const inputEspacio = document.getElementById('numero_espacio');
        const formReserva = document.getElementById('formulario-reserva');
        const tituloEspacio = document.getElementById('espacio-seleccionado-titulo');
        const tipoVehiculoInput = document.getElementById('tipo_vehiculo');
        
        botones.forEach(btn => {
            if (btn.dataset.bound === '1') return; // evitar listeners duplicados
            btn.dataset.bound = '1';
            btn.addEventListener('click', function() {
                if (btn.hasAttribute('disabled')) return;
                
                // Quitar seleccionado de todos los botones
                document.querySelectorAll('.moto-btn, .moto-grande-btn, .espacio-btn:not(.moto-btn):not(.moto-grande-btn)').forEach(b => b.classList.remove('seleccionado'));
                
                btn.classList.add('seleccionado');
                inputEspacio.value = btn.getAttribute('data-espacio');
                tituloEspacio.textContent = btn.getAttribute('data-espacio');
                if (tipoVehiculoInput) tipoVehiculoInput.value = tipo;
                formReserva.classList.remove('form-reserva-oculto');
                formReserva.classList.add('form-reserva-visible');
                
                // Scroll suave al formulario
                window.scrollTo({ top: formReserva.offsetTop - 40, behavior: 'smooth' });
                
                // Mostrar info de cupos en móviles para motos
                if (tipo === 'moto') {
                    mostrarInfoCuposMovil(btn.getAttribute('data-cupos'));
                }
                
                // Validar reserva existente cuando se selecciona un espacio
                validarReservaExistente();
            });
        });
    }
    
    // Activar selección para cada tipo de vehículo
    activarSeleccionEspacios('#mapa-espacios-carro .espacio-btn.disponible, #mapa-espacios-carro .espacio-btn.seleccionado', 'carro');
    activarSeleccionEspacios('.moto-btn.disponible, .moto-btn.seleccionado', 'moto');
    activarSeleccionEspacios('.moto-grande-btn.disponible, .moto-grande-btn.seleccionado', 'moto_grande');

    // Función para mostrar info de cupos en móviles (solo para motos normales)
    function mostrarInfoCuposMovil(info) {
        if (window.innerWidth <= 768 && info) {
            alert('Información del espacio: ' + info);
        }
    }

    // Manejo del formulario con validación adicional
    const formReserva = document.getElementById('form-reserva');
    if (formReserva) {
        formReserva.addEventListener('submit', function(e) {
            const fecha = document.getElementById('fecha_reserva').value;
            const espacio = document.getElementById('numero_espacio').value;
            const placa = document.getElementById('placa_vehiculo').value;
            
            // Validaciones básicas
            if (!fecha || !espacio || !placa) {
                e.preventDefault();
                alert('Por favor completa todos los campos requeridos.');
                return;
            }
            
            // Validar formato de placa
            if (placa.length < 5 || placa.length > 10) {
                e.preventDefault();
                alert('La placa debe tener entre 5 y 10 caracteres.');
                return;
            }
            
            // Confirmar reserva
            const confirmacion = confirm(`¿Confirmas que deseas reservar el espacio ${espacio} para el ${fecha} con la placa ${placa}?`);
            if (!confirmacion) {
                e.preventDefault();
                return;
            }
            
            // Mostrar indicador de carga
            const btnReservar = document.getElementById('btn-reservar');
            if (btnReservar) {
                btnReservar.disabled = true;
                btnReservar.innerHTML = '<i class="fas fa-spinner fa-spin" style="margin-right: 5px;"></i>Procesando...';
            }
        });
    }

    // Auto-ocultar mensajes después de unos segundos
    const mensajes = document.querySelectorAll('.mensaje');
    mensajes.forEach(mensaje => {
        setTimeout(() => {
            mensaje.style.opacity = '0';
            mensaje.style.transition = 'opacity 0.5s ease';
            setTimeout(() => {
                mensaje.style.display = 'none';
            }, 500);
        }, 5000); // 5 segundos
    });
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
<script src="js/dropdown.js"></script>
<?php require __DIR__ . '/../resources/partials/new.footer.php'; ?>
