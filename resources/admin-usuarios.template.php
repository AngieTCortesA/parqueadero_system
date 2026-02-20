<?php require resource_path('partials/header.php'); ?>

<style>
/* Estilos específicos para admin-usuarios */
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

.card {
    background: white;
    border-radius: 0.5rem;
    padding: 1.5rem;
    margin-bottom: 1.5rem;
    box-shadow: 0 1px 3px rgba(0,0,0,0.1);
}

.form-group {
    margin-bottom: 1rem;
}

.form-group label {
    display: block;
    margin-bottom: 0.5rem;
    font-weight: 600;
    color: #374151;
}

.form-group input, .form-group select {
    width: 100%;
    padding: 0.75rem;
    border: 1px solid #d1d5db;
    border-radius: 0.375rem;
    font-size: 0.875rem;
}

.btn {
    padding: 0.75rem 1.5rem;
    border: none;
    border-radius: 0.375rem;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.2s;
}

.btn-primary {
    background-color: #3b82f6;
    color: white;
}

.btn-primary:hover {
    background-color: #2563eb;
}

.btn-danger {
    background-color: #ef4444;
    color: white;
}

.btn-danger:hover {
    background-color: #dc2626;
}

.usuario-item {
    background-color: #f8f9fa;
    border: 1px solid #dee2e6;
    padding: 1.5rem;
    margin-bottom: 1rem;
    border-radius: 0.5rem;
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    transition: all 0.2s;
}

.usuario-item:hover {
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
}

.usuario-info h4 {
    margin-bottom: 0.5rem;
    color: #2c3e50;
    font-size: 1.125rem;
    font-weight: 600;
}

.usuario-info p {
    margin-bottom: 0.25rem;
    color: #6b7280;
}

.usuario-stats {
    display: flex;
    gap: 0.75rem;
    margin-top: 0.75rem;
    flex-wrap: wrap;
}

.stat-item {
    background-color: #e9ecef;
    padding: 0.25rem 0.75rem;
    border-radius: 1rem;
    font-size: 0.75rem;
    font-weight: 600;
}

.stat-activa {
    background-color: #d4edda;
    color: #155724;
}

.stat-completada {
    background-color: #e2e3e5;
    color: #383d41;
}

.stat-cancelada {
    background-color: #f8d7da;
    color: #721c24;
}

.grid {
    display: grid;
    gap: 1.5rem;
}

.grid-cols-1 {
    grid-template-columns: 1fr;
}

.grid-cols-2 {
    grid-template-columns: 1fr 2fr;
}

@media (max-width: 768px) {
    .grid-cols-2 {
        grid-template-columns: 1fr;
    }
    
    .usuario-item {
        flex-direction: column;
        gap: 1rem;
    }
}

.password-toggle {
    position: relative;
}

.password-toggle input {
    padding-right: 3rem;
}

.password-toggle span {
    position: absolute;
    right: 0.75rem;
    top: 50%;
    transform: translateY(-50%);
    cursor: pointer;
    font-size: 1.125rem;
    color: #6b7280;
    user-select: none;
}

.password-toggle span:hover {
    color: #374151;
}
</style>

<div class="border-b border-gray-200 pb-8 mb-8">
    <div class="flex items-center justify-center mb-4">
        <img src="assets/images/3shape-intraoral-logo.png" alt="3Shape Logo" width="50" height="50" class="mr-4">
        <h1 class="text-4xl font-bold text-gray-900">Gestión de Usuarios</h1>
    </div>
    <p class="text-center text-gray-600">Administra los usuarios del sistema de parqueadero</p>
</div>

<div class="container mx-auto px-4">
    <div class="nav text-center mb-8">
        <a href="/" class="inline-block px-4 py-2 mx-2 text-blue-600 border border-blue-600 rounded hover:bg-blue-600 hover:text-white transition">🏠 Inicio</a>
        <a href="/mis-reservas" class="inline-block px-4 py-2 mx-2 text-blue-600 border border-blue-600 rounded hover:bg-blue-600 hover:text-white transition">📋 Reservas</a>
        <a href="/admin" class="inline-block px-4 py-2 mx-2 text-blue-600 border border-blue-600 rounded hover:bg-blue-600 hover:text-white transition">⚙️ Administración</a>
    </div>
    
    <?php if (isset($mensaje)): ?>
        <div class="mensaje <?php echo $tipo_mensaje; ?>">
            <?php echo $mensaje; ?>
        </div>
    <?php endif; ?>
    
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <div>
            <div class="card">
                <h2 class="text-xl font-bold mb-4">➕ Agregar Usuario</h2>
                
                <form method="POST" action="">
                    <input type="hidden" name="action" value="agregar">
                    
                    <div class="form-group">
                        <label for="nombre">Nombre Completo:</label>
                        <input type="text" name="nombre" id="nombre" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" name="email" id="email" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="telefono">Teléfono:</label>
                        <input type="tel" name="telefono" id="telefono" placeholder="Opcional">
                    </div>
                    
                    <div class="form-group">
                        <label for="password">Contraseña:</label>
                        <div class="password-toggle">
                            <input type="password" name="password" id="password" required>
                            <span id="togglePassword">👁️</span>
                        </div>
                    </div>
                    
                    <button type="submit" class="btn btn-primary">Agregar Usuario</button>
                </form>
            </div>
        </div>
        
        <div>
            <div class="card">
                <h2 class="text-xl font-bold mb-4">📝 Lista de Usuarios</h2>
                
                <?php if (empty($usuarios)): ?>
                    <p class="text-gray-500">No hay usuarios registrados.</p>
                <?php else: ?>
                    <?php foreach ($usuarios as $usuario): ?>
                        <div class="usuario-item">
                            <div class="usuario-info">
                                <h4><?php echo htmlspecialchars($usuario['nombre']); ?></h4>
                                <p><strong>Email:</strong> <?php echo htmlspecialchars($usuario['email']); ?></p>
                                <p><strong>Teléfono:</strong> <?php echo htmlspecialchars($usuario['telefono'] ?: 'No especificado'); ?></p>
                                <p><strong>Registrado:</strong> <?php echo date('d/m/Y', strtotime($usuario['fecha_registro'])); ?></p>
                                <p><strong>Rol:</strong> <?php echo htmlspecialchars($usuario['rol'] ?: 'usuario'); ?></p>
                                
                                <div class="usuario-stats">
                                    <span class="stat-item">
                                        Total: <?php echo $usuario['total_reservas']; ?>
                                    </span>
                                    <span class="stat-item stat-activa">
                                        Activas: <?php echo $usuario['reservas_activas']; ?>
                                    </span>
                                    <span class="stat-item stat-completada">
                                        Completadas: <?php echo $usuario['reservas_completadas']; ?>
                                    </span>
                                    <span class="stat-item stat-cancelada">
                                        Canceladas: <?php echo $usuario['reservas_canceladas']; ?>
                                    </span>
                                </div>
                            </div>
                            
                            <div>
                                <form method="POST" action="" style="display: inline;">
                                    <input type="hidden" name="action" value="eliminar">
                                    <input type="hidden" name="usuario_id" value="<?php echo $usuario['id']; ?>">
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('¿Estás seguro de que quieres eliminar este usuario? También se eliminarán todas sus reservas.')">
                                        Eliminar
                                    </button>
                                </form>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<script>
    const passwordInput = document.getElementById('password');
    const togglePassword = document.getElementById('togglePassword');
    
    if (togglePassword) {
        togglePassword.addEventListener('click', function() {
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
            this.textContent = type === 'password' ? '👁️' : '🙈';
        });
    }
</script>

<?php require resource_path('partials/new.footer.php'); ?> 