<?php require resource_path('partials/header.php'); ?>
<style>
  .card {
    background: white;
    border-radius: 0.5rem;
    padding: 1.5rem;
    margin-bottom: 1.5rem;
    box-shadow: 0 1px 3px rgba(0,0,0,0.1);
 } 
</style>

<div class="border-b border-gray-200 pb-8 mb-8">
    <div class="flex items-center justify-center margin-bottom-4">
        <img src="assets/images/3shape-intraoral-logo.png" alt="3Shape Logo" width="50" height="50" class="mr-4">
        <h1 class="text-4xl font-bold text-gray-900">Editar información</h1>
    </div>
    <p class="text-center text-gray-600">Edita tus datos personales</p>
</div>
<div class="container mx-auto">
  <?php if ($msg = session()->getFlash('success')): ?>
    <div class="mb-10 flex justify-center px-4 py-3 rounded-lg border border-green-200 bg-green-50 text-green-800">
      <?= htmlspecialchars($msg) ?>
    </div>
  <?php endif; ?>
  <?php if ($err = session()->getFlash('errors')): ?>
    <div class="mb-10 flex justify-center px-4 py-3 rounded-lg border border-red-200 bg-red-50 text-red-800">
      <?= htmlspecialchars($err) ?>
    </div>
  <?php endif; ?>
  <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
     <form method="POST" action="/cuenta">
      <input type="hidden" name="_method" value="PUT">
      <div class="p-8 space-y-2">
        <!-- Nombres -->
        <div class="grid grid-cols-2 gap-6">
          <div class="form-group">
            <label for="p_nombre">Primer nombre:</label>
            <input type="text" name="p_nombre" 
            value="<?= htmlspecialchars($usuario['p_nombre']) ?>"
            id="p_nombre" class="w-full px-3 py-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
          </div>

          <div class="form-group">
            <label for="s_nombre">Segundo nombre:</label>
            <input type="text" name="s_nombre"
            value="<?= htmlspecialchars($usuario['s_nombre']) ?>"
            id="s_nombre" class="w-full px-3 py-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
          </div>
        </div>

        <!-- Apellidos -->
        <div class="grid grid-cols-2 gap-6">
          <div class="form-group">
            <label for="p_apellido">Primer apellido:</label>
            <input type="text" name="p_apellido"
            value="<?= htmlspecialchars($usuario['p_apellido']) ?>"
            id="p_apellido" class="w-full px-4 py-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
          </div>

          <div class="form-group">
            <label for="s_apellido">Segundo apellido:</label>
            <input type="text" name="s_apellido"
            value="<?= htmlspecialchars($usuario['s_apellido']) ?>"
            id="s_apellido" class="w-full px-4 py-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
          </div>
        </div>

        <!-- Email y teléfono -->
        <div class="grid grid-cols-2 gap-6">
          <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" name="email"
            value="<?= htmlspecialchars($usuario['email']) ?>"
            id="email" class="w-full px-4 py-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
          </div>

          <div class="form-group">
            <label for="telefono">Teléfono:</label>
            <input type="tel" name="telefono"
            value="<?= htmlspecialchars($usuario['telefono']) ?>"
            id="telefono" class="w-full px-4 py-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Opcional">
          </div>
        </div>
      </div>
      <div class="p-8 flex justify-between">
        <a href="/usuarios"
           class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-medium px-6 py-3 rounded-lg transition shadow-sm">
          Cancelar
        </a>

        <button type="submit"
                class="bg-red-800 hover:bg-red-900 text-white font-medium px-6 py-3 rounded-lg transition shadow-sm">
          Guardar cambios
        </button>
      </div>
    </form>
  </div>
</div>

<?php require resource_path('partials/new.footer.php'); ?>