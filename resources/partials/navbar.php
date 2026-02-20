<nav class="bg-gray-100 border-gray-200 dark:bg-gray-900">
  <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
    <a href="/" class="flex items-center space-x-3 rtl:space-x-reverse">
    <!-- Logo claro -->
    <img src="assets/images/3shape-logo.png" 
         class="h-8 block dark:hidden" 
         alt="3Shape Logo" />
    <p class="text-sm text-gray-600 dark:text-gray-300">
        Let's change dentistry together
    </p>
</a>

  <div class="flex items-center md:order-2 space-x-3 md:space-x-0 rtl:space-x-reverse">
      <button type="button" class="flex text-sm bg-gray-800 rounded-full md:me-0 focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600" id="user-menu-button" aria-expanded="false" data-dropdown-toggle="user-dropdown" data-dropdown-placement="bottom">
      <?php if (isAuthenticated() ): ?>  
      <span class="sr-only">Open user menu</span>
        <img class="w-8 h-8 rounded-full" src="https://cdn-icons-png.flaticon.com/512/9187/9187604.png" alt="user photo">
      </button>
        <?php endif; ?>
      <!-- Dropdown menu -->
      <div class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded-lg shadow-sm dark:bg-gray-700 dark:divide-gray-600" id="user-dropdown">
        <div class="px-4 py-3">
          <span class="block text-sm text-gray-900 dark:text-white"><?php echo htmlspecialchars($_SESSION['usuario_nombre']); ?></span>
          <span class="block text-sm  text-gray-500 truncate dark:text-gray-400"><?php echo htmlspecialchars($_SESSION['usuario_email']); ?></span>
        </div>
        <ul class="py-2" aria-labelledby="user-menu-button">
          <li>
            <a href="/cuenta" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Cuenta</a>
          </li>
          <li>
            <a href="/configuracion" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Configuración</a>
          </li>
        </ul>
      </div>
      <button data-collapse-toggle="navbar-user" type="button" class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600" aria-controls="navbar-user" aria-expanded="false">
        <span class="sr-only">Open main menu</span>
        <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15"/>
        </svg>
    </button>
  </div>

  <div class="items-center justify-between hidden w-full md:flex md:w-auto md:order-1" id="navbar-user">
    <ul class="flex flex-col font-medium p-4 md:p-0 mt-4 border border-gray-100 rounded-lg bg-gray-50 md:space-x-8 rtl:space-x-reverse md:flex-row md:mt-0 md:border-0 md:bg-gray-100 dark:bg-gray-800 md:dark:bg-gray-900 dark:border-gray-700">
      <li>
          <a href="/" class="block py-2 px-3 <?= requestIs('/') ? 'text-white bg-red-700 rounded-sm md:bg-transparent md:text-red-700 md:p-0 md:dark:text-red-500 dark:bg-red-600 md:dark:bg-transparent' : 'text-gray-900 rounded-sm hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-red-700 md:p-0 dark:text-white md:dark:hover:text-red-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent' ?>" aria-current="page">Inicio <i class="fas fa-home"></i></a>
        </li>
        <li>
          <a href="/about" class="block py-2 px-3 <?= requestIs('/about') ? 'text-white bg-red-700 rounded-sm md:bg-transparent md:text-red-700 md:p-0 md:dark:text-red-500 dark:bg-red-600 md:dark:bg-transparent' : 'text-gray-900 rounded-sm hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-red-700 md:p-0 dark:text-white md:dark:hover:text-red-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent' ?>">Política de uso <i class="fas fa-file-alt"></i></a>
        </li>
        <li>
          <a href="/mis-reservas" class="block py-2 px-3 <?= requestIs('/mis-reservas') ? 'text-white bg-red-700 rounded-sm md:bg-transparent md:text-red-700 md:p-0 md:dark:text-red-500 dark:bg-red-600 md:dark:bg-transparent' : 'text-gray-900 rounded-sm hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-red-700 md:p-0 dark:text-white md:dark:hover:text-red-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent' ?>">Mis reservas <i class="fas fa-calendar-alt"></i></a>
        </li>
        <?php if (isAuthenticated() && isset($_SESSION['usuario_rol']) && $_SESSION['usuario_rol'] === 'admin'): ?>
        <li>
            <button id="dropdownNavbarLink" data-dropdown-toggle="dropdownNavbar" class="flex items-center justify-between w-full py-2 px-3 text-gray-900 rounded-sm hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-red-700 md:p-0 md:w-auto dark:text-white md:dark:hover:text-blue-500 dark:focus:text-white dark:border-gray-700 dark:hover:bg-gray-700 md:dark:hover:bg-transparent">
                Admin <svg class="w-2.5 h-2.5 ms-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                </svg>
            </button>
            <!-- Dropdown menu -->
            <div id="dropdownNavbar" class="z-10 hidden font-normal bg-white divide-y divide-gray-100 rounded-lg shadow-sm w-44 dark:bg-gray-700 dark:divide-gray-600">
                <ul class="py-2 text-sm text-gray-700 dark:text-gray-400" aria-labelledby="dropdownLargeButton">
                  <li>
                    <a href="/usuarios" class="block px-4 py-2 <?= requestIs('/usuarios') ? 'bg-red-100 text-red-700' : 'hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white' ?>">Usuarios <i class="fas fa-users"></i></a>
                  </li>
                  <li>
                    <a href="/admin" class="block px-4 py-2 <?= requestIs('/admin') ? 'bg-red-100 text-red-700' : 'hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white' ?>">Administración <i class="fas fa-cog"></i></a>
                  </li>
                </ul>
            </div>
        </li>
        <?php endif; ?>
        
        <li>
            <?php if (isAuthenticated()): ?>
            <form action="/logout" method="POST"
                  onsubmit="return confirm('¿Cerrar sesión?');">
                <button type="submit"
                        class="block py-2 px-3 text-gray-900 rounded-sm hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-red-700 md:p-0 dark:text-white md:dark:hover:text-red-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">
                    Cerrar sesión <i class="fas fa-sign-out-alt"></i>
                </button>
            </form>
            <?php else: ?>
            <a href="/login" class="block py-2 px-3 <?= requestIs('/login') ? 'text-white bg-red-700 rounded-sm md:bg-transparent md:text-red-700 md:p-0 md:dark:text-red-500 dark:bg-red-600 md:dark:bg-transparent' : 'text-gray-900 rounded-sm hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-red-700 md:p-0 dark:text-white md:dark:hover:text-red-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent' ?>">Iniciar sesión <i class="fas fa-sign-in-alt"></i></a>
            <?php endif; ?>
        </li>
    </ul>
  </div>
  </div>
</nav>


