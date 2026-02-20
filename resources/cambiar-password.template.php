<?php require resource_path('partials/header.php'); ?>

<div class="border-b border-gray-200 pb-8 mb-8">
    <div class="flex items-center justify-center mb-4">
        <img src="assets/images/3shape-intraoral-logo.png" alt="3Shape Logo" width="50" height="50" class="mr-4">
        <h1 class="text-4xl font-bold text-gray-900">Cambiar contraseña</h1>
    </div>
    <p class="text-center text-gray-600">Actualiza tu contraseña</p>
</div>

<div class="w-full max-w-xl mx-auto">
    <?= alert() ?>
    
    <form action="/cambiar-password" method="POST" id="passwordForm">
        <input type="hidden" name="_method" value="PUT">

        <!-- Agregado campo para contraseña actual -->
        <div class="mb-4">
            <label for="current_password" class="text-sm font-semibold text-gray-900">Contraseña Actual</label>
            <div class="mt-2">
                <input 
                    type="password" 
                    id="current_password"
                    name="current_password" 
                    class="w-full outline-1 outline-gray-300 rounded-md px-3 py-2 text-gray-900" 
                    required>
            </div>
        </div>

        <div class="mb-4">
            <label for="password" class="text-sm font-semibold text-gray-900">Nueva Contraseña</label>
            <div class="mt-2">
                <input 
                    type="password" 
                    id="password"
                    name="password" 
                    class="w-full outline-1 outline-gray-300 rounded-md px-3 py-2 text-gray-900" 
                    minlength="8"
                    required>
                <small class="text-gray-600">Mínimo 8 caracteres</small>
                <!-- Agregado indicador de fortaleza de contraseña -->
                <div id="password-strength" class="mt-1 text-xs"></div>
            </div>
        </div>

        <div class="mb-4">
            <label for="password_confirm" class="text-sm font-semibold text-gray-900">Confirmar Nueva Contraseña</label>
            <div class="mt-2">
                <input 
                    type="password" 
                    id="password_confirm"
                    name="password_confirm" 
                    class="w-full outline-1 outline-gray-300 rounded-md px-3 py-2 text-gray-900" 
                    minlength="8"
                    required>
                <!-- Agregado indicador de coincidencia -->
                <div id="password-match" class="mt-1 text-xs"></div>
            </div>
        </div>

        <div class="mt-6">
            <button type="submit" id="submitBtn" class="w-full rounded-md bg-indigo-600 hover:bg-indigo-500 disabled:bg-gray-400 text-white px-3 py-2 text-center text-sm font-semibold">
                Actualizar Contraseña
            </button>
        </div>
    </form>

    <?= errors() ?>
</div>

<?php require __DIR__ . '/partials/new.footer.php'; ?>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('passwordForm');
    const currentPassword = document.getElementById('current_password');
    const password = document.getElementById('password');
    const passwordConfirm = document.getElementById('password_confirm');
    const strengthDiv = document.getElementById('password-strength');
    const matchDiv = document.getElementById('password-match');
    const submitBtn = document.getElementById('submitBtn');

    // Función para validar fortaleza de contraseña
    function checkPasswordStrength(pwd) {
        let strength = 0;
        let feedback = [];

        if (pwd.length >= 8) strength++;
        else feedback.push('Al menos 8 caracteres');

        if (/[A-Z]/.test(pwd)) strength++;
        else feedback.push('Una mayúscula');

        if (/[a-z]/.test(pwd)) strength++;
        else feedback.push('Una minúscula');

        if (/[0-9]/.test(pwd)) strength++;
        else feedback.push('Un número');

        if (/[^A-Za-z0-9]/.test(pwd)) {
            strength++;
            feedback = feedback.filter(f => f !== 'Un carácter especial');
        }

        return { strength, feedback };
    }

    // Validar fortaleza en tiempo real
    password.addEventListener('input', function() {
        const result = checkPasswordStrength(this.value);
        
        if (this.value === '') {
            strengthDiv.innerHTML = '';
            return;
        }

        let color = 'text-red-500';
        let text = 'Débil';
        
        if (result.strength >= 3) {
            color = 'text-yellow-500';
            text = 'Media';
        }
        if (result.strength >= 4) {
            color = 'text-green-500';
            text = 'Fuerte';
        }

        strengthDiv.innerHTML = `<span class="${color}">Fortaleza: ${text}</span>`;
        
        if (result.feedback.length > 0) {
            strengthDiv.innerHTML += `<br><span class="text-gray-500">Falta: ${result.feedback.join(', ')}</span>`;
        }
    });

    // Validar coincidencia de contraseñas
    function checkPasswordMatch() {
        if (passwordConfirm.value === '') {
            matchDiv.innerHTML = '';
            return true;
        }

        if (password.value === passwordConfirm.value) {
            matchDiv.innerHTML = '<span class="text-green-500">✓ Las contraseñas coinciden</span>';
            return true;
        } else {
            matchDiv.innerHTML = '<span class="text-red-500">✗ Las contraseñas no coinciden</span>';
            return false;
        }
    }

    passwordConfirm.addEventListener('input', checkPasswordMatch);
    password.addEventListener('input', checkPasswordMatch);

    // Validación al enviar el formulario
    form.addEventListener('submit', function(e) {
        const pwd = password.value;
        const pwdConfirm = passwordConfirm.value;
        const currentPwd = currentPassword.value;

        // Validaciones básicas
        if (!currentPwd) {
            e.preventDefault();
            alert('Debes ingresar tu contraseña actual');
            return;
        }

        if (pwd !== pwdConfirm) {
            e.preventDefault();
            alert('Las contraseñas no coinciden');
            return;
        }

        if (pwd === currentPwd) {
            e.preventDefault();
            alert('La nueva contraseña debe ser diferente a la actual');
            return;
        }

        if (pwd.length < 8) {
            e.preventDefault();
            alert('La contraseña debe tener al menos 8 caracteres');
            return;
        }

        // Deshabilitar botón para evitar doble envío
        submitBtn.disabled = true;
        submitBtn.textContent = 'Actualizando...';
    });
});
</script>
