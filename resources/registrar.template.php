<?php require resource_path('partials/header.php'); ?>

      <!-- Header Section -->
      <div class="border-b border-gray-200 pb-8 mb-8">
        <div class="flex items-center justify-center mb-4">
            <img src="assets/images/3shape-intraoral-logo.png" alt="3Shape Logo" width="50" height="50" class="mr-4">
            <h1 class="text-4xl font-bold text-gray-900">Registrate aqui</h1>
        </div>
        <p class="text-center text-gray-600">Crea un perfil</p>
    </div>
<br>
<br>
<div class="w-full max-w-5xl mx-auto">
  <div class="border border-gray-300 bg-gray-50 rounded-xl p-8 mb-8">
      <form class="max-w-2xl mx-auto" method="POST" action="/register">
        <!-- nombres -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-5">
          <div>
            <label class="block mb-2 text-sm font-medium text-gray-900">Primer nombre</label>
            <input type="text" name="primer_nombre" required
              class="w-full p-2.5 rounded-lg border border-gray-300 text-sm">
          </div>

          <div>
            <label class="block mb-2 text-sm font-medium text-gray-900">Segundo nombre</label>
            <input type="text" name="segundo_nombre"
              class="w-full p-2.5 rounded-lg border border-gray-300 text-sm"
              placeholder="Opcional">
          </div>
        </div>

        <!-- apellidos -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-5">
          <div>
            <label class="block mb-2 text-sm font-medium text-gray-900">Primer apellido</label>
            <input type="text" name="primer_apellido" required
              class="w-full p-2.5 rounded-lg border border-gray-300 text-sm">
          </div>

          <div>
            <label class="block mb-2 text-sm font-medium text-gray-900">Segundo apellido</label>
            <input type="text" name="segundo_apellido"
              class="w-full p-2.5 rounded-lg border border-gray-300 text-sm"
              placeholder="Opcional">
          </div>
        </div>

        <!-- telefono y correo -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-5">
          <div>
            <label class="block mb-2 text-sm font-medium text-gray-900">Número telefónico</label>
            <input type="tel" name="telefono" required
              class="w-full p-2.5 rounded-lg border border-gray-300 text-sm"
              placeholder="ej: 321 123 4567">
          </div>

          <div>
            <label class="block mb-2 text-sm font-medium text-gray-900">Correo electrónico</label>
            <input type="email" name="email" required
              class="w-full p-2.5 rounded-lg border border-gray-300 text-sm"
              placeholder="ej: tucorreo@3shape.com">
          </div>
        </div>
        
        <!-- contraseña -->
        <div class="mb-5">
          <label class="block mb-2 text-sm font-medium text-gray-900">Contraseña</label>
          <input type="password" name="password" required
            class="w-full p-2.5 rounded-lg border border-gray-300 text-sm">
        </div>

        <!-- repetir contraseña -->
        <div class="mb-5">
          <label class="block mb-2 text-sm font-medium text-gray-900">Repetir contraseña</label>
          <input type="password" name="repeat-password" required
            class="w-full p-2.5 rounded-lg border border-gray-300 text-sm">
        </div>

        <!-- terminos -->
        <div class="flex items-center gap-2 mb-6">
          <input type="checkbox" name="terms" value="1" required class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-gray-300">
          <label class="ml-2 text-sm text-gray-700">
            He leído y acepto el
            <a href="/about" class="text-blue-600 hover:underline">Reglamento del parqueadero</a>
          </label>
        </div>

        <!-- boton -->
        <button type="submit"
          class="w-full bg-blue-900 text-white py-3 rounded-lg font-medium hover:bg-blue-1000 transition">
          Registrar nueva cuenta
        </button>
     </form>
   </div>
 <br>
    <?= errors() ?>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
<script>
  // Toggle para contraseña principal
  const passwordInput = document.getElementById('password');
  const passwordToggleBtn = document.getElementById('toggle-password');
  const passwordEyeIcon = document.getElementById('password-eye-icon');
  if (passwordToggleBtn) {
    passwordToggleBtn.addEventListener('click', function() {
      if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        passwordEyeIcon.classList.remove('fa-eye');
        passwordEyeIcon.classList.add('fa-eye-slash');
      } else {
        passwordInput.type = 'password';
        passwordEyeIcon.classList.remove('fa-eye-slash');
        passwordEyeIcon.classList.add('fa-eye');
      }
    });
  }
  // Toggle para repetir contraseña
  const repeatPasswordInput = document.getElementById('repeat-password');
  const repeatPasswordToggleBtn = document.getElementById('toggle-repeat-password');
  const repeatPasswordEyeIcon = document.getElementById('repeat-password-eye-icon');
  if (repeatPasswordToggleBtn) {
    repeatPasswordToggleBtn.addEventListener('click', function() {
      if (repeatPasswordInput.type === 'password') {
        repeatPasswordInput.type = 'text';
        repeatPasswordEyeIcon.classList.remove('fa-eye');
        repeatPasswordEyeIcon.classList.add('fa-eye-slash');
      } else {
        repeatPasswordInput.type = 'password';
        repeatPasswordEyeIcon.classList.remove('fa-eye-slash');
        repeatPasswordEyeIcon.classList.add('fa-eye');
      }
    });
  }
</script>
<?php require resource_path('partials/new.footer.php'); ?>