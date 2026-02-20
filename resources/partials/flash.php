<?php if (isset($_SESSION['flash_mensaje'])): ?>

    <div class="mb-6 px-4 py-3 rounded 
        <?= $_SESSION['flash_tipo'] === 'success'
            ? 'bg-green-100 text-green-700 border border-green-300'
            : 'bg-red-100 text-red-700 border border-red-300'
        ?>">
        
        <?= htmlspecialchars($_SESSION['flash_mensaje']) ?>
    </div>

    <?php 
        unset($_SESSION['flash_mensaje']);
        unset($_SESSION['flash_tipo']);
    ?>

<?php endif; ?>