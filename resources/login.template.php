<?php require resource_path('partials/header.php'); ?>
      <!-- Header Section -->
      <div class="border-b border-gray-200 pb-8 mb-8">
        <div class="flex items-center justify-center mb-4">
            <img src="assets/images/3shape-intraoral-logo.png" alt="3Shape Logo" width="50" height="50" class="mr-4">
            <h1 class="text-4xl font-bold text-gray-900">Iniciar sesión</h1>
        </div>
        <p class="text-center text-gray-600">Ingresa tus credenciales</p>
    </div>
<br>
<br>
<div class="w-full max-w-5xl mx-auto">
        <div class="border border-gray-300 bg-gray-50 rounded-xl p-8 mb-8">
            <form class="max-w-2xl mx-auto" method="POST" action="/login">
                <div class="mb-4">
                    <label class="text-sm font-semibold text-gray-900">Email</label>
                    <div class="mt-2">
                        <input 
                            type="text" 
                            name="email" 
                            class="w-full outline-1 outline-gray-300 rounded-md px-3 py-2 text-gray-900" 
                            value="<?= old('email') ?>">
                    </div>
                </div>

                <div class="mb-4">
                    <label class="text-sm font-semibold text-gray-900">Contraseña</label>
                    <div class="mt-2 relative">
                        <input 
                            type="password" 
                            name="password" 
                            class="w-full outline-1 outline-gray-300 rounded-md px-3 py-2 text-gray-900 pr-12" id="login-password" autocomplete="current-password">
                        <button type="button" id="toggle-login-password" tabindex="-1" class="absolute right-3 top-1/2 -translate-y-1/2 p-0 bg-transparent border-0 text-gray-400 hover:text-blue-600 focus:outline-none">
                            <i class="fa-solid fa-eye text-lg" id="login-eye-icon"></i>
                        </button>
                    </div>
                </div>

                <div class="mt-4">
                    
                    <p class="text-gray-500 dark:text-gray-400 mb-3">¿Aún no tienes una cuenta?<a href="/register" class="inline-flex items-center font-medium text-blue-600 dark:text-blue-500 hover:underline">
                    Regístrate
                    <svg class="w-4 h-4 ms-2 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                    </svg>
                    </a></p>

                    <button type="submit" class="w-full rounded-md bg-indigo-600 hover:bg-indigo-500 text-white px-3 py-2 text-center text-sm font-semibold">
                        Iniciar sesión &rarr;
                    </button>
                </div>
            </form>
        <br>
            <?= errors() ?>
        </div>
</div>

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
</script>
<?php require resource_path('partials/new.footer.php'); ?>