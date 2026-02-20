<?php require resource_path('partials/header.php'); ?>

<div class="min-h-screen bg-gray-50 py-8">
  <div class="max-w-7xl mx-auto px-2 sm:px-0 ">
    
    <!-- Título principal -->
     <div class="border-b border-gray-200 pb-8 mb-8">
        <div class="flex items-center justify-center mb-4">
            <img src="assets/images/3shape-intraoral-logo.png" alt="3Shape Logo" width="50" height="50" class="mr-4">
            <h1 class="text-4xl font-bold text-gray-900">Mi perfil</h1>
        </div>
        <p class="text-center text-gray-600">Consulta informacion relacionada con tu cuenta</p>
    </div>  
    <!-- Contenedor principal -->
        <div class="container mx-auto">
          <div class="card w-xl6">
            <h2 class="text-xl font-bold mb-4">Informacion del usuario</h2> 

            <div class="form-group">
              <label for="usuario_nombre">
                Nombre completo:
              </label>
              <div id="usuario_nombre" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-md text-gray-600">
                <?php echo htmlspecialchars($_SESSION['usuario_nombre']); ?>
              </div>
            </div>
            <div class="form-group">
              <label for="usuario_email">
                 Correo electrónico:
              </label>
              <div id="usuario_email" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-md text-gray-600">
                <?php echo htmlspecialchars($_SESSION['usuario_email']); ?>
              </div>
            </div>
            <div class="form-group">
              <label for="usuario_telefono">
                Telefono:
              </label>
              <div id="usuario_telefono" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-md text-gray-600">
                <?php echo htmlspecialchars($_SESSION['usuario_telefono']); ?>
              </div>
            </div>
            <div class="form-group">
              <label for="sede_asignada">
                Sede asignada:
              </label>                
            <div id="sede_asignada" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-md text-gray-600">
              <label>
                3Shape - Sede Citybank
              </label>
            </div>
            </div>
         </div>
        </div>
     </div>
    </div>

    <!-- Información adicional o acciones rápidas (opcional) -->
    <div class="mt-8 grid grid-cols-1 md:grid-cols-3 gap-6">
      
      <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 text-center">
        <div class="w-12 h-12 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
          <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
          </svg>
        </div>
        <h3 class="text-lg font-medium text-gray-900 mb-2">Perfil Completo</h3>
        <p class="text-sm text-gray-600">Tu información está actualizada</p>
      </div>

      <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 text-center">
        <div class="w-12 h-12 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
          <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
          </svg>
        </div>
        <h3 class="text-lg font-medium text-gray-900 mb-2">Cuenta Activa</h3>
        <p class="text-sm text-gray-600">Vigente hasta decisión administrativa</p>
      </div>

      <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 text-center">
        <div class="w-12 h-12 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
          <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
          </svg>
        </div>
        <h3 class="text-lg font-medium text-gray-900 mb-2">Sede Asignada</h3>
        <p class="text-sm text-gray-600">3Shape - Sede original</p>
      </div>

    </div>
  </div>
</div>

<?php require resource_path('partials/new.footer.php'); ?>