<?php require resource_path('partials/header.php'); ?>

<div class="min-h-screen bg-gray-50 py-8">
  <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
    <!-- Título principal -->
    <div class="border-b border-gray-200 pb-8 mb-8">
        <div class="flex items-center justify-center mb-4">
            <img src="assets/images/3shape-intraoral-logo.png" alt="3Shape Logo" width="50" height="50" class="mr-4">
            <h1 class="text-4xl font-bold text-gray-900">Configuración</h1>
        </div>
        <p class="text-center text-gray-600">Encuentra ajustes</p>
    </div>

    <!-- Grid de opciones de configuración -->
    <div class="mt-8 grid grid-cols-1 md:grid-cols-3 gap-6">
      
      <!-- Editar información personal -->
      <a href="/editar-cuenta" class="block bg-white rounded-lg shadow-sm border border-gray-200 p-6 text-center hover:shadow-md transition">
        <div class="w-12 h-12 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
          <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.75 6.75a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0z"></path>
            <path stroke-linecape="round" stroke-linejoin="round" stroke-width="1.5"
            d="M4.5 20.25a8.25 8.25 0 0115 0" />
          </svg>
        </div>
        <h3 class="text-lg font-medium text-gray-900 mb-2">Editar información personal</h3>
        <p class="text-sm text-gray-600">Cambia tus datos personales, solo serán usados para el registro y permanecerán privados</p>
      </a>

      <!-- Cambiar contraseña -->
        <a href="/cambiar-password" class="block bg-white rounded-lg shadow-sm border border-gray-200 p-6 text-center hover:shadow-md transition">
          <div class="w-12 h-12 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
            <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16.5 10.5V7.875a4.125 4.125 0 10-8.25 0V10.5"></path>
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M6.75 10.5h10.5v8.25a1.5 1.5 0 01-1.5 1.5h-7.5a1.5 1.5 0 01-1.5-1.5V10.5"></path>
            </svg>
          </div>
          <h3 class="text-lg font-medium text-gray-900 mb-2">Cambiar contraseña</h3>
          <p class="text-sm text-gray-600">Cambia tu contraseña</p>
        </a>
    </div>
  </div>
</div>

<!-- Script para funcionalidad de contraseña (mantenido de tu código original) -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
<script>
  const loginPasswordInput = document.getElementById('login-password');
  const loginToggleBtn = document.getElementById('toggle-login-password');
  const loginEyeIcon = document.getElementById('login-eye-icon');
  
  if (loginToggleBtn) {
    loginToggleBtn.addEventListener('click', function() {
      if (loginPasswordInput.type === 'password') {
        loginPasswordInput.type = 'text';
        loginEyeIcon.classList.remove('fa-eye');
        loginEyeIcon.classList.add('fa-eye-slash');
      } else {
        loginPasswordInput.type = 'password';
        loginEyeIcon.classList.remove('fa-eye-slash');
        loginEyeIcon.classList.add('fa-eye');
      }
    });
  }

  // Funcionalidad para hacer clickeable las tarjetas
  document.querySelectorAll('.cursor-pointer').forEach(card => {
    card.addEventListener('click', function() {
      // Aquí puedes agregar la lógica de navegación
      const action = this.dataset.action;
      
      // Ejemplo de navegación (personaliza según tu estructura de rutas)
      switch(action) {
        case 'perfil':
          window.location.href = '/configuracion/perfil';
          break;
        case 'Cambiar contraseña':
          // window.location.href = '/configuracion/password';
          break;
        case 'Cambiar segunda clave':
          // window.location.href = '/configuracion/segunda-clave';
          break;
        // Agrega más casos según necesites
      }
    });
  });
</script>

<?php require resource_path('partials/new.footer.php'); ?>